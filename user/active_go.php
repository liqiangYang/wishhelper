<html>
<head>
<title>����</title>
<meta http-equiv="Conten-Type" content="text/html; charset=gb2312"></meta>
</head>
<body>
<?php
//��ȡ�û�����������
$UserName1=$HTTP_POST_VARS["UserName"];
$actNum1=$HTTP_POST_VARS["actNum"];
include 'config.php';
//����û����ͼ������Ƿ���ȷ
$query="select * from als_signup where UserName='$UserName1' and actNum='$actNum1'";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
if ($row)
{
 //����û����ͼ�������ȷ���ɹ���������ݿ���м�������Ϊ0
 $query="update als_signup set actNum='0' where UserName='$UserName1'";
 $result=mysql_query($query);
 ?>
 ���Ѿ��ɹ������˺š�<br>
 ����<a href="login.php">����</a>��½
 <?php
}
else
{
 echo "�û������߼���������뷵����������<br>";
 ?>
 <a href="activate.php">����</a>
 <?php
}
?>
</body>
</html>