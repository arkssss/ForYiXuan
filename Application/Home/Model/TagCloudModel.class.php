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
public function tag_save($adds ,$dels, $type){

    if(empty($adds) && empty($dels)){

        return "小任你没有更新数据!";

    }else{
        $tag_model = M($this->trueTagTable);
        
        if(!empty($dels)){
            //先删除
            $map['name'] = array('IN', $dels);
            $map['type'] = $type;
            $tag_model->where($map)->delete();
        }
        $datalist = [];
        if(!empty($adds)){
        //后添加    
            foreach ($adds as $key => $value) {
                array_push($datalist, array('type'=>$type, 'name'=> $value, 'url' => '#'));
            }
            $tag_model -> addAll($datalist);
        }
        
        return "恭喜小任更新成功啦!";

    }


}



}



?>