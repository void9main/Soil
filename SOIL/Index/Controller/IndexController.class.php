<?php
namespace Index\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
				
			$model =new \Index\Model\WeatherModel(); 
        	$date=$model->getdata('datatime');
			$temp=$model->getdata('temp');
			for($i=1;$i<count($temp);$i++){
				$val[$i]=implode("", $temp[$i]);
			}
			$temp=implode(',', $val);
			
			$this->assign("time",$date);
			$this->assign("temp",$temp);
			$this->display(); 
    }
}