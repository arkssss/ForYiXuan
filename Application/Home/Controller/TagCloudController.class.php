<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\TagCloudModel;
class TagCloudController extends Controller {


    /**
     * cache 
     */
    protected $advance_cahce_tag = array();
    protected $advance_cache_tag_edit = array();
    /**
     * 处理数据库操作层
     */
    protected $my_model;
    
    /**
     * 构造函数
     */
    public function __construct(){

        $this->my_model = D('TagCloud');
        parent::__construct(); 
    }


    public function index(){
        $this->validate_id(1);
        // 采取直接渲染的方式是为了
        $this->rule_tag();
        $this->assign('tags', $this->advance_cahce_tag);
        $this->display();  
    }

    /**
     * 编辑tag界面
     */
    public function EditTag(){
        $this->validate_id(1);
        // 拿数据
        $this->rule_tag_edit();
        // var_dump($this->advance_cache_tag_edit);
        $this->assign('fixplace', $this->advance_cache_tag_edit);
        $this->display();
    }

    /**
     * 接受tag删除的统一入口
     */
    public function del_tag(){

        $type = $_POST['type'];
        $places = $_POST['old_places'];

        echo $this->my_model->tag_del($type, $places);

    }

    /**
     * 展示引导手册
     */
    public function illusion(){

        $this->display();

    }

    /**
     * 接受修改的Ajax 请求
     * 统一的入口
     */
    public function save_tag(){

        // 接受数据
        $old_tag_string = $_POST['old_places'];
        $new_tag_string = $_POST['new_places'];
        $type = $_POST['tag_type'];
        $tag_title = $_POST['tag_title'];
        $tag_des = $_POST['tag_des'];

        //新老tag 的数组
        $old_tags = explode('|', $old_tag_string);
        $new_tags = explode('|', $new_tag_string);

        $adds = array();
        $dels = array();
        //adds为需要增加的tags dels需要删除的tags
        !$new_tag_string || $adds = array_diff($new_tags, $old_tags);
        !$old_tag_string || $dels = array_diff($old_tags, $new_tags);

        echo $this->my_model->tag_save($adds, $dels, $type, $tag_title, $tag_des);
        
    }

    /**
     * 新增tag 的ajax入口函数
     */
    public function add_tag(){

        $tag_name = $_POST['name'];
        $tag_des  = $_POST['des'];
    
        echo $this->my_model->tag_add($tag_name, $tag_des);

    }

    /**
     * 
     */
    protected function rule_tag(){
        if(empty($this->advance_cahce_tag)){
            $tag_types = $this->my_model->get_tag_type();
            $tag = $this->my_model->get_tag();
    
            foreach ($tag as $key => $value) {
                    if(!array_key_exists($value['type'], $this->advance_cahce_tag)){
                        //不存在则新增
                        $this->advance_cahce_tag[$value['type']] = array(
                            'place' => array(),
                            'title' => $tag_types[$value['type']]['title'],
                            'des' => $tag_types[$value['type']]['des'],
                            'type' => $value['type']
                        );
                 }
                 array_push($this->advance_cahce_tag[$value['type']]['place'], ['name' =>$value['name'],'url'=>$value['url'] ]);
            }
        }
    }


    /**
     * 处理出入格式
     */
    protected function rule_tag_edit(){

        if(empty($this->advance_cache_tag_edit)){
            $tag_types = $this->my_model->get_tag_type();
            $tag = $this->my_model->get_tag();
    
            foreach ($tag as $key => $value) {
                    if(!array_key_exists($value['type'], $this->advance_cache_tag_edit)){
                        //不存在则新增
                        $this->advance_cache_tag_edit[$value['type']] = array(
                            'place' => '',
                            'title' => $tag_types[$value['type']]['title'],
                            'des' => $tag_types[$value['type']]['des'],
                            'id'  => 'tag_type'.$value['type'],
                            'type' => $value['type']
                        );
                 }
                 $this->advance_cache_tag_edit[$value['type']]['place'] .= $value['name'].'|';
            }
            //去除末尾的逗号
            foreach ($this->advance_cache_tag_edit as $key => &$value){
                $value['place'] = substr($value['place'], 0, -1);
            }
            foreach ($tag_types as $key => $item) {
                if(!array_key_exists($key, $this->advance_cache_tag_edit)){
                    //  说明此时的type中 , 还没有一个tag
                    $this->advance_cache_tag_edit[$key] = array(
                        'place' => '',
                        'title' => $item['title'],
                        'des' => $item['des'],
                        'id'  => 'tag_type'.$key,
                        'type' => $key
                    );
                }
            }
        }


    }



}