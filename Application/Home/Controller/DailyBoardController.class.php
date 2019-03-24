<?php
namespace Home\Controller;
use Think\Controller;
use Think\Upload;
use Home\Model\DailyBoardModel;
use Home\Model\LogInModel;
use Home\Model\CommentModel;
class DailyBoardController extends Controller {

    
    /**
     * 提取数据
     */
    protected $all_saying = array();
    protected $one_saying = array();
    protected $ones_all_saying = array();


    /**
     * 数据库操作层
     */
    protected $my_model;
    protected $user_model;
    protected $comment_model;

    /**
     * 显示的基本配置
     */
    protected $show_all_visible_length = 12;


    /**
     * 构造函数
     */
    public function __construct(){

        $this->my_model = D('DailyBoard');
        $this->user_model = D('LogIn'); //处理用户信息
        $this->comment_model = D('Comment'); // 处理文章评论
        parent::__construct(); 
    }

    public function index(){
        echo "hello this is ark's Daily Board";
  }
  /**
   * 留言文章上传
   */
   public function Edit(){

    $user_id = $this->validate_id();
    $saying_id = intval(I('get.id'), 0);
    $ones_saying = $this->my_model->check_ones_saying($user_id, $saying_id);

    //编辑操作
    if($ones_saying) {
        $user = $this->user_model->get_true_user_info($user_id);
        $this->assign("ones_user", $user);
        $this->assign("ones_saying",$ones_saying);
    }

     $this->display("DailyBoard/Edit");

   }

   /**
    * 验证saying_id 是否属于 user_id
    */
    // protected function validate_belonging($user_id, $saying_id){

    //     if(!$saying_id) return false;

    //     return $this->my_model->check_ones_saying($user_id, $saying_id);

    // }

    protected function validate_saying_id(){

        $cookie_id = intval(I("cookie.id"),0);

        if(!$cookie_id) {
            echo "you don't have access!";
            exit();
        }
        return $cookie_id;
    }

   /**
    * 验证id
    */
   protected function validate_id(){

        $cookie_id = intval(I("cookie.id"),0);

        if(!$cookie_id) {
            echo "you don't have access!";
            exit();
        }
        return $cookie_id;

    }

    /**
     * 文章评论
     */
    public function save_comment(){

        $author_id = $this->validate_id();
        $html = $_POST['html'];
        $text = I('post.text');
        $saying_id = intval(I('post.saying_id'), 0);


        echo json_encode($this->comment_model->save_saying_comment($author_id, $html, $text, $saying_id));


    }




    /**
     * 管理我的发布
     */
    public function Management(){

        $user_id = $this-> validate_id();

        $this->ones_all_saying = $this->my_model->get_ones_all_saying_textonly($user_id);
        $this->deal_ones_all_saying(); 
        $user  = $this->user_model->get_true_user_info($user_id);
        // var_dump($this->ones_all_saying);
        $this->assign("user", $user);
        $this->assign("ones_all_saying", $this->ones_all_saying);
        $this->display("DailyBoard/Management");
    }

   /**
    * 显示所有
    */
   public function ShowAll(){


    $this->all_saying = $this->my_model->get_all_saying();
    //处理数据
    $this->deal_all_saying();

    //注入变量
    $this->assign("all_saying", $this->all_saying);
    $this->display("DailyBoard/ShowAll");

   }

   /**
    * 显示一条, 一般为接受的post 请求为留言 id
    */
   public function ShowOne(){



        // $user_id = $this->validate_id();  
        
        $id = I('get.id');
        // 获得文章内容
        $the_saying = $this->my_model->get_one_saying($id);
        
        if(!$the_saying) {echo "<script>javascript:history.back(-1);</script>" ; exit();} // 不存在该文章

        $user_id = $the_saying['author'];
        // 获得作者信息
        $author_info = $this->user_model->get_true_user_info($user_id);
        // 获得评论信息
        $the_saying_comments = $this->comment_model->get_saying_comments($id);

        $this->assign("the_saying_comments", $the_saying_comments);
        $this->assign("author_info", $author_info);
        $this->assign("the_saying", $the_saying);

        $this->display("DailyBoard/ShowOne");




   }

   /**
    * 删除留言
    */

    public function del(){

        $user_id = $this->validate_id();
        $saying_id = intval(I('post.saying_id'), 0);
        
        echo json_encode($this->my_model->del_saying($user_id, $saying_id));

        
    }

   /**
    * 添加留言
    */
   public function add(){

        //防止直接进入页面
        if(!IS_POST) {echo "you don't have access";  $this->redirect('Beginning/index');  exit();}
        $author = $this->validate_id();

        //这里不能用I过滤
        $html = $_POST['html'];
        $text = $_POST['text'];
        $saying_id = intval(I('post.saying_id'));
        $reader = 0;
        if($saying_id) {
            //编辑
            echo json_encode($this->my_model->true_edit($saying_id, $author, $html, $text, $reader));
        }else{  
            //reader = 0表示面向所有读者, 这一块以后再做 , 新增
            echo json_encode($this->my_model->true_add($author, $html, $text, $reader));
        }



   }

   /**
    * 上传图片
    */
   public function upload(){
    // 实例化上传类s
    $upload = new Upload(C("UPLOAD_DAILY_BOARD"));

    $info   =   $upload->upload();

    //返回参数
    $ret = [
        "errno" => 0,
        "data"  => [
            
        ],
    ];
    if(!$info) {// 上传错误提示错误信息
        echo $this->error($upload->getError());
        $ret['errno'] = 1;
        // $ret
    }else{// 上传成功 获取上传文件信息
        foreach($info as $file){
            array_push($ret['data'],C("TMPL_PARSE_STRING.__Uploads__")."/".$file['savepath'].$file['savename']);
        }
        
    }
    echo json_encode($ret);

   }



   // ---- 数据处理层
   protected function deal_ones_all_saying(){

    foreach ($this->ones_all_saying as $key => &$value) {
        # code...
        if(mb_strlen($value['text'],"utf-8") > $this->show_all_visible_length){
            $value['text'] = mb_substr($value['text'], 0, $this->show_all_visible_length-1, "utf-8") . "......";
        }  
        $url = U("DailyBoard/Edit",'id='.$value['id'].'');
        $value['url'] = $url;
    }
    return;
   }

   protected function deal_all_saying(){    

        $all_author = array();

        foreach ($this->all_saying as $key => &$value) {

            // 收集所有的作者信息
            if(!in_array($value['author'], $all_author)) {array_push($all_author, $all_author['author']);}

            // 处理文章长度大于10, 则截取为前十
            if(mb_strlen($value['text'],"utf-8") > $this->show_all_visible_length){$value['text'] = mb_substr($value['text'], 0, $this->show_all_visible_length-1, "utf-8") . "......";}            
            
            // 获得评论数量 for语句里面写sql会导致系统很卡
            $value['comment_num'] = $this->comment_model->count_comment_number($value['id']);
        }

        $authors = $this->user_model->get_true_all_user_by_ids($all_author);
        $change_key_authors = array();
        //整理一下结果, 换key值
        foreach ($authors as $key => $val) {
            $change_key_authors[$val['id']] = $val;
        }

        foreach ($this->all_saying as $key => &$item) {

            $item['face_img'] = $change_key_authors[$item['author']]['face_img'];
            $item['author_nickname'] = $change_key_authors[$item['author']]['nickname'];
            $item['one_saying_url'] = U("DailyBoard/ShowOne", 'id='.$item['id'].'');
            
        }






   }


}