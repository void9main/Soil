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
	        $num=count($data);
		//字段数量
		echo "<meta charset=\"utf-8\" />";
		echo "<h1>  第 $row 行 ,共有 $num 个字段 <br /></h1>\n";
	        $row ++;
		// TODO ++
	        for ($c=0;$c<$num;$c++){
	        	echo $c;
	            echo $data[$c]."\t";
	        }
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
	