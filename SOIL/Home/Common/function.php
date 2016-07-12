<?
	function read_csv($filename=null) {             	//读取csv格式文件的函数
	    if(!$filename){
	        return false;
	    }
	    $handle=fopen($filename,'r');
	    if(!$handle){
	        return false;
	    }
	    
	    $row=1;
	    while($data=fgetcsv($handle,1000,",")){
	        $num=count($data);
	        $row ++;
	        for ($c=0;$c<$num;$c++){
	            echo $data[$c]."\t";
	        }
	    }
	}
	function check_verify($code, $id = 1){
		
		$verify = new \Think\Verify();
		return $verify->check($code, $id);
	}