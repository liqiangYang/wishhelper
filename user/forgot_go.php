<?php
//��ȡ�û���������
$UserName1=$HTTP_POST_VARS["UserName"];
$Email1=$HTTP_POST_VARS["Email"];
include 'config.php';
//��ѯ�û����������Ƿ���ڲ���ƥ��
$query="select * from als_signup where UserName='$UserName1' and Email='$Email1'";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
if ($row)
{
 //��ѯ�ɹ����������뵽�û�ע������
 $to=$Email1;
 $subject="����";
    $message="��������Ϊ". $row["Password"];
    if (mail($to,$subject,$message))
    {
     header("refresh:5;url=http://localhost/members/login.php");
     echo "�����Ѿ����͵��������䣬�����<br>5����Զ���ת����¼ҳ��";
     exit;
    }
}
else
{
 header("refresh:5;url=http://localhost/members/forgot.php");
 echo "�û����������������ȷ������Ϊע���û�ʱ������<br>5����Զ�����";
 exit;
}
?>