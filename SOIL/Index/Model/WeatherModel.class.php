<?php
//自定义Modle类
namespace Index\Model;
use Think\Model;

class WeatherModel extends Model{

    public function getdata($x,$tablename){
        
		$weather=M($tablename);
		echo "<meta charset='utf-8'>";
		$var=$weather->field("$x")->where('id!=1')->select();	//去除id=1的修正情况	
		return $var;											//返回数组
		//return json_encode($var); 							//输出json格式的全部数据
    }
	
	public function getweather($tablename){						//查询一个表的所有信息，适用于所有表的查询
		
		$weather=M();
		$sql="SELECT
		COLUMN_NAME,
		COLUMN_COMMENT  AS  `备注`
		FROM information_schema.COLUMNS WHERE TABLE_NAME='$tablename'";
		$var=$weather->query($sql,TRUE);
		
		return $var;
	}
	public function getdata_all($tablename,$id){				//获取所有数据表值
		
		ini_set('memory_limit', '1280M');	
		//数据过大修改ini的配置
		$tab=M($tablename);
		if($id==""){
			$var=$tab->select();								//id等于空值	
		}else{
			$var=$tab->where('id='.$id)->select();				//获取id值返回相关数据
		}
		return $var;
	}
	public function getsql(){
		$db=M();
		$data=$db->query($sql = 'show table status');
		return $data;
	}
}
