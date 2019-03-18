<?php
/**
 * 处理的comment 的 model 类
 */
namespace Home\Model;
use Think\Model;
use Home\Model\Login;

class CommentModel extends Model {


    protected $TrueTable = "comment";
    // protected $DailyBoardTrueTable = "dailyboard";


    /**
     * 保存评论
     */
    public function save_saying_comment($author_id, $html, $text, $saying_id){

        $data['author'] = $author_id;
        $data['saying_id'] = $saying_id;
        $data['text'] = $text;
        $data['html'] = $html;
        $data['time'] =  $data['time'] = date("Y-m-d H:i:s",time());  //今日时间 格式为Y-m-d H:i:s

        //存储冗余的用户数据, 便于在提取的时候少查一次数据库
        $author_info = D('LogIn')->get_true_user_info($author_id);
        $ret = [];

        if(!$author_info) { $ret['status'] = 0; $ret['msg'] = C('AJAX_RETURN_TEXT.PROFILE_SAVE_FAIL'); return $ret;} 

        $data['author_nickname'] = $author_info['nickname'];
        $data['author_face_img'] = $author_info['face_img'];

        $success = M($this->TrueTable)->add($data);
 
        if($success){
            $ret['status'] = 1;
            $ret['msg'] = C('AJAX_RETURN_TEXT.SAYING_COMMENT_SUCCESS');
        }else{
            $ret['status'] = 0;
            $ret['msg'] = C('AJAX_RETURN_TEXT.PROFILE_SAVE_FAIL');
        }

        return $ret;
    }

        


    /**
     * 获取评论
     */
    public function get_saying_comments($saying_id){


        $map['saying_id'] = $saying_id;

        return $saying_comments = M($this->TrueTable)->where($map)->select();


    }


}