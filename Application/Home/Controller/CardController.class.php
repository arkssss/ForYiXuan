<?php
namespace Home\Controller;
use Think\Controller;
class CardController extends Controller {

    /**
     * 构造函数
     */
    public function __construct(){

        parent::__construct(); 
    }

    public function index(){

        $this->validate_id(1); // 访问记录

        $this->display();  

    }

    
}
