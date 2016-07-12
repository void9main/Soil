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
	 public function csv(){				//csv文件的读取
        if(is_post)
        {
            $DST_DIR = 'Public/Admin/upload/';  
            if ($_FILES['file']['name'] != '') { 
                if ($_FILES['file']['error'] > 0) {  
                    echo "上传错误";  
                }  
                else {  
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $DST_DIR.$_FILES['file']['name'])) {  
                        $rs="上传成功<br/><br/>";  
                        $rs.="上传文件的名称 : ".$_FILES['file']["name"]."<br/>";//上传文件的文件名 
                        $rs.="上传文件的类型 : ".$_FILES['file']["type"]."B<br/>";//上传文件的类型 
                        $rs.="上传文件的大小 : ".$_FILES['file']["size"]."<br/>";//上传文件的大小 
                        $rs.="上传文件的位置 : ".$DST_DIR."<br/>";//上传文件的位置
                    }  
                    else {  
                        $rs=$DST_DIR.$_FILES['file']['name']."<br/>";
                        $rs.="上传失败";  
                    }  
                }  
            }  
            else {  
                $rs="请上传文件"; 
            }

        }
        else
        {
            $rs="非法途径";
        }

        
        $this->assign("r",$rs);
        $this->display();
    }
    public function csvdir(){
        $DST_DIR = 'Public/Admin/upload/';
        $mydir = dir($DST_DIR); 
        $drr=array();
        $i=0;
        while(($file = $mydir->read())!== false)
        {
            $i++;
            if(!(is_dir("$directory/$file")) AND ($file!=".") AND ($file!="..")) 
            {
               $drr[$i][0]=$file;
               $drr[$i][1]=$DST_DIR.$file;
               $drr[$i][2]=str_replace("/", "-", $drr[$i][1]);
            } 
        } 
        $mydir->close();
        $this->assign("_list",$drr);
        $this->display();
    }

    public function csvindb(){
        header("Content-type:text/html;charset=utf-8");

        $url=I('url');

        


        if($url)
        {

            $con = mysql_connect("localhost","root","");
            if (!$con)
            {
                die('Could not connect: ' . mysql_error());
            }
            mysql_select_db("zhinong", $con);
            mysql_query("set names 'utf8'");


            // some code
            $DST_DIR = 'Public/Admin/upload/';
            
            $name=str_replace(".csv", "", $url);
            $table="zi_yearbook".$name;


            $file= $DST_DIR.$url;
            $handle=fopen($file,"r");

            if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '".$table."'"))==1) 
            {   
                $log="";
                $log.= "Table exists<br/>";
            } 
            else
            {
                $log.= "Table does not exist<br/>";
                $log.= "创建表 : ".$table."<br/>";

                $r=1;
                while ($data = fgetcsv($handle,1000,",")) {
                    $num=count($data);

                    //var_dump($data); 
                    //创建表
                    //表头（第一行）数据不包含
                    if($r==1)
                    {
                        $colr="";
                        for($i=-1;$i<$num;$i++)
                        {
                            $data[$i]=trim($data[$i]);
                            if($i==-1)
                            {
                                $col.="id int NOT NULL AUTO_INCREMENT,";
                                $col.="PRIMARY KEY(id),";
                                $log.="创建字段 : id<br/>";
                            }
                            elseif($i==$num-1)
                            {
                                $data[$i]=encode($data[$i]);
                                $col.="`".$data[$i]."` text";
                                $log.="创建字段 : ".$data[$i]."<br/>";
                                $colr.="`".$data[$i]."`";
                            }
                            else
                            {
                                $data[$i]=encode($data[$i]);
                                $col.="`".$data[$i]."` varchar(100),";
                                $log.="创建字段 : ".$data[$i]."<br/>";
                                $colr.="`".$data[$i]."`,";
                            }
                            
                        }
                        $sql="CREATE  TABLE ".$table."(".$col.")";
                        trace($sql);
                        $res=mysql_query($sql);
                        if($res)
                        {
                            $log.=$table."-创建成功<br/>";
                        }
                        else
                        {
                            $log.=$table."-创建失败<br/>";
                            //break;
                        }
                    }
                    else
                    {
                        $sqli="";
                        for($i=0;$i<$num;$i++)
                        {
                            $data[$i]=trim($data[$i]);
                            if($i==$num-1)
                            {
                                $data[$i]=encode($data[$i]);
                                $sqli.="'".$data[$i]."'";
                                $log.=$data[$i]."<br/>";
                            }
                            elseif($i==0)
                            {
                                $data[$i]=encode($data[$i]);
                                $sqli.="'".$data[$i]."',";
                                $log.="录入：".$data[$i]." , ";
                            }
                            else
                            {
                                $data[$i]=encode($data[$i]);
                                $sqli.="'".$data[$i]."',";
                                $log.=$data[$i]." , ";
                            }
                        }
                        $sql2="insert into `".$table."`(".$colr.") values (".$sqli.")";
                        //trace($encode);
                        //trace($sql2);
                        mysql_query($sql2);
                        
                    }

                    
                   // var_dump($r);
                    //var_dump($col);
                    $r=$r+1;
                }
            }

        }
        else
        {
            $file="没有选择文件";
            $rs="非法途径";
        }
        $encode = mb_detect_encoding($log, array("ASCII","UTF-8","GB2312","GBK","BIG5")); 
        trace($encode);
        //关闭连接
        mysql_close($con);
        fclose($handle);
        $this->assign("r",$log);
        $this->display();
    }
}