<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
//        解决跨域请求问题
        $this->init();
        $re=$this->getuser();
        $result["list"]=$re;
        $this->pushconfig($result);
    }

    public function  modData(){
        //解决跨域请求问题
        $this->init();
        //获取数据添加到数s据库
        if(I("get.f_id")==""){
            //添加
            $re2=M("user")->add($_GET);
        }else{
            //编辑
            $re2=M("user")->save($_GET);
        }

        if($re2>0){
            $re=$this->getuser();
            $result["error_code"]="000000";
            $result["list"]=$re;
        }else{
            $result["error_code"]="100000";
        }
         $this->pushconfig($result);
    }

    public function  deldata(){
        $this->init();
        $re=M("user")->where("f_id=".$_GET["id"])->delete();
        if($re!=0){
            $re=$this->getuser();
            $result["list"]=$re;
            $result["error_code"]="000000";

        }else{
            $result["error_code"]="100000";
        }
         $this->pushconfig($result);
    }

    public  function  init(){
        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Headers: X-Requested-With');
        header('Access-Control-Allow-Methods:GET, POST');
    }


    //获取表信息
    public function  getuser(){
        $re=M("user")->select();
        foreach($re as $key=>$value ){
            $sex=($value['f_sex']==1)?"男":"女";
            $value['f_sex']=$sex;
            $re[$key]=$value;
        }
        return $re;
    }

    public function  pushconfig($data){
        echo json_encode($data,true);
    }

}