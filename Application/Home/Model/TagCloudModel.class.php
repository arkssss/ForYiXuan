<?php
/**
 * 处理TagCloud的专用的数据库操作类
 */
namespace Home\Model;
use Think\Model;
class TagCloudModel extends Model {


/**
 * 数据表名
 */
protected $trueTagTable = 'tag';
protected $trueTagTypeTable = 'tag_type';

/**
 * 定义缓存名
 */
protected $cache_tag = 'tag';
protected $cache_tag_type = 'tag_type';

/**
 * cache 常量, 保存时间
 */
protected $cache_time = 1;
protected $cache_type = 'xcache';


public function hello(){

    echo "hello_mymodel";

}

//   --------------------- cache 层
/**
 * 获取tag_type的值
 */
public function get_tag(){

    return $this->realget_tag();

}

/**
 * 获取所有tag
 */
public function get_tag_type(){


    $raw_tagtype = $this->realget_tag_type();
    $pure_tagtype = array();
    // 提取ID作为数组的key 
    foreach ($raw_tagtype as $key => $value) {
        $pure_tagtype[$value['id']] = array(
            'title' => $value['name'],
            'des' => $value['des']
        );
    }   

    return $pure_tagtype;


}



// --------------------- 数据提取 层 

protected function realget_tag_type(){

    return M($this->trueTagTypeTable)-> select();

}

protected function realget_tag(){
    return M($this->trueTagTable)->select();
}


// ---------------------- 数据更新 层
public function tag_save($adds ,$dels, $type, $tag_type_name = "", $tag_type_des = ""){


    $tag_model = M($this->trueTagTable);
    $tag_type_model = M($this->trueTagTypeTable);

    $tag_model -> startTrans();
    $dels_tag = true ; $add_tag = true; $update_type = true;
    if(!empty($dels)){
        //先删除
        $map['name'] = array('IN', $dels);
        $map['type'] = $type;
        $dels_tag = $tag_model->where($map)->delete();
    }

    if(!empty($adds)){
    //后添加    
        $datalist = [];
        foreach ($adds as $key => $value) {
            array_push($datalist, array('type'=>$type, 'name'=> $value, 'url' => '#'));
        }
        $add_tag = $tag_model -> addAll($datalist);
    }
    $data = [];
    if(!empty($tag_type_name)) $data['name'] = $tag_type_name;
    if(!empty($tag_type_des)) $data['des'] = $tag_type_des;
    if(!empty($data)){
        $update_type = $tag_type_model->where(['id'=>$type])->save($data);
    }
    if($dels_tag && $add_tag && $update_type) {
        $tag_model->commit();
        // return "小任任保存成功啦~~";
        return C('AJAX_RETURN_TEXT.SAVE_SUCCESS');
    }else{
        $tag_model->rollback();
        return C('AJAX_RETURN_TEXT.SAVE_FAIL');
    }




}

/**
 * 新增足迹
 */
public function tag_add($name, $des){

        $data['name'] = $name;
        $data['des'] = $des;
        M($this->trueTagTypeTable)->data($data)->add();
        return C("AJAX_RETURN_TEXT.ADD_SUCCESS");
        
}


/**
 * 删除足迹
 */
public function tag_del($type = "", $places = ""){


    if(!empty($type)){
        $tag_model = M($this->trueTagTable);
        $tag_type_model = M($this->trueTagTypeTable);

        $tag_model -> startTrans();

        $tag_flag = true ; $tag_type_flag = true;
        //如果没有tag, 则没有必要去删除
        !$places || $tag_flag = $tag_model->where(['type' => $type])->delete();
        $tag_type_flag = $tag_type_model -> where(['id'=>$type]) ->delete();
        if($tag_type_flag && $tag_flag){
            $tag_model->commit();
            return C("AJAX_RETURN_TEXT.DEL_SUCCESS");
        }else{
            $tag_model->rollback();
        }
    }

    return C("AJAX_RETURN_TEXT.SAVE_FAIL");


}




}



?>