<?php


//---------------------------------------------------------------------------------------------
//����֥���Ȩ���� http://www.286shequ.com
//QQ:470784782
//---------------------------------------------------------------------------------------------
//�����Ự
session_start();
//���ͻ���cookie����Ϊ��ȥʱ�䣬������
setcookie("RememberCookieUserName","UserName",time()-60);
setcookie("RememberCookiePassword","Password",time()-60);
//ɾ���Ự
session_unset();
session_destroy();
//�ص���¼����
header("refresh:1;url=http://localhost/members/login.php");
?>