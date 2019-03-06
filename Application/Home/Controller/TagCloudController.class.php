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

        // 采取直接渲染的方式是为了
        $this->rule_tag();
        $this->assign('tags', $this->advance_cahce_tag);
        $this->display();  
    }

    /**
     * 编辑tag界面
     */
    public function EditTag(){

        // 拿数据
        $this->rule_tag_edit();
        $this->assign('fixplace', $this->advance_cache_tag_edit);
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

        //新老tag 的数组
        $old_tags = explode(',', $old_tag_string);
        $new_tags = explode(',', $new_tag_string);

        //adds为需要增加的tags dels需要删除的tags
        $adds = array_diff($new_tags, $old_tags);
        $dels = array_diff($old_tags, $new_tags);
        
        echo $this->my_model->tag_save($adds, $dels, $type);
        
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
     * 
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
                 $this->advance_cache_tag_edit[$value['type']]['place'] .= $value['name'].',';
            }
        }

    }



}