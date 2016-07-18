<?
	function read_csv($filename=null) {             	
	    if(!$filename){
	        return false;
	    }
	    $handle=fopen($filename,'r');
	    if(!$handle){
	        return false;
	    }
	    
	    $row=1;
		//行数量
	    while($data=fgetcsv($handle,1000,",")){
	    $var =$data;
	    array_shift($var);
		
	    $num=count($data);
		//字段数量
		echo "<meta charset=\"utf-8\" />";
	    $row ++;
		// TODO ++
	        for ($c=0;$c<$num;$c++){
				
	            //echo $data[$c+1];
	           
	        }
			return $var; 					//返回值
	    }
		
	}
	function read_csv_content($filename=null,$tablename,$var) {             	//读取csv格式文件的函数
	    if(!$filename){
	        return false;
	    }
	    $handle=fopen($filename,'r');
	    if(!$handle){
	        return false;
	    }
		
	    $row=1;
		$a=implode("`,`", $var);
		$b=",`".$a."`";
		//完整的字段名称
	    while($data=fgetcsv($handle,1000,",")){
	        $num=count($data);
	        $row ++;
			
	        for ($c=0;$c<$num;$c++){

				$content[$c+1]=$data[$c+1];
	        }
			$f=implode("','",$content);
			$d=substr($f,0,strlen($f)-2);
			$s="'".$d; 
			//截取到完整字符
			$sql_data="INSERT INTO `sj_$tablename`(`id`$b) VALUES ('',$s)";
			M()->execute($sql_data,true);
			//存储数据
	    }
	}
	/*
	 * 读取csv
	 */
	function check_verify($code, $id = 1){
		
		$verify = new \Think\Verify();
		return $verify->check($code, $id);
	} 
	/*
	 * 生成验证码
	 */
	