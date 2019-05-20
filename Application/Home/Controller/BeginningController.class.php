<?php
namespace Home\Controller;
use Think\Controller;
class BeginningController extends Controller {
    public function index(){
        $this->display("Beginning/my_520");
        // $this->display('Beginning/index');  
    }

    public function Beginning(){

        $this->display('Beginning/index'); 
        
    }

    
}
