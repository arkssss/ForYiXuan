<?php
namespace Home\Controller;
use Think\Controller;
use Think\Upload;
use Home\Model\LogInModel;

class LogInController extends Controller {


    /** 数据库层 */
    protected $my_model;

    /** 临时变量*/
    protected $user_account;
 
    /**
     * 构造函数
     */
    public function __construct(){

        $this->my_model = D('LogIn');
        parent::__construct(); 
    }

    public function index(){
        echo "hello";
     }


    protected function validate_id(){

        $cookie_id = intval(I("cookie.id"),0);

        if(!$cookie_id) {
            echo "you don't have access!";
            exit();
        }
        return $cookie_id;
    
    }


     /**
      * 更新资料
      */
    public function UpdateProfile(){

        if(!IS_POST) {echo "you dont have access"; exit;}
        $id = $this->validate_id();
        $update_date = I("post.data");
        $img_data    = I('post.img_data');
        //如果有, 则剪裁图片
        if(!empty($img_data)){
            // 图像处理  
            // to be continue ...
            // $this->resize_image($update_date['face_img'], $img_data);
        }

        echo json_encode($this->my_model->update_user_info($id, $update_date));

    }



    /**
     * 重新剪裁头像图片
     */
    protected function resize_image($path, $resize_data){


        // 绝对路径下的open 函数, 用 ./表示图片
        // thinkphp 中 ./ 表示入口文件的路径 ??
        $image = new \Think\Image() ;
        $image->open('./Public/Uploads/UserFace/5c8bafac06ea2.jpg');

        $image->crop($img_data['width'] ,$img_data['height'],$img_data['x'],$img_data['y'])->save('./Public/Uploads/UserFace/12.jpg');

    }



    /**
     * 该密码
     */
    public function ChangePassword(){

        //获取用户id
        $id = $this->validate_id();
        $password = I('post.password');
        echo json_encode($this->my_model->change_password($id, $password));

    }


    public function EditProfile(){

        //获取用户id
        $id = $this->validate_id();

        
        $this->user_account = $this->my_model->get_user_info($id);
        $this->assign("user", $this->user_account);
        $this->display("LogIn/EditProfile");


    }

    /**
     * 登陆的处理函数
     */
    public function login(){

        $username = $_POST['username']; 
        $password = $_POST['password'];

        // var_dump($this->my_model->validate_login($username, $password));
        //登陆验证
        echo  json_encode($this->my_model->validate_login($username, $password));


    }


   /**
    * 上传头像图片
    */
    public function upload(){
        // 实例化上传类s
        $upload = new Upload(C("UPLOAD_USER_FACE"));
    
        $info   =   $upload->upload();
    
        //返回参数
        $ret = [
            "errno" => 0,
            "result"  => [
            ]
        ];
        
        if(!$info) {// 上传错误提示错误信息
            echo $this->error($upload->getError());
            $ret['errno'] = 1;
            // $ret
        }else{// 上传成功 获取上传文件信息
                // echo $file['savepath'].$file['savename'];
            foreach($info as $file){
                $ret['result'] = C("TMPL_PARSE_STRING.__Uploads__")."/".$file['savepath'].$file['savename'];
            }
        }

        echo json_encode($ret);

       }
    

}
