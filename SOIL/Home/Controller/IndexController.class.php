<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
    $name = session('name');
	if(!$name){
   			$this->error("请登录", U('User/Login'),2);
		}else{
			                                         
			$this->left(); 					//首页平台方法
			$this->type_check();
			$this->display();
		}  
    }
}