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

	<body style="background-color: #f3f3f3;">
	<div class="content" align="center">
			<div style="margin-top: 50px;">
			<a href="<?php echo U('Index/index');?>">
			<img src="/soil/Public/img/logo.png" style="width: 50px;height: 50px;"/>
			</a>
			<h2>Soil</h2>
			</div>
		<form method="post" action="<?php echo U('User/register');?>">
		<div class="content register-content">
			<br />
			<div style="width: 350px;">
			<hr class="style-eight-topr">
			</div>
			<br />
			<div class="input-group" align="left">
				<label for="exampleInputEmail1">用户名称</label>
			 	<input type="text" class="form-control" placeholder="用户名" size="40" name="name"/>
			</div>
			<br />
			<div class="input-group" align="left">
				<label for="exampleInputEmail1">输入密码</label>
			  	<input type="password" class="form-control" placeholder="输入密码" size="40" name="pwd1"/>
			</div>
			<br />
			<div class="input-group" align="left">
				<label for="exampleInputEmail1">再次输入</label>
			  	<input type="password" class="form-control" placeholder="再次输入" size="40" name="pwd2"/>
			</div>
			<br />
			<div class="input-group" align="left">
				<label for="exampleInputEmail1">用户分组</label>
				<br />
			  	 <select class="form-control" name="typeid" id="typeid" style="width: 360px;">
			  	 <option></option>
			  	 <?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option><?php echo ($vo['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		    </select>
			</div>
			<br /><br />
			<button type="submit" class="btn btn-success" style="width: 360px;" >注册</button>
			
			<div style="width: 350px;">
				<br />
			<hr class="style-eight-bom">
			</div>
		</div>
		</form>
	</div>
	</body>
</html>