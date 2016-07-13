<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller {
    public function left($type){
        $list=M('left');  
		$data=$list->where("`type`='$type'")->select();
		
		$top=M('top');
		$rank=session('rank');
		if($rank=="super"){
		
			$var=$top->select(); 
		}else{
		
			$var=$top->where("`type`='$rank'")->select();               //TODO //修改权限方式	
		}
		
		$this->assign("top",$var);
		$this->assign("list",$data);
    }
	Public function verify(){				//TODO 验证码生成函数
        import('ORG.Util.Image');
        Image::buildImageVerify();
    }
	public function type_check(){ 			//TODO 获取当前用户权限数组，前台使用
	
		$name=session('name');
		$rank=M('user');
		$var=$rank->where("`name`='$name'")->select();
		   
		session('rank',$var[0]['typeid']);
		
	}
	public function page_limit($type,$num){				//分页函数
		
		$User = M($type); 								
		//  实例化User对象 TODO
		
		// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
		$list = $User->where('status=1')->order('create_time')->page($_GET['p'].",'$num'")->select();$this->assign('list',$list);
		// 赋值数据集
		$count      = $User->where('status=1')->count();
		// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,$num);		
		// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();					
		// 分页显示输出
		$this->assign('page',$show);					
		// 赋值分页输出
		$this->display(); 								
		// 输出模板	
	}
}