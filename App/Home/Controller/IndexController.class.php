<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
//        解决跨域请求问题
        header('Access-Control-Allow-Origin:http://angular_1.0_client.com');
        header("Content-Type: application/json; charset=UTF-8");
        $re=M("user")->select();
        foreach($re as $key=>$value ){
            $sex=($value['f_sex']==1)?"男":"女";
            $value['f_sex']=$sex;
            $re[$key]=$value;
        }
        $result["list"]=$re;
        echo json_encode($result,true);
    }
}