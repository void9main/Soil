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
			<div style="margin-top: 100px;">
			<img src="/soil/Public/img/logo.png" style="width: 50px;height: 50px;"/>
			<h2>Soil</h2>
			</div>
		<form method="post" action="<?php echo U('User/login');?>">
		<div class="content login-content">
			<br />
			<div style="width: 350px;">
			<hr class="style-eight-top">
			</div>
			<br />
			<div class="input-group">
			  <input type="text" class="form-control" placeholder="Username" size="40" name="name"/>
			</div>
			<br /><br />
			<div class="input-group">
			  <input type="password" class="form-control" placeholder="Password" size="40" name="pwd"/>
			</div>
			<br /><br />
			<div class="content" align="left" style="margin-left: 75px;">
			<input type="checkbox" class="login-hr" id="myCheckbox" name="check">
			<label class="login-l-left">下次自动登录</label>
			<label class="login-l-right">忘记密码了？</label>
			</div>
			<br />
			<button type="submit" class="btn btn-primary" style="width: 300px;" >登录</button>
			
			<div style="width: 350px;">
				<br />
			<hr class="style-eight-bom">
			</div>
		</div>
		</form>
	</div>
	</body>
</html>