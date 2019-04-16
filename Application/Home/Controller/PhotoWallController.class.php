<?php
namespace Home\Controller;
use Think\Controller;
class PhotoWallController extends Controller {

    /**
     * 构造函数
     */
    public function __construct(){

        parent::__construct(); 
    }
    public function index(){

        $this->validate_id(1);
        $this->display();  
        
    }
}