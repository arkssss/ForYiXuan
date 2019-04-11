<?php
namespace Home\Model;
use Think\Model;


/**
 * 处理好感记录的数据表
 */
class LovingValueRecordModel extends Model {

    //保存了当前的好感值 
    protected $loving_value_table = "loving_value";

    // 保存了当前好感值的历史加减记录
    protected $loving_value_table_record = "loving_value_record";



    // ----------------- 提取数据层

    // 根据我的id 获得 对当前我的好感评价
    public function get_loving_info($action="", $my_id){

        $map[$action] = $my_id;

        $info = M($this->loving_value_table)->where($map)->find();



        return $info;

    }


    // ----------------- 保存数据层

    /**
     * 给field_name 字段跟新为 update_value
     */
    public function update_field($field_name, $update_value, $map){

       return M($this->loving_value_table)->where($map) -> setField($field_name,  $update_value);

    }
    
    public function update_loving($comment, $current_loving, $to, $from, $up_down){

        $ret = [];
        if(!$to || !$from) {
            $ret['status'] = 0;
            $ret['msg'] = C('AJAX_RETURN_TEXT.PROFILE_SAVE_FAIL');
            return $ret;
        }
        //启动事务
        M()->startTrans();

        $map['from'] = $from;
        $map['to'] = $to;

        $data['value'] = $current_loving;
        $data['up_down'] = $up_down; // 上升还是下降了 
        $data['comment'] = $comment; // 最新的一条评论
        $data['has_update'] = 1;    // 表示跟新位 
        // 更新表1
        $update1 = M($this->loving_value_table)->where($map)->save($data);

        // 更新表2
        $data2['time'] = date("Y-m-d H:i:s",time());
        $data2['from'] = $from;
        $data2['to']  = $to;
        $data2['comment'] = $comment;
        $data2['value'] = $current_loving;
        $update2 = M($this->loving_value_table_record) ->add($data2);


        if($update1 && $update2){
            // 更新成功
            // 事务提交
            M()->commit();
            $ret['status'] = 1;
            $ret['msg'] = C('AJAX_RETURN_TEXT.LOVING_VALUE_UPDATE_SUCCESS');
            
        }else{
            // 跟新失败s
            M()->rollback();
            $ret['status'] = 0;
            $ret['msg'] = C('AJAX_RETURN_TEXT.PROFILE_SAVE_FAIL');
        }


        return $ret;


    }







}