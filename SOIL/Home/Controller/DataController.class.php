<?php
namespace Home\Controller;
use Think\Controller;
class DataController extends BaseController {
    	
    public function index(){     			 //读取所有表
    $name = session('name');
	if(!$name){
   			$this->error("请登录", U('User/Login'),2);
	}
		$this->left('data');
		
		$db=M();
		$data=$db->query($sql = 'show table status');

		$this->assign("data",$data);
		
		$this->display();
			
    }
	public function addtab(){     			//创建表
		$name=I("post.name");
		$utf=I("post.utf-8");
		$comment=I("post.comment");
		
		$this->left('data');
		if($name==""){
			$this->display();
		}else{
		$sql="
		CREATE TABLE `$name` (
		  `Id` int(11) NOT NULL AUTO_INCREMENT,
		  PRIMARY KEY (`Id`)
		) ENGINE=MyISAM DEFAULT CHARSET='$utf' COMMENT='$comment'";
		$var= M()->execute($sql,true);
		if($var==0){
			$this->success("表格创建成功",U("Data/index"),1);
			}	
		}
	}
	public function change_row_fom(){     	//更改动态行格式
		$name=I("get.name");
		
		$sql="ALTER TABLE `$name` ROW_FORMAT = DYNAMIC";
		$var= M()->execute($sql,true);
		if($var==0){
			$this->redirect("Data/index");
		}else{
			$this->error("操作有误",U("Data/index"),1);
		}
	}
	public function delete_tab(){     		//删除表
		$name=I("get.name");
		
		$sql="drop table `$name`";
		$var= M()->execute($sql,true);
		if($var==0){
			$this->redirect("Data/index");
		}else{
			$this->error("操作有误",U("Data/index"),1);
		}
	}
	public function truncate_tab(){    		//清空表
		$name=I("get.name");
		
		$sql="truncate `$name`";
		$var= M()->execute($sql,true);
		if($var==0){
			$this->redirect("Data/index");
		}else{
			$this->error("操作有误",U("Data/index"),1);
		}
	}
	public function tabdetail(){        	 //表详情
		$name1=I("get.name");
		$this->left('data');
		if($name1!=""){
		$var=explode("_", $name1);
		$sql="SELECT
		COLUMN_NAME,
		COLUMN_COMMENT  AS  `备注`
		FROM information_schema.COLUMNS WHERE TABLE_NAME='$name1'";
		$comment= M()->query($sql,true);
		
		
		$db=M($var[1]);
		
		$name=$db->getDbFields();
		$var=$db->select();

		
		$this->assign("title",$name1);
		$this->assign("comment",$comment);
		$this->assign("name",$name);
		$this->assign("data",$var);
		$this->display();
		}
	}
	public function deletedata(){        	//删除值
		$id=I("get.id");
		$name=I("get.name");
		$var=explode("_", $name);
		
		$db=M($var[1]);
		$var=$db->where('id='.$id)->delete();
		if($var==1){
			$this->redirect('Data/tabdetail?name='.$name);
		}else{
			$this->error("操作有误",U("'Data/tabdetail?name='.$name"),1);
		}
	}
	public function adddetail(){			//增加值
		$names=I("get.names");				//获取表名
		$namee=I("get.namee");
		$data=I('post.');                   //批量获取
		
		$this->left('data');
		if($names!=""){
			$var=explode("_", $names);
			$db=M($var[1]);
			$sql="show full columns from `$names`";
		
			$name=$db->getDbFields();
			$count=count($name);

			$nature=M()->query($sql,true);
			
			$this->assign("count",$count);
			$this->assign("nature",$nature);
			$this->assign("name",$name);
			$this->assign("title",$names);
			
			$this->display();
		}else if($namee!=""){
			$var=explode("_", $namee);
			$db=M($var[1]);
			
			$var1=$db->data($data)->add();
			if($var1!=0){
				$this->redirect('Data/tabdetail?name='.$namee);
			}else{
				$this->error("操作有误",U("'Data/tabdetail?name='.$namee"),1);
			}
		}
	}
	
	public function addfield(){
		$names=I("get.names");
		$title=I("post.title");
		$after=I("post.after");
		$type=I("post.type");
		$default=I("post.default");
		$comment=I("post.comment");
		
		$this->left('data');
		if($title!=""){
		
		$sql="ALTER TABLE  `$names` ADD  `$title` $type NOT NULL DEFAULT  '$default' COMMENT  '$comment' AFTER  `$after`";
		$var= M()->execute($sql,true);
		if($var==0){
				$this->redirect('Data/tabdetail?name='.$names);
			}else{
				$this->error("操作有误",U('Data/tabdetail?name='.$names),1);
			}
		}else{
			$var=explode("_", $names);
			$db=M($var[1]);
			$name=$db->getDbFields();
			
			$this->assign("names",$names);
			$this->assign("name",$name);
			$this->display();
		}
	}
	 public function csvin(){				//csv文件的读取
	 	$this->left('data');
		$kis=I("get.kis");
       	$name=session('name');
		if($kis=="find"){
	   	$DRI_UP="Public/upload/".$name."/";
	   	//文件上传地址
	   	$filename=scandir($DRI_UP);
			foreach($filename as $val){
				if(substr($val,-4)==".csv"){
					
					$upfile=$val;			
				}
			}
		//获取文件名
		read_csv($DRI_UP.$upfile);
		exit;
		//处理文件
		}
	   	$this->assign("name",$name);
        $this->display();
    }
	public function upload(){
    $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize   =     3145728000 ;// 设置附件上传大小
    $upload->exts      =     array('csv');// 设置附件上传类型
    $upload->rootPath  =     './Public/upload/uploads/'; // 设置附件上传根目录
    $upload->savePath  =     ''; // 设置附件上传（子）目录
    // 上传文件 
    $info   =   $upload->upload();
    if(!$info) {// 上传错误提示错误信息
	        $this->error($upload->getError());
	    }else{// 上传成功
	        $this->success('上传成功！');
	    }
	}
}