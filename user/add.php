<?php
//�û�ע���Ժ�����ݴ����ļ�����Ҫ�ȼ�����ݺϷ��ԣ�Ȼ��д�����ݿ�
//��ȡע���û��ύ������
$UserName1=$_POST["UserName"];//�û���
$Password1=$_POST["Password"];//����
$ConfirmPassword1=$_POST["ConfirmPassword"];//ȷ������
$Email1=$_POST["Email"];//����
//���屣�漤�������
$actnum="";
//�������ݿ��ļ�
include 'config.php';
//������������뺯��

//---------------------------------------------------------------------------------------------
//����֥���Ȩ���� http://www.286shequ.com
//QQ:470784782
//---------------------------------------------------------------------------------------------
function Check_actnum()
{
$chars_for_actnum=array("A","B","C","D","E","F","G","H","I","J","K","L",
"M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","a","b","c","d",
"e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v",
"w","x","y","z","1","2","3","4","5","6","7","8","9","0"
);
for ($i=1;$i<=20;$i++)//����һ��20���ַ��ļ�����
{
 $actnum.=$chars_for_actnum[mt_rand(0,count($chars_for_actnum)-1)];
}
return $actnum;
}
//�ж��û�������
function Check_username($UserName)//����Ϊ�û�ע����û���
{
 //�û�������������
 //�Ƿ�Ϊ��   �ַ������   ���ȼ��
 $Max_Strlen_UserName=16;//�û�����󳤶�
 $Min_Strlen_UserName=4;//�û�����̳���
 $UserNameChars="^[A-Za-z0-9_-]";//�ַ�������������ʽ
 $UserNameGood="�û��������ȷ";//���巵�ص��ַ�������
 if($UserName=="")
 {
  $UserNameGood="�û�������Ϊ��";
  return $UserNameGood;
 }
 if(!ereg("$UserNameChars",$UserName))//������ʽƥ����
 {
  $UserNameGood="�û����ַ�����ⲻ��ȷ";
  return $UserNameGood;
 }
 if (strlen($UserName)<$Min_Strlen_UserName || strlen($UserName)>$Max_Strlen_UserName)
 {
  $UserNameGood="�û����ֳ��ȼ�ⲻ��ȷ";
  return $UserNameGood;
 }
 return $UserNameGood;
}
//�ж������Ƿ�Ϸ�����
function Check_Password($Password)
{
 //�Ƿ�Ϊ��    �ַ������      ���ȼ��
 $Max_Strlen_Password=16;//������󳤶�
 $Min_Strlen_Password=6;//������̳���
 $PasswordChars="^[A-Za-z0-9_-]";//�����ַ������������ʽ
 $PasswordGood="��������ȷ";//���巵�ص��ַ�������
 if($Password=="")
 {
  $PasswordGood="���벻��Ϊ��";
  return $PasswordGood;
 }
 if(!ereg("$PasswordChars",$Password))
 {
  $PasswordGood="�����ַ�����ⲻ��ȷ";
  return $PasswordGood;
 }
 if(strlen($Password)<$Min_Strlen_Password || strlen($Password)>$Max_Strlen_Password)
 {
  $PasswordGood="���볤�ȼ�ⲻ��ȷ";
  return $PasswordGood;
 }
 return $PasswordGood;
}
//�ж������Ƿ�Ϸ�����
function Check_Email($Email)
{
 $EmailChars="^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*$";//������ʽ�ж��Ƿ��ǺϷ������ַ
 $EmailGood="��������ȷ";
 if($Email=="")
 {
  $EmailGood="���䲻��Ϊ��";
  return $EmailGood;
 }
 if(!ereg("$EmailChars",$Email))//������ʽƥ����
 {
  $EmailGood="�����ʽ����ȷ";
  return $EmailGood;
 }
 return $EmailGood;
}
//�ж��������������Ƿ�һ��
function Check_ConfirmPassword($Password,$ConfirmPassword)
{
 $ConfirmPasswordGood="������������һ��";
 if($Password<>$ConfirmPassword)
 {
  $ConfirmPasswordGood="�����������벻һ��";
  return $ConfirmPasswordGood;
 }
 else
 return $ConfirmPasswordGood;
}
//���ú���������û����������
$UserNameGood=Check_username($UserName1);
$PasswordGood=Check_Password($Password1);
$EmailGood=Check_Email($Email1);
$ConfirmPasswordGood=Check_ConfirmPassword($Password1,$ConfirmPassword1);
$error=false;//��������ж�ע�������Ƿ���ִ���
if($UserNameGood !="�û��������ȷ")
{
  $error=true;//�ı�error��ֵ��ʾ�����˴���
     echo $UserNameGood;//���������Ϣ
     echo "<br>";
}
if($PasswordGood !="��������ȷ")
{
 $$error=true;
 echo $PasswordGood;
 echo "<br>";
}
if($EmailGood !="��������ȷ")
{
 $error=true;
 echo $EmailGood;
 echo "<br>";
}
if ($ConfirmPasswordGood !="������������һ��")
{
 $error=true;
 echo $ConfirmPasswordGood;
 echo "<br>";
}
//�ж����ݿ����û�����email�Ƿ��Ѿ�����
$query="select * from als_signup where UserName='$UserName1' or Email='$Email1'";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
$error=false;
if($row)
{
 if ($row["UserName"]==$UserName1)
 {
  $error=true;
  echo "�û����Ѵ���<br>";
 }
 if ($row["Email"]==$Email1)
 {
  $error=true;
  echo "�û������Ѿ�ע��<br>";
 }
}
//������ݼ�ⶼ�Ϸ������û�����д�����ݿ��
if ($error==false) //$error==false��ʾû�д���
{
 $actnum=Check_actnum();//���ü����뺯��
 $Datetime=date("d-m-y G:i");//��ȡע��ʱ�䣬Ҳ��������д�뵽�û����ʱ��
 $query="insert into als_signup (UserName,Password,Email,actNum,UserLevel,SignUpdate,LastLogin,LastLoginFail,NumLoginFail)
 values ('$UserName1','$Password1','$Email1','$actnum','1','$Datetime','0','0','0')";
 $result=mysql_query($query);
 $to=$Email1;//�û�ע�������
    $subject="������";
    $message="���ļ�����Ϊ$actnum";
    $header="From:kristin-wang@163.com"."\r\n";//�ʼ�ͷ��Ϣ
    
     //�������ӣ����ӵ�����ҳ��
     ?>
     ���½�����ȡ�����롣Ȼ����<a href="activate.php">����</a>���
     <?php
}
?>