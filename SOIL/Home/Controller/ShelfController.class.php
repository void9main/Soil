<?php
namespace Home\Controller;
use Think\Controller;
class ShelfController extends BaseController {
    public function index(){
    
	$this->redirect('Index/Shelf/index');
	exit;
	//重定向构架系统来源	
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