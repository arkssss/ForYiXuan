<?php
/**
 * 处理的DailyBoard专用的数据库操作类
 */
namespace Home\Model;
use Think\Model;

class DailyBoardModel extends Model {

    /**
     * 操作的数据表名
     */
    protected $TrueTable = "dailyboard";



    // ------ 验证操作
    /**
     * 验证saying是否是属于user
     */
    public function check_ones_saying($user_id, $saying_id){

        //不存在返回空
        if(!$saying_id || !$user_id) return null;

        $map['id'] = $saying_id;
        $map['author'] = $user_id;

        return M($this->TrueTable)->where($map)->find();
    }



    // ------ 读取操作 
    public function get_one_saying($id=""){

        if($id){

            $map['id'] = $id;

            $the_saying = M($this->TrueTable)->where($map)->find();

            if($the_saying) {
                
                return $the_saying;

            }else{
                
            }


        }
        
    }   

    /**
     * 过去一个人的所有文章
     */
    public function get_ones_all_saying_textonly($id){

        $map['author']= $id;

        // 注意 getField 的第一个字段则为筛选出来的二维数组的key值 如此id
        return M($this->TrueTable)->where($map)->order("id desc")->getField('id,text,time');
    }


    //读取所有
    public function get_all_saying(){

        return M($this->TrueTable)->order("id desc")->select();
        
    }





    // ------ 存储操作
    public function true_add($author, $html, $text, $reader){

        // if(!$text) 

        // need vaildate code ...  
        $data['author'] = $author;
        $data['reader'] = $reader;
        $data['time'] = date("Y-m-d H:i:s",time());  //今日时间 格式为Y-m-d H:i:s
        $data['html'] = $html;
        $data['text'] = $text;

        $res = M($this->TrueTable)->add($data);

        $ret = [];

        if($res){
            $ret['status'] = 1;
            $ret['msg'] = C("AJAX_RETURN_TEXT.SAVE_DAILYBOARD_SUEECSS");
        }else{
            $ret['status'] = 0;
            $ret['msg'] =  C("AJAX_RETURN_TEXT.SAVE_FAIL");
        }

        return $ret;
    
    }

    /**
     * 删除
     */
    public function del_saying($user_id, $saying_id){

        $map['author'] = $user_id;  
        $map['id'] = $saying_id;

        $res = M($this->TrueTable)->where($map)->delete();
        $ret = [];
        if($res){
            $ret['status'] = 1;
            $ret['msg'] = C("AJAX_RETURN_TEXT.SAYING_DEL_SUCCESS");
        }else{
            $ret['status'] = 0;
            $ret['msg'] = C("AJAX_RETURN_TEXT.PROFILE_SAVE_FAIL");
            $ret['info'] = [
                'user_id' => $user_id,
                'saying_id' => $saying_id,
            ];
        }
        return $ret;

    }



    /**
     * 编辑操作
     */
    public function true_edit($saying_id, $author, $html, $text, $reader){

        $data['reader'] = $reader;
        $data['html'] = $html;
        $data['text'] = $text;

        $map['id'] = $saying_id;
        $map['author'] = $author;

        $res = M($this->TrueTable)->where($map)->save($data);

        $ret = [];

        if($res){
            $ret['status'] = 1;
            $ret['msg'] = C("AJAX_RETURN_TEXT.SAVE_DAILYBOARD_SUEECSS");
        }else{
            $ret['status'] = 0;
            $ret['msg'] =  C("AJAX_RETURN_TEXT.SAVE_FAIL");
        }

        return $ret;


    }


}