<?php

include_once("../common/functions.php");

//Receive Ajax call with parameter userID2Check and check if the received UserID exist in Database USER table.
if(isset($_POST['userID2Check']))
{
	$userID2Check = $_POST['userID2Check'];
	checkUserName($userID2Check);
	exit();
}

function checkUserName($userName)
{
	$_userName = db_select_user_by_UserName($userName);
	if(isset($_userName))
	{
		echo "Y"; //Found UserID in DB
	}
	else
	{
		echo "N"; //NOT found UserID in DB
	}
}

//Receive Ajax call with parameter email2Check and check if the received Email exist in Database USER table.
//if(isset($_POST['email2Check']))
//{
//	$email2Check = $_POST['email2Check'];
//	checkEmail($email2Check);
//	exit();
//}
//
//function checkEmail($email)
//{
//	$_email = db_select_user_by_Email($email);
//	if(isset($_email))
//	{
//		echo "Y"; //Found Email in DB
//	}
//	else
//	{
//		echo "N"; //NOT found Email in DB
//	}
//}

?>