<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\LogInModel;
use Home\Model\LovingValueRecordModel;
class LovingValueController extends Controller {


    protected $user;   // 控制user的信息
    protected $loving_value_record; // 控制好感记录

    /**
     * 构造函数
     */
    public function __construct(){

        $this->user = D('LogIn');
        $this->loving_value_record = D('LovingValueRecord');

        parent::__construct(); 
    }

    /**
    * 根据传入的cookies 验证id
    */
    protected function validate_id(){

        $cookie_id = intval(I("cookie.id"),0);

        if(!$cookie_id) {
            echo "you don't have access!";
            exit();
        }
        return $cookie_id;

    }

    /**
     * 更新好感值
     */
    public function update(){
        // 获得 我的id 
        $my_id = $this-> validate_id();

        // 获得数据
        $comment = I('post.comment');
        $current_loving = I('post.current_loving');
        $to = intval(I('post.to'), 0);
        $up_down = I('post.up_down');
        
        echo json_encode($this->loving_value_record->update_loving($comment, $current_loving, $to, $my_id, $up_down));

    }



    
    /**
     * 显示别人对我的好感评价
     */
    public function ToMe(){

        // 获得我的id
        $my_id = $this->validate_id();

        // 获得对我的当前评价
        $loving_info = $this->loving_value_record->get_loving_info('to',$my_id);
        $lover_id = $loving_info['from'];


        // 获得用户信息 
        $my_info = $this->user->get_true_user_info($my_id);
        $lover_info = $this->user->get_true_user_info($lover_id);


        $this->assign("my_info", $my_info);
        $this->assign("lover_info", $lover_info);
        $this->assign("loving_info", $loving_info);

        $this->display("LovingValue/ToMe"); 

    }    



    /**
     * 显示我对别人的好感评价
     */
    public function FromMe(){

        $my_id = $this->validate_id();

        // 获得我对别人的当前评价
        $loving_info = $this->loving_value_record->get_loving_info('from',$my_id);
        $lover_id = $loving_info['to'];

        // 获得用户信息 
        $my_info = $this->user->get_true_user_info($my_id);
        $lover_info = $this->user->get_true_user_info($lover_id);


        $this->assign("my_info", $my_info);
        $this->assign("lover_info", $lover_info);
        $this->assign("loving_info", $loving_info);




        $this->display("LovingValue/FromMe");


    }   




}
