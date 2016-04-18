<?php 
session_start ();
$type=$_GET['type'];
if(strcmp($type,"exit") == 0){
	$_SESSION['username'] = null;
}
$username = $_SESSION ['username'];
session_commit();
if($username != null){
	header("Location:./wuploadproduct.php");
	exit;
}
$errorMsg = $_GET ['errorMsg'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Wish管理助手-更有效率的Wish商户实用工具</title>
			<meta name="keywords" content="">
				<link rel="stylesheet" type="text/css" href="../css/login_page.css">

</head>
<script type="text/javascript">
	function login(){
		var name = document.getElementById("username-box").value;
		var psd = document.getElementById("password-box").value;
		if(name == null || name == ''){
			alert("请输入用户名或者邮箱地址");
			return;
		}
		if(psd == null || psd == ''){
			alert("请输入密码");
			return;
		}
		var loginform = document.getElementById("loginform");
		loginform.submit();
	}
</script>
<body>
	<!-- HEADER -->
	<div id="header" class="navbar navbar-fixed-top">
		<div class="container-fluid ">
			<a class="brand" href="https://wishconsole.com/"> <span
				class="merchant-header-text">Wish管理助手-更有效率的Wish商户实用工具</span>
			</a>
		</div>
	</div>
	<!-- END HEADER -->
	<!-- SUB HEADER NAV-->
	<!-- splash page subheader-->
	<form id="loginform" method="post" action="wuploadproduct.php">
		<div id="page-content" class="container-fluid  ">

			<div id="login-page-content" class="center">

				<div class="clearfix box">
					<div id="login-form">
						<div class="header">登录</div>
						<div class="inputs">
							<?php if($errorMsg != null)
							echo "<ul align=\"center\">".$errorMsg."</ul>";?>
							<div>
								<input value="" id="username-box" type="text" name="username"
									class="login-input input-block-level" required="true"
									placeholder="用户名/邮箱地址">
							
							</div>
							<div>
								<input id="password-box" type="password" name="password"
									class="login-input input-block-level" required="true"
									placeholder="密码">
							
							</div>
							<div class="clearfix control-group lst-elem">
								<div class="pull-left remember-me">
									<label class="checkbox"> <input checked="" id="remember-me"
										type="checkbox"> 记住我 </label>
								</div>
								<div class="pull-right">
									<a class="btn btn-link issue-link pull-right"
										href="wreset.php">忘记密码了？</a>
								</div>
							</div>
							<button id="submit-button" type="button"
									 class="btn btn-large btn-primary btn-block btn-login" onclick="login()">登录</button>
						</div>
					</div>
					<div class="clearfix no-acct-footer">
						<div class="pull-left">还没有帐户？</div>
						<div class="pull-right">
							<a class="btn btn-link issue-link"
								href="wregister.php">注册</a>

						</div>
					</div>
				</div>
			</div>



		</div>
	</form>
	<!-- FOOTER -->
	<div id="footer" class="navbar navbar-fixed-bottom" style="left: 0px;">
		<div class="navbar-inner">
			<div class="footer-container">
				<span><a href="https://wishconsole.com/">关于我们</a></span> <span><a>2016
						wishconsole版权所有 京ICP备16000367号</a>
						<!-- 51.la 网站统计 -->
						<script language="javascript" type="text/javascript" src="http://js.users.51.la/18799105.js"></script>
						<noscript><a href="http://www.51.la/?18799105" target="_blank"><img alt="&#x6211;&#x8981;&#x5566;&#x514D;&#x8D39;&#x7EDF;&#x8BA1;" src="http://img.users.51.la/18799105.asp" style="border:none" /></a></noscript>
				</span>
			</div>
		</div>
	</div>
	<!-- END FOOTER -->
<!-- GoStats JavaScript Based Code -->
<script type="text/javascript" src="https://ssl.gostats.com/js/counter.js"></script>
<script type="text/javascript">_gos='c5.gostats.cn';_goa=1068962;
_got=5;_goi=1;_gol='淘宝店铺计数器';_GoStatsRun();</script>
<noscript><a target="_blank" title="淘宝店铺计数器" 
href="http://gostats.cn"><img alt="淘宝店铺计数器" 
src="https://ssl.gostats.com/bin/count/a_1068962/t_5/i_1/ssl_c5.gostats.cn/counter.png" 
style="border-width:0" /></a></noscript>
<!-- End GoStats JavaScript Based Code -->
</body>
</html>