<?php
namespace Home\Controller;
use Think\Controller;
class ShelfController extends BaseController {
    public function index(){
    $name = session('name');
	if(!$name){
   			$this->error("请登录", U('User/Login'),2);
		}else{
			$this->left('shelf');
			
			$this->assign("name",$name);
			$this->assign("test",$test);
			$this->display();
		}  
    }
}