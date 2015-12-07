<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
//        解决跨域请求问题
        $this->init();
        $re=M("user")->select();
        foreach($re as $key=>$value ){
            $sex=($value['f_sex']==1)?"男":"女";
            $value['f_sex']=$sex;
            $re[$key]=$value;
        }
        $result["list"]=$re;


        echo json_encode($result,true);
    }

    public function  modData(){

        //解决跨域请求问题
        $this->init();
        echo var_dump(I("post.msg"));
        exit;
        //获取数据添加到数据库
        $map['f_id']=I("post.f_id");
        $map['f_name']=I("post.f_name");
        $map['f_sex']=I("post.f_sex");
        $map['f_phone']=I("post.f_phone");

        if(I("post.f_id")){
            //添加
            $re2=M("user")->add($map);
        }else{
            //编辑
            $re2=M("user")->save($map);

        }
    }

    public  function  init(){
        header('Access-Control-Allow-Origin:http://angular_1.0_client.com');
        header('Access-Control-Request-Method: GET, POST');
        header('Access-Control-Allow-Credentials: true');
    }

}