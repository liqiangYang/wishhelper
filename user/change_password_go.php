<?php
session_start();
//ȡ���޸���������ݣ�ԭʼ���룬�����룬ȷ�ϵ�������
$OldPassword1=$HTTP_POST_VARS["OldPassword"];
$NewPassword1=$HTTP_POST_VARS["NewPassword"];
$NewPasswordAgain=$HTTP_POST_VARS["NewPasswordAgain"];
//�������ݿ������ļ�
include '../config.php'; //../��ʾ��һ��Ŀ¼
//�ж�ԭʼ�����Ƿ�Ϊ�գ����������������Ƿ�һ��
if ($OldPassword1!="" && $NewPassword1==$NewPasswordAgain)
{
//�޸ı��е����룬ע���õ�session�����û���������ͬʱ�жϲ�ѯ
$query="select * from als_signup where UserName='{$_SESSION['UserName']}' and Password='$OldPassword1'";
 //����Ҫ������ǰ����{}����Ȼ�޷���������������{}��Ҫ�����ʶ�������Ƕ�̬������
$result=mysql_query($query);
$row=mysql_fetch_array($result);
if ($row)
{
//�޸����룬ͬʱ�޸�session�Ự����������
$query="update als_signup set Password='$NewPassword1' where UserName='{$HTTP_SESSION_VARS['UserName']}'";
$result=mysql_query($query);
$HTTP_SESSION_VARS["Password"]=$NewPassword1;
//�޸ĳɹ�����ת�ص�Ĭ�Ϲ���ҳ��
header("refresh:3;url=http://localhost/members/manage.php");
echo "�����޸ĳɹ���3���Ӻ��Զ����ص�����ҳ��";
exit;
}
else
{
//ԭʼ����������󣬵������ݿ���ѯʧ��
//�����޸�����ҳ�棬��������
header("refresh:3;url=http://localhost/members/manage/change_password.php");
echo "ԭʼ���������������������<br>3���Ӻ��Զ�����";
exit;
}
}
else
{
if ($OldPassword1=="")//���ԭʼ����Ϊ��
{
//�����޸�����ҳ�棬��������
header("refresh:3;url=http://localhost/members/manage/change_password.php");
echo "ԭʼ���벻��Ϊ�գ�����������<br>3���Ӻ��Զ�����";
exit;
}
else //����������������벻һ��
{
//�����޸�����ҳ�棬��������
header("refresh:3;url=http://localhost/members/manage/change_password.php");
echo "�������������벻һ�£�����������<br>3���Ӻ��Զ�����";
exit;
}
}
?>
 
 