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
    <div class="content main-div " style="height:auto;width: 50%;">
    	<ol class="breadcrumb col-lg-12">
		  <li><a href="<?php echo U('Index/index');?>">首页</a></li>
		  <li><a href="<?php echo U('Data/index');?>">数据表单</a></li>
		  <li><a href="<?php echo U('Data/tabdetail',array('name'=>$title));?>">返回</a></li>
		  <li class="active">增加值</li>
		</ol>
		<?php if($content[0]['id'] != ''): ?><form  method="post" action="<?php echo U('Data/adddetail',array('namef'=>$title,'id'=>$content[0]['id']));?>" name="adddetail" id="adddetail">
		<?php else: ?>
		  	<form  method="post" action="<?php echo U('Data/adddetail',array('namee'=>$title));?>"><?php endif; ?>
		<?php $__FOR_START_8091__=0;$__FOR_END_8091__=$count;for($i=$__FOR_START_8091__;$i < $__FOR_END_8091__;$i+=1){ ?><div class="form-group">
		    <label for="exampleInputEmail1"><?php echo ($name[$i]); ?>---属性值：<?php echo ($nature[$i]['type']); ?>---备注：<?php echo ($nature[$i]['comment']); ?></label>
		    <?php if($nature[$i]['type'] == 'text' ): ?><textarea class="form-control" rows="4" name="<?php echo ($name[$i]); ?>" placeholder="<?php echo ($nature[$i]['comment']); ?>">
		    	<?php echo ($content[0][$name[$i]]); ?>
		    </textarea>
		    <?php else: ?>
		    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="<?php echo ($nature[$i]['comment']); ?>" name="<?php echo ($name[$i]); ?>" 	value="<?php echo ($content[0][$name[$i]]); ?>"	    	
		    <?php if(($nature[$i]['default'] != '') OR ($name[$i] == 'id')): ?>readonly<?php endif; ?>><?php endif; ?>
		  </div><?php } ?>
		<div align="right">
			<?php if($content[0]['id'] != ''): ?><button type="button" class="btn btn-success" id="addtype" name="addtype">修改</button>
			<?php else: ?>
		  		<button type="submit" class="btn btn-primary">添加</button><?php endif; ?>
		</div>
		</form>
    </div>
    <script>
    $("#addtype").click(function(){
             $.ajax({
                 type: "post",
                 url: "<?php echo U('Data/adddetail',array('namef'=>$title,'id'=>$content[0]['id']));?>",     
                 data: $("#adddetail").serialize(),    
                 success: function(data) {
                     alert("提交成功！");
                 },
                 error: function(data) {
                     alert(data);
                 }
             })
         });
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