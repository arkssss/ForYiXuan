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

}