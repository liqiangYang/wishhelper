<html>
<head>
<title>���·��ͼ�����</title>
<meta http-equiv="Conten-Type" content="text/html; charset=gb2312"></meta>
</head>
<body>
<?php
//��ȡ�û����������룬�ʼ���ַ
$UserName1=$HTTP_POST_VARS["UserName"];
$actNum1=$HTTP_POST_VARS["actNum"];
$Email1=$HTTP_POST_VARS["Email"];
$Resend=$HTTP_POST_VARS["Resend"];//����Ƿ���Ҫ�ط�������.�ڵ�����·��ͼ�����󴫵ݵ���������
//����û�Ҫ���ٴη��ͼ�����
include 'config.php';
if ($Resend==1)
{
$query="select * from als_signup where UserName='$UserName1' and Email='$Email1'";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
if ($row)
{
 $actNum=$row["actNum"];
 $subject="������";
 $message="���ļ�����Ϊ��$actNum";
 mail($Email1,$subject,$message);
 ?>
 �������Ѿ����·��ͣ����½�����ȡ�����롣<br>
 ���<a href="activate.php">����</a>���¼��
 <?php
}
else
{
 ?>
 �û������ߵ����ʼ�����<br>
 ���<a href="activate.php">����</a>���ء�
 <?php
}
}
?>
</body>
</html>