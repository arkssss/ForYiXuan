<?php
namespace Home\Controller;
use Think\Controller;
class DailyBoardController extends Controller {
    public function index(){
        echo "hello this is ark's Daily Board";
  }
  /**
   * 留言文章上传
   */
   public function Edit(){

     $this->display("DailyBoard/Edit");

   }

   /**
    * 图片上传
    */
   public function upload(){

    // $return_data = [

    //     "errno" => 0,
    
    //     "data" => [
    //         "#",
    //     ]
    //     ];
        
    // echo json_decode($return_data);
    $imgInfo = $_FILES['myFileName'];
    var_dump($imgInfo);
    // 图片名称
    $oldname = $imgInfo['name'];
    // 临时文件
    $tmp_name = $imgInfo['tmp_name'];
    // 错误信息
    $error = $imgInfo['error'];
    // 分割字符串，得到数组。
    $temp = explode(".",$oldname);
    // 用时间戳 + 文件后缀 重命名文件。
    $newname = time().".".$temp[count($temp)-1];
    // 在服务上移动图片到指定目录。
    move_uploaded_file($tmp_name,__ROOT__."/".$newname);
    // 返回图片路径，类似ajax的响应流程。
    $ret = [
        'error' => $error,
        'data' => [
            __ROOT__."/".$newname
        ]
    ];
    echo json_encode($ret);


   }
}
