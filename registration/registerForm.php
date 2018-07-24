<html>
	<head>
		<meta charset="utf-8">

		<title>Priceme</title>

		<?php include_once("../import.php");?>

		<link rel="stylesheet" href="../unicorn.css" type="text/css">
		<link rel="stylesheet" href="./registration.css" type="text/css">
		<script type="text/javascript" src="./registration.js"></script>

	</head>
	<body>
		<form name="regForm" method="post" action="register.php" >
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

								<!-- ******** [START] User Registration Division ******** -->
								<div class="container">
									<h3>Sign Up</h3>
									<hr>
									<label class="mandatory_field">* Mandatory field</label><br>
									<div>
										<label class="reg_label">User Name<label class="mandatory_field">*</label> : </label>
										<input class="reg_input" type="text" id="userName" name="userName" maxlength="50" value="<?php if(isset($userName)){echo $userName;} ?>" >
										<span class="reg_info" id="userNameInfoMsg" ><?php if(isset($userNameInfoMsg_php)){echo $userNameInfoMsg_php;} ?></span>
										<span class="reg_err" id="userNameMsg" ><?php if(isset($userNameMsg_php)){echo $userIDMsg_php;} ?></span>
									<div>

									<div>
										<label class="reg_label">Password<label class="mandatory_field">*</label> : </label>
										<input class="reg_input" type="password" id="pass" name="pass" maxlength="100" value="<?php if(isset($pass)){echo $pass;} ?>" >
										<span class="reg_err" id="passMsg" ><?php if(isset($passMsg_php)){echo $passMsg_php;} ?></span>
									<div>

									<div>
										<label class="reg_label">Repeat Password<label class="mandatory_field">*</label> : </label>
										<input class="reg_input" type="password" id="repeatPass" name="repeatPass" maxlength="100" value="<?php if(isset($repeatPass)){echo $repeatPass;} ?>" >
										<span class="reg_err" id="repeatPassMsg" ><?php if(isset($repeatPassMsg_php)){echo $repeatPassMsg_php;} ?></span>
									<div>

									<div>
										<label class="reg_label">User Category : </label>
										<input class="reg_radio" type="radio" name="userCategory" value="Customer"  />&nbsp;Customer
										<input class="reg_radio" type="radio" name="userCategory" value="Vendor" />&nbsp;Vendor
									<div>
									<hr>
									<br>
									<div>
										<input class="reg_input3" type="checkbox" id="tc" name="tc" value="agree" >
										<label class="reg_label3">To create an account,you should agree to our <a href="./registerTerms&Conditions.php" >Terms & Conditions</a>.<label class="mandatory_field">*</label></label>
										<span class="reg_err" id="tcMsg" ><?php if(isset($tcMsg_php)){echo $tcMsg_php;} ?></span>
									<div>

									<hr>



									<div>
									  <div class="button_alignment">
									  	<input class="reg_input4" type="reset" name="Reset" value="Reset" onclick="resetErrMsg();">
									  	<input class="reg_input5" type="submit" name="signUp" value="Sign Up">
								  </div>
								<!-- ******** [END] User Registration Division ******** -->

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