<?php
//����ʾ��¼����֮ǰ�������ж��Ƿ񱣴����û���¼��Ϣ������У����Զ���¼
include 'config.php';
session_start();//�����Ự
$query="select * from als_signup where UserName='{$_SESSION['UserName']}' and Password='{$_SESSION['Password']}'";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
if ($row)
{
 //���session�Ự�����û���������ƥ�䣬���Զ���¼��ֱ����ת������ҳ��
header("refresh:1;url=http://localhost/members/manage.php");
exit;
}
?>
<html>
<head>
<title>�û���¼</title>
</head>
<body>
<form name="form1" method="post" action="login_go.php">
�û�����<input name="UserName" type="text" size="20" id="UserName"></input><br>
��&nbsp;&nbsp;�룺<input name="Password" type="password" size="20" id="Password"></input><br>
<input name="KeepInfo" type="checkbox" value="KeepInfo"></input>�����¼��Ϣ(7��)<br><br>
<input name="Submit" type="submit" value="��¼"></input>
</form>
<a href="forgot.php">�������룿</a>
<a href="SignUp.php">ע�����û�</a>
</body>
</html>