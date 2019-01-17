<?php
namespace Home\Controller;
use Think\Controller;
class TagCloudController extends Controller {

    /**
     * 去过地方的数据库
     */
    protected $Tag_done_place = 'tag_done_place';
    protected $Tag_done_title = "和艺璇去过的地方!";
    protected $Tag_done_des = "想在全天下都留下和艺璇的足迹!";
    

    /**
     * cache 
     */
    protected $Cached;

    public function index(){

        $this->toggle_place_cache();
        // 采取直接渲染的方式是为了
        $this->assign('places', $this->Cached['place_cache']);
        $this->display();  
    }

    
    public function EditTag(){
        $this->toggle_place_cache();
        
        $place = $this->Cached['place_cache'];
        $fixplace = array();

        foreach ($place as $kindsof_places) {
            $string_place = "";
            foreach ($kindsof_places['place'] as $value) {
                $string_place .= $value['name'].",";
            }
            $tmp['place'] = substr($string_place, 0, strlen($string_place));
            $tmp['title'] = $kindsof_places['title'];
            $tmp['des'] = $kindsof_places['des'];
            array_push($fixplace, $tmp);
        }

        $this->assign('fixplace', $fixplace);
        $this->display();
    }




    /**
     * 设置places 的值
     */
    public function AJAX_set_EditTag_value(){
        
        $this->toggle_place_cache();
        $this->ajaxReturn($this->Cached['place_cache']);

    }



    /**
     * 设置place缓存
     */
    protected function toggle_place_cache(){
        // 获取值
        if(!isset($this->Cached['place_cache'])){
            return $this->Cached['place_cache'] = $this->get_all_place();
        }
        return $this->Cached['place_cache'];
    }


    /**
     * 数据库交互函数
     */
    protected function get_all_place(){


        $places = array();
        $DonePlaces = M($this->Tag_done_place) ->select();

        $places['DonePlaces']["place"] = $DonePlaces;
        $places['DonePlaces']['title'] = $this->Tag_done_title;
        $places['DonePlaces']['des'] = $this->Tag_done_des;

        return $places;

    }


}