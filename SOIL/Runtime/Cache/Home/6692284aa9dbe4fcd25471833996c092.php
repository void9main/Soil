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
    
    <a href="<?php echo U('Index/index/index');?>">
      <button type="button" class="btn btn-primary">前台</button>
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
    <div class="content main-div " style="height:auto;width: 85%;">
    	<ol class="breadcrumb col-lg-12">
		  <li><a href="<?php echo U('Index/index');?>">首页</a></li>
		  <li><a href="<?php echo U('Data/index');?>">数据表单</a></li>
		  <li class="active">分表详情</li>
		</ol>
		<div class="row">
			<div class="col-lg-4">
				<form action="<?php echo U('Data/tabdetail',array('name'=>$title));?>" method="post">
			    <div class="input-group">
			      <span class="input-group-btn">
			       <select class="form-control" name="find" id="type" style="width:130px;">
						<?php if(is_array($name)): $i = 0; $__LIST__ = $name;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		    		</select>
		    		<select class="form-control" name="choose" id="type" style="width:108px;">
			         	<option>匹配搜索</option>
		         		<option>模糊搜索</option>
		    		</select>
		    		<input type="text" class="form-control " name="search">
			       	<button class="btn btn-primary" type="submit">搜索</button>
			      </span>
			    </div><!-- /input-group -->
			    </form>
			</div><!-- /.col-lg-6 -->
		</div>
		<h4>表：
			<a href="<?php echo U('Data/tabdetail',array('name'=>$title));?>">
			<?php echo ($title); ?>
			</a>
			<?php if($search != ''): ?><div align="center">
					<ul class="pagination">
						<li><a href="#">共查询到<?php echo ($num); ?>条结果</a></li>
						<!--<li><a href="<?php echo U('Data/tabdetail',array('out'=>'out'));?>">导出查询数据</a></li>-->
					</ul>
				</div><?php endif; ?>
			<div align="right">
			<a href="<?php echo U('Data/addfield',array('names'=>$title));?>">
			<button type="button" class="btn btn-success">增加字段</button>
			</a>
			<a href="<?php echo U('Data/adddetail',array('names'=>$title));?>">
    		<button type="button" class="btn btn-success">增加值</button>
    		</a>
	    	</div>
	    	<small>字段过多的情况下,只截取前10个字段显示</small>
		</h4>
		<table class="table table-bordered" id="tab">
        <tr>
        <td>字段名称</td>
        <?php if(is_array($name)): $i = 0; $__LIST__ = array_slice($name,0,10,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><td><strong><?php echo ($vo); ?></strong></td><?php endforeach; endif; else: echo "" ;endif; ?>
		<td>
			操作
		</td>
        </tr>
        <tr>
        <td>字段备注</td>
        <?php if(is_array($comment)): $i = 0; $__LIST__ = array_slice($comment,0,10,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><td><?php echo ($vo1["备注"]); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
        </tr>
	    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><tr>
	        <td>#值#</td>
	        <?php if(is_array($name)): $i = 0; $__LIST__ = array_slice($name,0,10,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><td>
	        	<?php echo ($vo2["$vo"]); ?>
	        </td><?php endforeach; endif; else: echo "" ;endif; ?>   
	        <td>
	        	<?php if(vo2.id == ''): ?><button type="button" class="btn btn-success btn-xs">保存</button>
	        	<?php else: ?>
	        	<a href="<?php echo U('Data/adddetail',array('id'=>$vo2['id'],'names'=>$title));?>">
	        	<button type="button" class="btn btn-success btn-xs">修改</button>
	        	</a>
	        	<!--<a href="<?php echo U('Data/deletedata',array('id'=>$vo2['id'],'name'=>$title));?>">
	        	<button type="button" class="btn btn-danger btn-xs">删除</button>
	        	</a>--><?php endif; ?>
	        </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
		<div align="center">
		<ul class="pagination">
			<?php if($search == ''): ?><li><a href="#">当前在<strong><?php echo ($page); ?></strong>页</a></li>
			<li 
				<?php if($page == 1): ?>class="disabled"<?php endif; ?>
			>
				<a href="<?php echo U('data/tabdetail',array('page'=>$page-1,'name'=>$title));?>">&laquo;</a>
			</li>
			<?php if(is_array($al)): $i = 0; $__LIST__ = array_slice($al,$PREV,10,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('data/tabdetail',array('page'=>$vo,'name'=>$title));?>"><?php echo ($vo); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			<li><a href="<?php echo U('data/tabdetail',array('page'=>$page+1,'name'=>$title));?>">&raquo;</a></li>
			<li><a href="#">共有<?php echo ($num); ?>条数据</a></li><?php endif; ?>
		</ul>
		</div>
    	<br />
    	<div id="to_top" align="right">
    	<button type="button" class="btn btn-info btn-xs">
    		↑
    	</button>
   		</div>
   	</div>
    <script>
	window.onload = function(){
	  var oTop = document.getElementById("to_top");
	  var screenw = document.documentElement.clientWidth || document.body.clientWidth;
	  var screenh = document.documentElement.clientHeight || document.body.clientHeight;
	  oTop.style.left = screenw - oTop.offsetWidth +"px";
	  oTop.style.top = screenh - oTop.offsetHeight + "px";
	  window.onscroll = function(){
	    var scrolltop = document.documentElement.scrollTop || document.body.scrollTop;
	    oTop.style.top = screenh - oTop.offsetHeight + scrolltop +"px";
	  }
	  oTop.onclick = function(){
	    document.documentElement.scrollTop = document.body.scrollTop =0;
	  }
	}  
	//转到顶部的js代码
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