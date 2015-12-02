<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
//        解决跨域请求问题
        header('Access-Control-Allow-Origin:http://angular_1.0_client.com');
        header("Content-Type: application/json; charset=UTF-8");
        $re=M("user")->select();
        $result["list"]=$re;
        echo json_encode($result,true);
    }
}