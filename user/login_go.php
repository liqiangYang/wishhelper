<?php
include 'config.php';
session_start();//�����Ự
//��ȡ�û��ĵ�¼��Ϣ���û��������룬�Ƿ񱣴���Ϣ
$UserName1=$HTTP_POST_VARS["UserName"];
$Password1=$HTTP_POST_VARS["Password"];
$Remember=$HTTP_POST_VARS["KeepInfo"];
//����û�����˱����¼��Ϣ����Remember��Ϊ1��������Ϊ0
if ($Remember=="KeepInfo")
{
 $Remember="1";
}
else
{
 $Remember="0";
}
//��ѯ�û����Ƿ����
$query="select * from als_signup where UserName='$UserName1'";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
if ($row)
{
 //��ѯ�û��Ƿ��Ѿ�����
 if ($row["actNum"]=="0")
 {
  //�жϵ�¼ʧ�ܴ����Ƿ�С�ڵ���5��
  if ($row["NumLoginFail"]<=5)
  {
   //�ж������Ƿ���ȷ
   if ($row["Password"]==$Password1)
   {
    //���������ȷ���޸������¼ʱ�䣬����¼ʧ����Ϣ���
    $datetime=date("d-m-Y G:i");
    $query="update als_signup set LastLogin='$datetime' where UserName='$UserName1'";
    $result=mysql_query($query);
    $query="update als_signup set NumLoginFail='0' where UserName='$UserName1'";
    $result=mysql_query($query);
    //�����Ự�������¼��Ϣ
    session_unset();//ɾ���Ự
    session_destroy();
    session_register("Password");//�����Ự��������������
    $HTTP_SESSION_VARS["Password"]=$Password1;
    session_register("UserName");//�����û���
    $HTTP_SESSION_VARS["UserName"]=$UserName1;
    //����cookie���ͻ��ˣ����뱻����
    if ($Remember=="1")
    {
     setcookie("RememberCookieUserName",$UserName1,(time()+604800));
     setcookie("RememberCookiePassword",md5($Password1),(time()+604800));
    }
    //��¼�ɹ���ҳ��ת������ҳ��
    header("refresh:1;url=http://localhost/members/manage.php");
       exit;
   }
   else
   {
       //������󣬵�¼ʧ��
       //����ϴε�¼ʧ��ʱ���Ƿ���5min֮�ڣ�������ǣ����¼ʧ�ܴ�������1
      $datetime=date("d-m-Y G:i ",strtotime("-5 minutes"));//��ȡ5������ǰ��ʱ��
      $timenow=date("d-m-Y G:i ");//��ȡ���ڵ�ʱ��
       if($row["LastLoginFail"]<$datetime)//����5min֮��
       {
       //��¼ʧ�ܴ�����1
       $query="update als_signup set NumLoginFail=NumLoginFail+1 where UserName='$UserName1'";
       $result=mysql_query($query);
       //�޸ĵ�¼ʧ��ʱ��
       $query="update als_signup set LastLoginFail='$timenow' where UserName='$UserName1'";
       $result=mysql_query($query);
       //���ص���¼ҳ��
       header("refresh:5;url=http://localhost/members/login.php");
       echo "�����������������<br>5����Զ�����";
       }
       else  //��5min֮�ڣ�ֻ�޸ĵ�¼ʧ��ʱ��
       {
       $query="update als_signup set LastLoginFail='$timenow' where UserName='$UserName1'";
       $result=mysql_query($query);
       //���ص���¼ҳ��
       header("refresh:5;url=http://localhost/members/login.php");
       echo "�����������������<br>5����Զ�����";
       }
   }
  }
  else
  {
  //ʧ�ܴ�������5��
  //���ʱ�䣬����ϴε�¼ʧ���ڰ��Сʱǰ������������û�һ�����µ�¼���ᡣֻ��һ�λ���
  $datetime=date("d-m-Y G:i, ",strtotime("-30 minutes"));
  if($row["LastLoginFail"]<$datetime)  //���Сʱ��ǰ
  {
  $query="update als_signup set NumLoginFail='5' where UserName='$UserName1'";
  $result=mysql_query($query);
  }
  else
  {
   //���Сʱ�ڣ��������ʻ������ص���¼ҳ�棬���Сʱ�����
  $timenow=date("d-m-Y G:i ");
  $query="update als_signup set LastLoginFail='$timenow' where UserName='$UserName1'";
  $result=mysql_query($query);
  header("refresh:5;url=http://localhost/members/login.php");
  echo "�����˺�Ŀǰ�����������Сʱ���Զ���������������¼��";
  echo "<br>5����Զ�����";
  exit;
  }
  }
 }
 //�����벻Ϊ0.�û���Ҫ����
    else
    {
    header("refresh:5;url=http://localhost/members/activate.php");
    echo "�����˺�û�м���뼤����½��<br>5����Զ���ת������ҳ�档";
    }
}
else
{
header("refresh:5;url=http://localhost/members/login.php");
echo "�����û�������ȷ���뷵���������롣<br>5����Զ����ء�";
}
?>