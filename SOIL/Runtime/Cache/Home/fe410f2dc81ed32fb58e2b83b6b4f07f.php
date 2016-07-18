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
		<title>SOIL</title>
	</head>

	<body onload="showLeftTime()">
<nav class="navbar navbar-default" role="navigation"> 
  <!-- Brand and toggle get grouped for better mobile display -->
  
  <div class="navbar-header">
    <a class="navbar-brand" href="<?php echo U('Index/index');?>">Soil</a>
    <img  src="/soil/Public/img/logo.png" style="width: 50px;height: 50px;"/> 
    <!--<small>Simple|Reliable</small>-->
    &nbsp;&nbsp;
    <a href="<?php echo U('Index/index');?>" type="button" class="btn btn-default" role="button">首页</a>
    <a href="<?php echo U('Common/index');?>" type="button" class="btn btn-success" role="button">公共系统</a>
    <?php if(is_array($top)): $i = 0; $__LIST__ = $top;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="/soil/index.php/Home/<?php echo ($vo["url"]); ?>" type="button" class="btn btn-success"  role="button"><?php echo ($vo["list"]); ?></a>
    &nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
    <a href="<?php echo U('Cloud/login');?>" type="button" class="btn btn-info" role="button">Soil云</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <form class="navbar-form navbar-right" role="search">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Search">
      </div>
      <button type="submit" class="btn btn-primary">全局搜索</button>
    
    <a href="<?php echo U('Set/index');?>">
      <button type="button" class="btn btn-primary">设置</button>
    </a>
    <a href="">
      <button type="button" class="btn btn-primary">日志</button>
    </a>
    <a href="">
      <button type="button" class="btn btn-primary">客户</button>
    </a>
    </form>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="<?php echo U('User/register');?>">注册</a></li>
      <li class="dropdown">
        	<a href="#menu3">我的主页</a>
              <ul class="dropdown-menu top-width">
                <li><a href="#menu7">菜单</a></li>
								<li><a href="<?php echo U('User/logout');?>">注销</a></li>
              </ul>
      </li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>
<div class="left-style" align="center">
	<ul class="nav nav-list bs-docs-sidenav affix-top " style="background-color: #e0e9f3;">
		
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="active">
		<a href="/soil/index.php/Home/<?php echo ($vo["url"]); ?>">
			<i class="icon-chevron-right glyphicon glyphicon-inbox"></i><?php echo ($vo["list"]); ?>
		</a>
		</li><?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>
	<script type="text/javascript">
	$(function() {
		$('.nav li').click(function(e) {
			$('.nav li').removeClass('active');
			//$(e.target).addClass('active');
			$(this).addClass('active');
		});
	});
	function show(){
		document.getElementById('iDBody').style.display = "";
	}
	function hide(){
		document.getElementById('iDBody').style.display = "none";
	}
	</script>
</div>
    <!--body-->
    <div class="content index-div-main">
    	<div class="index-div" style="width:22%;">
    		<div class="page-header">
			  <h1>Soil系统</h1>
			  <h2><small>完整的数聚平台-简单|可靠</small></h2>
			  <h2><small>The Number Platform-simple|reliable</small></h2>
			  <h2><small>想你所想,指引未来</small></h2>
			  <h2><small>Think what you to think, To guide the future</small></h2>
			  <hr>
			  <h3><small>当前时间</small></h3>
			  <label id="show"></label>
			  <iframe width="800" scrolling="no" height="120" frameborder="0" allowtransparency="true" 
			  	src="http://i.tianqi.com/index.php?c=code&id=19&color=%23002060&bdc=%230070C0&icon=3&temp=1&num=1">
			  </iframe>
			</div>
    	</div>
    	<div class="index-div" style="width:30%">
    		<img src="/soil/Public/image/index.jpg" style="width:100%;height:100%;"/>
    	</div>
    	<div class="index-div" style="width:46%;">
    		 <div id="main" style="width:auto;height:800px;"></div>
    	</div>
    </div>
    <script type="text/javascript">
    //显示当前动态时间
	var initializationTime=(new Date()).getTime();
	function showLeftTime()
	{
	var now=new Date();
	var month=now.getMonth()+1;
	var day=now.getDate();
	var hours=now.getHours();
	var minutes=now.getMinutes();
	var seconds=now.getSeconds();
	document.all.show.innerHTML=month+"月"+day+"日 "+hours+":"+minutes+":"+
	seconds
	+"";
	var timeID=setTimeout(showLeftTime,1000);
	}
	// 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));

        // 指定图表的配置项和数据
        option = {
		    backgroundColor: '#b0a5a2',
		
		    title: {
		        text: 'Soil系统监控',
		        left: 'center',
		        top: 20,
		        textStyle: {
		            color: '#272822'
		        }
		    },
		
		    tooltip : {
		        trigger: 'item',
		        formatter: "{a} <br/>{b} : {c} ({d}%)"
		    },
		
		    visualMap: {
		        show: false,
		        min: 80,
		        max: 600,
		        inRange: {
		            colorLightness: [0, 1]
		        }
		    },
		    series : [
		        {
		            name:'详细信息',
		            type:'pie',
		            radius : '55%',
		            center: ['50%', '50%'],
		            data:[
		                {value:335, name:'用户数量'},
		                {value:310, name:'模板数量'},
		                {value:274, name:'部门情况'},
		                {value:235, name:'数聚链接'},
		                {value:400, name:'全局情况'}
		            ].sort(function (a, b) { return a.value - b.value}),
		            roseType: 'angle',
		            label: {
		                normal: {
		                    textStyle: {
		                        color: 'rgba(48, 113, 169, 225)'
		                    }
		                }
		            },
		            labelLine: {
		                normal: {
		                    lineStyle: {
		                        color: 'rgba(48, 113, 169, 225)'
		                    },
		                    smooth: 0.2,
		                    length: 10,
		                    length2: 20
		                }
		            },
		            itemStyle: {
		                normal: {
		                    color: '#c23531',
		                    shadowBlur: 200,
		                    shadowColor: 'rgba(48, 113, 169, 0.5)'
		                }
		            }
		        }
		    ]
		};
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
	</script>

    <!--body-->

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