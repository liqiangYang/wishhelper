<?php
session_start ();
use mysql\dbhelper;
include '../mysql/dbhelper.php';
header ( "Content-Type: text/html;charset=utf-8" );
$dbhelper = new dbhelper();

$username = $_SESSION ['username'];
session_commit();

$error = $_GET['error'];
if($username == null){
	$type = $_GET ['type'];
	if(strcmp($type,"register") == 0){
		$email = $_POST ["email"];
		$username = $_POST ["username"];
		$password = $_POST ["password"];
		$check = $dbhelper->queryUser($username, $email);
		$checkrow=mysql_fetch_array($check);
		if($checkrow){
			if($checkrow['username'] == $username){
				header("Location:./wregister.php?errorMsg=该用户已经存在");
				exit;
			}
			if($checkrow['email'] == $email){
				header("Location:./wregister.php?errorMsg=该邮箱地址已经被注册");
				exit;
			}
		}else{
			$result = $dbhelper->createUser($username, md5($password), $email);
			if($result !== false){
				$_SESSION ['username'] = $username;
			}else{
				header("Location:./wregister.php?errorMsg=注册失败");
				exit;
			}
		}
	}else{
		//login;
		$username = $_POST["username"];
		$password = $_POST ["password"];
	
		$dbhelper = new dbhelper();
		$result = $dbhelper->userLogin($username, md5($password));
		$row=mysql_fetch_array($result);
		if($row){
			$_SESSION ['username'] = $username;
		}else{
			header("Location:http://localhost/wishhelper/user/wlogin.php?errorMsg=登录失败");
			exit;
		}
	}
}else{
	$result = $dbhelper->getUserToken ( $username );
	$accounts = array ();
	$i = 0;
	while ( $rows = mysql_fetch_array ( $result ) ) {
		if($rows ['token'] != null){
			$accounts ['clientid' . $i] = $rows ['clientid'];
			$accounts ['clientsecret' . $i] = $rows ['clientsecret'];
			$accounts ['token' . $i] = $rows ['token'];
			$accounts ['refresh_token' . $i] = $rows ['refresh_token'];
			$accounts ['accountid' . $i] = $rows ['accountid'];
			$accounts ['accountname' . $i] = $rows ['accountname'];
			$i ++;
		}
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0031)http://china-merchant.wish.com/ -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Wish管理助手-更有效率的Wish商户实用工具</title>
			<meta name="keywords" content="">
				<link rel="stylesheet" type="text/css" href="../css/home_page.css">
					<link href="../css/bootstrap.min.css" rel="stylesheet">
						<script src="../js/jquery-2.2.0.min.js"></script>
						<script src="../js/bootstrap.min.js"></script>
</head>
<body>
<!-- HEADER -->
<!-- HEADER -->
	<div id="header" class="navbar navbar-fixed-top 
" style="left: 0px;">
		<div class="container-fluid ">
			<a class="brand" href="https://wishconsole.com/"> <span
				class="merchant-header-text">Wish管理助手-更有效率的Wish商户实用工具</span>
			</a>

			<div class="pull-right">
				<ul class="nav">
					<li data-mid="5416857ef8abc87989774c1b"
						data-uid="5413fe984ad3ab745fee8b48">
<?php echo $username?>	
</li>
					<li><button>
							<a href="./wlogin.php?type=exit">注销</a>
						</button></li>

				</ul>

			</div>

		</div>
	</div>
	<!-- END HEADER -->
<div id="sub-header-nav" class="navbar navbar-fixed-top sub-header"
		style="left: 0px;">
		<div class="navbar-inner">
			<div class="container-fluid">
				<div class="pull-left">
					<div class="navbar-inner">
						<div class="container">
						<?php include("./menu.php");?>
						</div>
					</div>
					<!-- /navbar-inner -->
				</div>

				<div class="pull-right">
					<ul class="nav">
					</ul>
				</div>

			</div>
		</div>
	</div>
	<!-- END SUB HEADER NAV -->
<div class="banner-container">
</div>
<form id="bind_form" action="./wwishpostbinding.php" method="post">
<div id="page-content" class="container-fluid  user">
<?php 
if(isset($error)){
	echo "<div class=\"alert alert-block alert-success fade in\">";
	echo "<h4 class=\"alert-heading\">";
	echo $error;
	echo "</h4>";
	echo "</div>";
}
?>
<ul>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h3>在线客服：<a href="tencent://message/?uin=409326210&Site=l.com&Menu=yes"><img border="5" src="http://wpa.qq.com/pa?p=1:409326210:3" alt="QQ联系"/></a></h3></ul>
<div class="col-md-6">
<ul>&nbsp;&nbsp;&nbsp;&nbsp;<h4>请在wish邮设置页(左侧API设置处)，先创建一个Private app：</h4></ul> 
<ul><h5>1，请在"name"项填写应用名称: 可任意填写 </h5></ul>
<ul><h5>2，请在"Redirect URI"项填写如下网址: https://wishconsole.com/user/wwishpostbinding.php</h5></ul>
<ul><h5>3，保存得到客户id,客户端密钥</h5></ul>
<br/>

<ul><h4> 然后复制并填写如下Private app验证信息：(可参考右侧图片)</h4></ul>
<!-- &nbsp;&nbsp;&nbsp;&nbsp;<h4>该功能暂不开放,如有需要,请联系管理员admin@wishconsole.com</h4></ul> -->

 <br/>
<ul><h5>1，请填写&nbsp;&nbsp;客户id：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="clientid" type="text" name="clientid" value=""/></h5></ul>
<br/>
<ul><h5>2，请填写&nbsp;&nbsp;客户端密钥：&nbsp;&nbsp;<input id="clientsecret" type="text" name="clientsecret" value=""/></h5></ul>
<br/>
<ul><h5>3，请填写wish邮用户名称：&nbsp;&nbsp;<input id="storename" type="text" name="storename" value=""/></h5></ul>
<br/>
<ul><h5>4，请选择wish邮对应的Wish账号:
<?php
							if ($i>0){
								for($count = 0; $count < $i; $count ++) {
									if($count != 0 && $count%3 == 0)
										echo "<br/>";
									echo "<input type=\"radio\" id=\"currentAccountid\" name=\"currentAccountid\" value=\"" . $accounts ['accountid' . $count] . "\"" . ($accountid == null ? ($count == 0 ? "checked" : "") : ((strcmp ( $accounts ['accountid' . $count], $accountid ) == 0) ? "checked" : "")) . ">";
									echo "&nbsp;&nbsp;" . $accounts ['accountname'.$count];
									echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
								}	
							}else{
								echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您暂时没有绑定任何wish账号，请先&nbsp;&nbsp;&nbsp;&nbsp;";
							}
							 echo "<a href=\"./wbindwish.php\">绑定wish账号</a>";
							
							?>
</h5></ul>
<br/>
<ul><button type="button" id="bind">申请Wish邮授权</button></ul>
 </div>
<div class="col-md-6"><img src="../image/bind.jpg"></img>  </div>
</div>
<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;为保证能正常访问https://merchant.wish.com完成授权，建议使用如下免费VPN，翻墙操作</h3>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://cht.li/krwat" target="_blank"><img src="../image/VPNchitu.jpg" alt="免费VPN" /></a>
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
	
<script type="text/javascript" src="../js/jquery-2.2.0.min.js" charset="UTF-8"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#bind").click(function(){
  	if($("#clientid").val() == ""){
  		alert("请输入Client Id值");
  		return;
  	}
  	if($("#clientsecret").val() == ""){
  		alert("请输入Client Secret值");
  		return;
  	}
  	if($("#storename").val() == ""){
  		alert("请输入店铺名称");
  		return;
  	}

  	if($.trim($("#clientid").val()).length<24){
		alert("请参考右侧图片，填写正确的clientid值");
		return;
    }
    
  	if($.trim($("#clientsecret").val()).length<32){
  		alert("请参考右侧图片，填写正确的clientsecret值");
  		return;
    }
  	  	
  	if($("#clientid").val() != "" && $("#clientsecret").val() != "" && $("#storename").val() != ""){
  	  	$("#bind_form").submit()}	
  });
});
</script>
</body>
</html>