<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends BaseController {
	 
    public function login(){   //登录
    
  		$name=I("post.name");
		$pwd=I("post.pwd");
		if($name==""){
			$this->display();
		}else{
		
		$User=M('user');
		
		$var=$User->where("name='$name'")->select(); 
		   	if($var[0]["password"]==md5($pwd)){
		   		$this->success("成功登录",U("Index/index"),2);
				session('name',$name);       			//设置名称session
				$this->type_check();
				session('rank');						//权限数组
				
		   	}else{
		   		$this->error("账号或密码不对",U("User/login"),2);
		   	}
		}
    }

	public function register(){   //注册
		$data['name']=I("post.name");
		$name['name']=$data['name'];
		$data['typeid']=I("post.typeid");
		$pwd1=I("post.pwd1");
		$pwd2=I("post.pwd2");
		$db=M('type');
		$User=M('user');
		if($data['name']!=""){
			if($pwd1!=$pwd2){
				$this->error('两次输入的密码不一致',U("User/register"),2);
				exit;
			}else{
				$data['password']=md5($pwd1);
				$var1=$User->where($name)->select();
				if($var1[0]['name']!=""){
					$this->error('此名称已经有人注册',U("User/register"),2);
				}else{
					$var2=$User->data($data)->add();
					if($var2==FALSE){
						$this->error("注册失败，联系管理员",U("User/register"),1);
					}else{
						$this->success("注册成功",U("Index/index"),1);
					}
				} 
			}	
		}else{
			$var=$db->select();

			$this->assign("type",$var);
			$this->display();
		}
	}
	
	public function logout(){
		session('name',null);
		$name = session('name');
		if(!$name){
			$this->redirect("User/Login");
		}
	}
}