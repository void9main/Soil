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
		//公共方法
		$page=I('get.page');
		//页数
		$choose=I('post.choose');
		//获取搜索条件
		$find=I('post.find');
		//获取搜索状态
		$search=trim(I('post.search'));
		//获取搜索值

		$PAGE_NUM=10;
		$NEXT=10;
		//固定常量
		
		if($name1!=""){
		$var=explode("_", $name1);
		
		$sql="SELECT
		COLUMN_NAME,
		COLUMN_COMMENT  AS  `备注`
		FROM information_schema.COLUMNS WHERE TABLE_NAME='$name1'";			

		$comment= M()->query($sql,true);
		
		$db=M($var[1]);

		$name=$db->getDbFields();
		//字段名称
		if($find==""){
				
			$vae=$db->select();												//直接输出结果
		}else{
			if($choose=="匹配搜索"){	
				$vae=$db->where("`$find`='$search'")->select();						//带有查找性质的查询输出
			}else if($choose=="模糊搜索"){
				$vae=$db->where("`$find` LIKE '%$search%'")->select();						//带有查找性质的查询输出
			}
		}

		$num=count($vae);
		for($i=1;$i<=($num/10);$i++){
			$list[$i]=$i;
		}
		//总数量
		if($page==""){
			$PREV=0;
		}else{
			$PREV=($page-1)*$PAGE_NUM;
		}
		//数据分页提取
		if(floor($page/10)!=0){
			$PREV_NUM=floor($page/10)*10;
		}else{
			$PREV_NUM=0;
		}
		//分页起始数
		if($find==""){
			$var=$db->limit($PREV,$NEXT)->select();
			//直接输出
		}else{
			if($choose=="匹配搜索"){
				$var=$db->where("`$find`='$search'")->select();
			}else if($choose=="模糊搜索"){
				$var=$db->where("`$find` LIKE '%$search%'")->select();
			}
			//搜索输出
			$this->assign("search","ok");
			//搜索状态供前台if判断
		}
		$this->assign("page",$page);
		$this->assign("PREV",$PREV_NUM);
		$this->assign("al",$list);
		$this->assign("num",$num);
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
		$namef=I("get.namef");
		$id=I("get.id");
		$data=I('post.');                   //批量获取
		$this->left('data');
		
		
		if($names!=""){
			$var=explode("_", $names);
			$db=M($var[1]);
			$sql="show full columns from `$names`";
		
			$name=$db->getDbFields();
			$count=count($name);

			$nature=M()->query($sql,true);
			if($id!=""){
			$content=$db->where("id=".$id)->select();
			}
			//获取值
			$this->assign("count",$count);
			$this->assign("nature",$nature);
			$this->assign("name",$name);
			$this->assign("title",$names);
			$this->assign("content",$content);
			
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
		}else if($namef!=""){
			$var=explode("_", $namef);
			$db=M($var[1]);
			
			$var1=$db->where("id=".$id)->save($data);
			if($var1!=0){
				$this->redirect('Data/tabdetail?name='.$namef);
			}else{
				$this->error("操作有误",U("'Data/tabdetail?name='.$namef"),1);
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
		if($var!=0){
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
		$kis=I("post.kis");
		$comment="";  						//TODO 备注
		$time=time();
		$date=date("Y-m-d");
		
		$DRI_UP="Public/upload/uploads/".$date."/";
	   	//文件上传地址
       	$name=session('name');
		$time=time();
		if($kis=="find"){
		//判断按钮是否点击
	    $upload = new \Think\Upload();							// 实例化上传类
	    $upload->maxSize   =     3145728000 ;					// 设置附件上传大小
	    $upload->exts      =     array('csv');					// 设置附件上传类型
	    $upload->rootPath  =     './Public/upload/uploads/'; 	// 设置附件上传根目录
	    $upload->savePath  =     ''; 							// 设置附件上传（子）目录
	    $upload->saveName  =     $name.$time;
	    
	    $info   =   $upload->upload();
	    if(!$info) {											// 上传错误提示错误信息
		        $this->error($upload->getError());
		    }else{												// 上传成功
		    $filename=scandir($DRI_UP);
			foreach($filename as $val){
				if(substr($val,-4)==".csv"){
					
					$upfile=$val;			
					}
				}
			
			//获取文件名
			$tablename="sj_".$name.$time;
			//表名
			$data=read_csv($DRI_UP.$upfile);

			if($data!=""){
				$sql_table="CREATE TABLE `$tablename` (
		 		 `id` int(11) NOT NULL AUTO_INCREMENT,
		  		PRIMARY KEY (`id`)
				) ENGINE=MyISAM DEFAULT CHARSET='utf8' COMMENT='$comment'";
				 M()->execute($sql_table,true);
				 //创建表
				 
				foreach($data as $val){
					$sql_word="ALTER TABLE  `$tablename` ADD  `$val` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL";
					M()->execute($sql_word,true);	
				//创建字段
				}
				
				read_csv_content($DRI_UP.$upfile,$name.$time,$data);
				//添加具体数据
			}
			//文件存入到数据库
			unlink($DRI_UP.$upfile);
			$this->redirect('Data/index');
			exit;
			//处理文件
			}
			// 上传文件 
		}
	   	$this->assign("name",$name);
        $this->display();
    }
}