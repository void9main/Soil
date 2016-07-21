<?php
//自定义Modle类
namespace Index\Model;
use Think\Model;

class WeatherModel extends Model{

    public function getdata($x){
        
		$weather=M('weather');
		echo "<meta charset='utf-8'>";
		$var=$weather->field("$x")->where('id!=1')->select();	//去除id=1的修正情况	
		return $var;											//返回数组
		//return json_encode($var); 							//输出json格式的全部数据
    }
}
