<?php
session_start ();

include_once dirname ( '__FILE__' ) . './Wish/WishHelper.php';
use mysql\dbhelper;

$access_code = $_GET ['code'];

$clientid = $_POST ["clientid"];
$clientsecret = $_POST ["clientsecret"];
$storename = $_POST ["storename"];

$userid = $_SESSION ['userid'];

$dbhelper = new dbhelper ();
if ($access_code != null) {
	$redirect_uri = urlencode ( 'https://wishconsole.com/user/wbinding.php' );
	$accountid = $_SESSION ['accountid'];
	$clientid = $_SESSION ['clientid'];
	$clientsecret = $_SESSION ['clientsecret'];
	/**
	 * get the access token
	 */
	$url = sprintf ( "https://merchant.wish.com/api/v2/oauth/access_token?&client_id=%s&client_secret=%s&code=%s&redirect_uri=%s&grant_type=authorization_code", $clientid, $clientsecret, $access_code, $redirect_uri );
	
	$context = stream_context_create ( array (
			'http' => array (
					'method' => 'POST',
					'ignore_errors' => true 
			) 
	) );
	
	// Send the request
	$response = file_get_contents ( $url, TRUE, $context );
	echo $response;
	echo "\n";
	
	// get the access token and refresh token
	// json data: {"message":"","code":0,"data":{"expiry_time":1446073198,"token_type ":"access_token","access_token":"c10a316adfb449ffb321984aee91fe50","expires_in":2591918,"merchant_user_id":"535bb01471795166f8be12d0","refresh_token":"3cdbddd6c23249d39ab951d58b454a93"}}
	$response = json_decode ( $response );
	$access_obj = $response->{'data'};
	$access_token = '0';
	$refresh_token = '0';
	foreach ( $access_obj as $k => $v ) {
		echo 'key  ' . $k . '  value:' . $v;
		if ($k == 'access_token') {
			$access_token = $v;
		}
		if ($k == 'refresh_token') {
			$refresh_token = $v;
		}
	}
	echo "\n";
	echo $access_token;
	
	$dbhelper->updateUserToken ( $accountid, $access_token, $refresh_token );
	
	header ( "Location:./wuploadproduct.php" );
} else if ($clientid != null && $clientsecret != null && $storename != null) {
	
	if($dbhelper->isClientidSecretExist($clientid, $clientsecret)){
		header ( "Location:./wbindwish.php?error=该wish账号已经被绑定过,不能重复绑定" );
	}else{
		$result = $dbhelper->addUseraccount ( $userid, $storename, $clientid, $clientsecret );
		if ($result != null) {
			$_SESSION ['accountid'] = $result;
			$_SESSION ['clientid'] = $clientid;
			$_SESSION ['clientsecret'] = $clientsecret;
			header ( "Location:https://china-merchant.wish.com/oauth/authorize?client_id=" . $clientid );
		}	 
	}
}


