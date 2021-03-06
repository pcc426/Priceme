<?php

include_once("../common/functions.php");

healthCheckDB();
healthCheckDBTables();

if( isset($_GET["reg_token"]) && !empty($_GET["reg_token"]) && isset($_GET["email"]) && !empty($_GET["email"]) ){
    //Receive reg_token from GET request
    $_reg_token = $_GET['reg_token'];
	$_email = $_GET['email'];	
	
	//Check if this email and regToken existed in database USER table
	$_user_in_db = array();
	$_user_in_db = db_select_user_by_Email_RegToken($_email, $_reg_token);
		
	if(isset($_user_in_db)){
		//Update LAST_LOGIN_TIME in database USER table
		$_isLogin = login_after_activation($_email, $_reg_token);
		
		if(isset($_isLogin) && $_isLogin){
			$_updated_row_count = db_update_user_remove_RegToken($_email, $_reg_token);
			if(isset($_updated_row_count) && $_updated_row_count == 1){
			    $userID = $_user_in_db[0];
			    $email = $_user_in_db[1];
			    $privilege = $_user_in_db[2];
			    prepare_login_session($userID, $email, $privilege);
			
			    //add notification
			    $now = date("Y-m-d");
			    $nowTime = date("Y-m-d h:i:sa");
			    $nSubject = "User ID:" . $userID . " Account activated successfully!";
			    $nContent = "User ID:" . $userID . " Account activated successfully on " . $now . "!";
			    $notification = new Notification("", "NT01", $nSubject, $nContent, $nowTime, $nowTime);
			    $_notificationID = db_insert_notification($notification);
			    
			    $userNotification = new UserNotification($_notificationID, $userID, "NS01", $nowTime, $nowTime);
			    db_insert_user_notification($userNotification);
			    
				//When login success, go to home page with login session
				header('Location: ../recommend/recom_home.php');
				exit;
			}else{				
				header('Location: ./_activateFailure.php');
				exit;				
			}
		}else{			
			header('Location: ./_activateFailure.php');
			exit;			
		}
	}else{		
		header('Location: ./_activateFailure.php');
		exit;
	}
}

?>