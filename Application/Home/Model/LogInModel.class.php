<?php
/**
 * 处理的LogIn逻辑专用的数据库操作类
 */
namespace Home\Model;
use Think\Model;

class LogInModel extends Model {

    protected $UserTrueTable = "user";




    /** cache 层 */
    public function get_user_info($id){
        
        if(I("session.user") == null) {

            $_SESSION['user'] = $this->get_true_user_info($id);
       
        } 
        return I("session.user");

    }



    // ---- 取数据
    public function get_true_user_info($id) {


        $map['id'] = $id;

        return M($this->UserTrueTable) -> where($map) -> find();
        

    }

    /**
     * 根据所有的ids 取用户
     */
    public function get_true_all_user_by_ids($ids){

        if(empty($ids)) return null;    

        $map['id'] = array('in', $ids);
        return  M($this->UserTrueTable) -> where($maps) ->select();


    }




    // ---- 数据更新 

    /**
     * 更新用户的信息
     */
    public function update_user_info($id, $update_profile){


        $map['id'] = $id;
        $save_success = M($this->UserTrueTable) -> where($map) -> save($update_profile);

        //返回数组
        $ret = [];

        if($save_success){

            //保存成功, 删除session
            unset($_SESSION['user']);
            $ret['status'] = 1;
            $ret['msg'] = C("AJAX_RETURN_TEXT.PROFILE_SAVE_SUCCESS");

        }else{
            $ret['status'] = 0;
            $ret['msg'] = C("AJAX_RETURN_TEXT.PROFILE_SAVE_FAIL");
            
        }

        return $ret;



    }


    /**
     * 改密码
     */
    public function change_password($id, $password){

        $map['id'] = $id;
        $data['password'] = md5($password);
        $old_password =  M($this->UserTrueTable) -> where($map) -> getField('password');
        $ret = [];

        if ($data['password'] == $old_password) {
            //新老密码一样
            $ret['status'] = 0;
            $ret['msg'] = C('AJAX_RETURN_TEXT.PASSWORD_CHANGE_THE_SAME');
            return $ret;
        }

        $success = M($this->UserTrueTable) -> where($map) -> save($data);
        if($success){

            $ret['status'] = 1;
            $ret['msg'] = C('AJAX_RETURN_TEXT.PASSWORD_CHANGE_SUCCESS');

        }else{

            $ret['status'] = 0;
            $ret['msg'] = C('AJAX_RETURN_TEXT.PROFILE_SAVE_FAIL');

        }

        return $ret;

    }


    /**
     * 登陆验证
     */
    public function validate_login($username="", $password=""){

        //返回数据
        $ret = array();

        if(empty($username) || empty($password)){

            $ret['msg'] = C("AJAX_RETURN_TEXT.NOT_EMTPY");
            $ret['status'] = '0';

        }else{
            $map['username'] = $username;
            $map['password'] = md5($password);
            $user = M($this->UserTrueTable) -> where($map) -> find();
            if($user){

                $ret['msg'] = C("AJAX_RETURN_TEXT.ACCOUNT_PASS");
                $ret['status'] = '1';
                //password 不能传会前端
                unset($user['password']);
                $ret['data'] = $user;
                //设置session 缓存
                $_SESSION['current_user'] = $user;

            }else{
                
                $ret['msg'] = C("AJAX_RETURN_TEXT.ACCOUNT_ERROR");
                $ret['status'] = '0';

            }

        }
        
        return $ret;

    }

}