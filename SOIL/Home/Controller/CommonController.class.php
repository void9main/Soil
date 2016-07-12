<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends BaseController {
    public function index(){
    $name = session('name');
	if(!$name){
   			$this->error("请登录", U('User/Login'),2);
		}else{
			$this->left('common');                                         //首页平台方法
			
			$Com=M('company');
			$com=$Com->where("`type`='common'")->select(); 
			$this->assign("com",$com); 
			
			$this->display();
		}  
    }
}