<?php
namespace Home\Controller;
use Think\Controller;
class TypeController extends BaseController{
    public function index(){
    	$name = session('name');
    	if(!$name){
   			$this->error("请登录", U('User/Login'),2);
    	}                                       //公共获取侧边栏方法
		$type=M('user');
		$data=$type->select();
		$this->left('type');
		
		$this->assign("data",$data);   
		$this->display();
    }
	/*
	 *权限组操作（权限列表） 
	 */
	public function typelist(){
    	$name = session('name');
    	if(!$name){
   			$this->error("请登录", U('User/Login'),2);
    	}
		$this->left('type');
		$type=M('type');
		$data=$type->select();
		
		$this->assign("data",$data);   
		$this->display();
    }
	/*
	 *权限组操作（添加权限） 
	 */
	public function addtype(){
	 	$this->left('type');
		$state=I("get.state");
		$id=I("get.id");
		$data['typename']=I('post.name');
		$data['state']=I('post.state');
		$data['time']=date("y-m-d");
		$data['dis']=I('post.dis');
		$data['content']=I('post.content');
		
		if($data['typename']!=""){
			$type=M('type');
			$var=$type->data($data)->add();
			if($var!=0){
				$this->redirect('Type/addtype');
			}else{
				$this->error("操作有误",U("Type/addtype"),1);
			}
		}else{
			if($state=="detail"){
				$type=M('type');
				$detail=$type->where("id=".$id)->select();
				$this->assign("detail",$detail);	
			}
			$this->display();
		}	 	
	 }
	 /*
	  *权限组操作 （修改权限状态）
	  */
	 public function typestate(){
	 	$data['state']=I('get.var');
		$id=I("get.id");
		
		$type=M('type');
		
		$var=$type->where("id=".$id)->save($data);
		if($var==1){
			$this->redirect('Type/typelist');
		}else{
			$this->error("操作有误",U("Type/typelist"),1);
		}
	 }
	 /*
	  * 修改用户组
	  */
	 public function accredit(){
	 	$this->left('type');
		$typeid=I("get.typeid");	//获取用户typeid
		$id=I("get.id");		 	//获取当前用户id第一次
		$ids=I("get.ids");			//获取当前用户id第二次
		$rank=I("post.rank");
		$type=M('usergroup');
		$user=M('user');
		
		$var=$type->where("`name`='$typeid'")->select();   	//TODO 查询当前名称
		$var1=$type->select();								//TODO 查询所有数据
		
		if($ids!=""){
			$data['typeid']=$rank;
			$val=$user->where("`id`=".$ids)->save($data);
			echo "ok";
			exit;
		}
		
		$this->assign("var",$var);
		$this->assign("var1",$var1);
		$this->assign("id",$id);
		$this->display();	
	 }
	 /*
	  * 删除用户 
	  */
	public  function deleteaccount(){
		$id=I("get.id");
		$type=M('user');
		
		$type->where("`id`=".$id)->delete();
		$this->redirect("Type/index");
	}
	/*
	 * 用户组操作
	 */
	public function userlist(){			//用户组列表
		$this->left('type');
		$type=M('usergroup');
		$data=$type->select();
		
		$this->assign('data',$data);
		$this->display();
	}
	public function usertype(){	
		$id=I("get.id");
		$name=I("get.name");

		$typenames=I("get.typenames");
//		echo $typenames;
//		exit;
		$typenamee=I("get.typenamee");
		//获取传参
		$this->left('type');
		$type=M('type');
		$user=M('usergroup');
		
		
		if($typenames!=""){						//离权
				
				$data=$user->where("`name`='$name'")->select();
				$val['replenish']=str_replace(','.$typenames,'',$data[0]['replenish']);

				$var=$user->where("`name`='$name'")->save($val);
				//离权修改

				if($var==1){
					
					$this->redirect("Type/usertype?id=".$data[0]['id']);
				}else{
					
					$this->error("操作有误",U("Type/usertype?id=".$data[0]['id']),1);
				}	
				//离权跳转	
			}elseif($typenamee!=""){				//授权
			
				$data=$user->where("`name`='$name'")->select();
				$val['replenish']=','.$typenamee.$data[0]['replenish'];

				$var=$user->where("`name`='$name'")->save($val);
				//授权修改

				if($var==1){
					
					$this->redirect("Type/usertype?id=".$data[0]['id']);
				}else{
					
					$this->error("操作有误",U("Type/usertype?id=".$data[0]['id']),1);
				}	
				//授权跳转
				
			}else{
				$var=$type->select();
				$data=$user->where("id=".$id)->select();
				//查询基本信息	
				$this->assign("data",$data);
				$this->assign("var",$var);
				$this->display();
		}
	}
	/*
	 * 行为组操作
	 */
	public function actionlist(){
		$this->left('type');
		$type=M('typerule');
		$data=$type->select();
		
		$this->assign('data',$data);
		$this->display();
	}
}