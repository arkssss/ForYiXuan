<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function Login(){

        
        if(IS_POST){

            $username = I('post.username');
            $password = I('post.password');


            $map['username'] = $username;
            $map['password'] = $password;




            if(M('user')->where($map)->select()){

                $herf = U('ViewItem/index');
                // header($herf); 
                header("Location: ".$herf.""); 

            }else{  
                
                echo " <script> alert('Account dose not exist');
                        history.go(-1);
                        </script>";

            }

        }else{

            $this->display();
            
        }

        
    }

    public function Register(){

        if(IS_POST){

        $data['username'] = I('post.username');
        $data['password'] = I('post.password');
        $data['phone'] = I('post.phone');
        $data['email'] = I('post.email');

        // var_dump($data);

        if(M('user')->add($data)){

            // echo " <script> alert('register success');
            // history.go(-1);
            // </script>";
            $herf = U('Login');
            header("Location: ".$herf.""); 
            

        }else{

            echo " <script> alert('register fail');
            </script>";
        }
    }else{

        $this->display();

    }
    }

}