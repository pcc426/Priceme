<?php

include_once("../common/functions.php");

//healthCheckDB();
//healthCheckDBTables();
//check_session_timeout();

session_start();



$isFormDataValid = true;

//define input field variables to keep user input value and show on the page when server side validation failure
$userIDEmail = "";
$pass = "";


//define server side error message variables and set to empty values
$userIDEmailMsg_php = "";
$passMsg_php = "";
$serverErrMsg_php = "<div class='alert mt-4 alert-success'></div>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$userIDEmail = optimizateInput($_POST["userIDEmail"]);	
	$pass = optimizateInput($_POST["pass"]);	//No need to display password when server side validation is failed
	
	// ******** [START] User ID / Email validation ********
	if(empty($userIDEmail)) {
		$userIDEmailMsg_php = "[E601] User ID / Email must be input!";
	}
	
	if($userIDEmailMsg_php != ""){
		$isFormDataValid = false;
	}
	// ******** [END] User ID / Email validation ********
	
	// ******** [START] Password validation ********
	if(empty($pass)) {
		$passMsg_php = "[E602] Password must be input!";	
	}

	/*
		Check password format and character combination
		rule 1 : Password length must be 8 - 20 characters
		rule 2 : Password must contain at least 2 upper case characters
		rule 3 : Password must contain at least 2 lower case characters
		rule 4 : Password must contain at least 2 numeric characters
		rule 5 : Password must contain at least 2 special characters
	*/
	if($passMsg_php == "" && !empty($pass)) {
//		$anUpperCase = "#[A-Z]#";
//		$aLowerCase = "#[a-z]#";
//		$aNumber = "#[0-9]#";
//		$aSpecial =  "#(?=\S*[\W])#"; //"#[!|@|#|$|%|^|&|*|(|)|-|_]#";
		
		if (strlen($pass) < 6 || strlen($pass) > 20) {
			$passMsg_php = "[E603] Password length must be 8 - 20 characters!";
		}
//		else if (!preg_match($anUpperCase, $pass)) {
//			$passMsg_php = "[E604] Password must contain at least 2 upper case characters!";
//		}
//		else if (!preg_match($aLowerCase, $pass)) {
//			$passMsg_php = "[E605] Password must contain at least 2 lower case characters!";
//		}
//		else if (!preg_match($aNumber, $pass)) {
//			$passMsg_php = "[E606] Password must contain at least 2 numeric characters!";
//		}
//		else if (!preg_match($aSpecial, $pass)) {
//			$passMsg_php = "[E607] Password must contain at least 2 special characters!";
//		}
	}
	
	if($passMsg_php != ""){
		$isFormDataValid = false;
	}
	// ******** [END] Password validation ********
		
	if($isFormDataValid)
	{
		$result = login_by_userId_or_email_password($userIDEmail, $pass);
		
		if($result == "true") {
			//login successfully
			//reset form data in the post request
			unset($_POST);
			
			//go to home page
			header('Location: ../recommend/recom_home.php');
			exit;
		} else {
			//login failed
			$serverErrMsg_php = "<div class='alert mt-4 alert-danger'><span>[E608] Login failed, please try again!</span></div>";
		}
	}
}

?>

<html>
	<head>
		<meta charset="utf-8">
		
		<title>Priceme - Login</title>
		
		<?php include_once("../import.php");?>
		
		<link rel="stylesheet" href="../unicorn.css" type="text/css">
		<link rel="stylesheet" href="./login.css" type="text/css">
		<script type="text/javascript" src="./login.js"></script>
    		
	</head>

	<body>
		<form name="loginForm" method="post" action="login.php">
			<div id="loading"></div>
			<div id="app"  style="display:none;" >						
				<div>
					
					<?php include_once("../leftPanel.php");?>
					
					
					<!-- ******** [START] Right panel ******** -->
					<div id="right-panel" class="right-panel">
						
						<?php include_once("../header.php");?>

						<!-- ******** [START] Navigation Body ******** -->
						<div>
							<div>

                                <?php
                                if(isset($_SESSION['userName'])){
                                    echo 'You are Logged as '.$_SESSION['userName'].'<br/>';
                                    $userID_In_Session = $_SESSION['userID'];
                                }else{
                                    echo'
                                    <div class="container">
                                    <br>
									<h3 style="color:#ca1515">Login</h3>
									<hr>
									<label class="mandatory_field">* Mandatory field</label><br><br>
									<div>
										<label class="login_label">User ID / Email : </label><label class="mandatory_field">*</label> 
										<input class="login_input" type="text" id="userIDEmail" name="userIDEmail" maxlength="50"  >
										<span class="login_err" id="userIDEmailMsg" ><?php if(isset($userIDEmailMsg_php)){echo $userIDEmailMsg_php;} ?></span>
									</div>
									
									<div>
										<label class="login_label">Password : </label><label class="mandatory_field">*</label> 
										<input class="login_input" type="password" id="pass" name="pass" maxlength="100" >
										<span class="login_err" id="passMsg" ><?php if(isset($passMsg_php)){echo $passMsg_php;} ?></span>
									</div>
									<br><br>
									<div>
									 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									 <input class="login_input4" type="reset" name="Reset" value="Reset" onclick="resetErrMsg();">
									 <input class="login_input5" type="submit" name="login" value="Login">
									</div>
								</div>
                                    ';
                                }
                                ?>

                            </div>
						</div>
						<!-- ******** [END] Navigation Body ******** -->
						
					</div>
					<!-- ******** [END] Right panel ******** -->
					
					
				</div>
			</div>
		</form>
	</body>
</html>