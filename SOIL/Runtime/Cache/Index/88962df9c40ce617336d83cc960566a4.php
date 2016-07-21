<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="shortcut icon" href="/soil/Public/img/logo.png" />
		<link rel="stylesheet" type="text/css" href="/soil/Public/css/bootstrap.css" /> 
		<link rel="stylesheet" type="text/css" href="/soil/Public/css/bootstrap-theme.min.css" />
		<link rel="stylesheet" type="text/css" href="/soil/Public/css/login.css" />
		<link rel="stylesheet" type="text/css" href="/soil/Public/css/register.css" />
		<link rel="stylesheet" type="text/css" href="/soil/Public/css/index.css" /> 
		<link rel="stylesheet" type="text/css" href="/soil/Public/css/style.css" /> 
		<script type="text/javascript" src="/soil/Public/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/soil/Public/js/echarts.min.js"></script>
		<script type="text/javascript" src="/soil/Public/js/jquery.min.js"></script>
		<script type="text/javascript" src="/soil/Public/upload/plupload.full.min.js"></script>
		<title>SOIL--系统外链</title>
	</head>
	<body>

<body>


<!--
	body
-->
	<div class="content">
		 <div id="main" style="width: 100%;height:700px;"></div>
	</div>
	<script>
	// 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));

        // 指定图表的配置项和数据
		var xAxisData = [];
		var data1 = [<?php echo ($temp); ?>];						//数组数据
		var data2 = [];
		for (var i = 0; i < 100; i++) {
		    xAxisData.push('类目' + i);
		    data1.push((Math.sin(i / 5) * (i / 5 -10) + i / 6) * 5);
		   //data2.push((Math.cos(i / 5) * (i / 5 -10) + i / 6) * 5);
		}
		
		option = {
		    title: {
		        text: '余姚温度查询'
		    },
		    legend: {
		        data: ['bar', 'bar2'],
		        align: 'left'
		    },
		    toolbox: {
		        // y: 'bottom',
		        feature: {
		            magicType: {
		                type: ['stack', 'tiled']
		            },
		            dataView: {},
		            saveAsImage: {
		                pixelRatio: 2
		            }
		        }
		    },
		    tooltip: {},
		    xAxis: {
		        data: xAxisData,
		        silent: false,
		        splitLine: {
		            show: false
		        }
		    },
		    yAxis: {
		    },
		    series: [{
		        name: 'bar',
		        type: 'bar',
		        data: data1,
		        animationDelay: function (idx) {
		            return idx * 10;
		        }
		    },],
		    animationEasing: 'elasticOut',
		    animationDelayUpdate: function (idx) {
		        return idx * 5;
		    }
		};
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
	</script>
<!--
	/body
-->

	</body>
	<footer>
	<div align="center">
		<nav class="navbar navbar-default navbar-fixed-bottom footer-style" role="navigation">
		<br />
 		杭州数据科技@copyright2016--Soil系统--by Dave
		</nav>
	</div>
	</footer>	
</html>