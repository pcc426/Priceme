<html>
	<head>
		<meta charset="utf-8">

		<title>Unicorn Restaurant - Registration</title>

		<?php include_once("../import.php");?>

		<link rel="stylesheet" href="../unicorn.css" type="text/css">
		<link rel="stylesheet" href="../registration/registration.css" type="text/css">
		<script type="text/javascript" src="../unicorn.js"></script>
		<script type="text/javascript" src="../registration/registration.js"></script>

	</head>

	<body>
		<form name="regForm" method="post" action="../registration/register.php" onsubmit="return formSubmit()">
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

								<!-- ******** [START] Alert Message Display ******** -->
<!--								<div class="alert mt-4 alert-success">-->
<!--<!--									<span>We promise to deliver the freshest foods to you as soon as possible.</span>-->
<!--								</div>-->
								<!-- ******** [END] Alert Message Display ******** -->



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

<!--									<div>-->
<!--										<label class="reg_label">Email<label class="mandatory_field">*</label> : </label>-->
<!--										<input class="reg_input" type="email" id="email" name="email" maxlength="100" value="--><?php //if(isset($email)){echo $email;} ?><!--" >-->
<!--										<span class="reg_info" id="emailInfoMsg" >--><?php //if(isset($emailInfoMsg_php)){echo $emailInfoMsg_php;} ?><!--</span>-->
<!--										<span class="reg_err" id="emailMsg" >--><?php //if(isset($emailMsg_php)){echo $emailMsg_php;} ?><!--</span>-->
<!--									<div>-->

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
<!---->
<!--									<hr>-->
<!---->
<!--									<div>-->
<!--										<label class="reg_label">English Surname<label class="mandatory_field">*</label> : </label>-->
<!--										<input class="reg_input" type="text" id="engSurname" name="engSurname" maxlength="50" value="--><?php //if(isset($engSurname)){echo $engSurname;} ?><!--" >-->
<!--										<span class="reg_err" id="engSurnameMsg" >--><?php //if(isset($engSurnameMsg_php)){echo $engSurnameMsg_php;} ?><!--</span>-->
<!--									<div>-->
<!---->
<!--									<div>-->
<!--										<label class="reg_label">English Middle Name<label class="mandatory_field">*</label> : </label>-->
<!--										<input class="reg_input" type="text" id="engMidName" name="engMidName" maxlength="50" value="--><?php //if(isset($engMidName)){echo $engMidName;} ?><!--" >-->
<!--										<span class="reg_err" id="engMidNameMsg" >--><?php //if(isset($engMidNameMsg_php)){echo $engMidNameMsg_php;} ?><!--</span>-->
<!--									<div>-->
<!---->
<!--									<div>-->
<!--										<label class="reg_label">English Name : </label>-->
<!--										<input class="reg_input" type="text" id="engName" name="engName" maxlength="50" value="--><?php //if(isset($engName)){echo $engName;} ?><!--">-->
<!--										<span class="reg_err" id="engNameMsg" >--><?php //if(isset($engNameMsg_php)){echo $engNameMsg_php;} ?><!--</span>-->
<!--									<div>-->

									<div>
										<label class="reg_label">User Category : </label>
										<input class="reg_radio" type="radio" name="userCategory" value="Customer"  />Customer
										<input class="reg_radio" type="radio" name="userCategory" value="Vendor" />Vendor
<!--										<span class="reg_err" id="sexMsg" >--><?php //if(isset($sexMsg_php)){echo $sexMsg_php;} ?><!--</span>-->
									<div>

									<hr>

<!--									<div>-->
<!--										<label class="reg_label">Contact Phone No.<label class="mandatory_field">*</label> : </label>-->
<!--										<input class="reg_input" type="text" id="tel" name="tel" maxlength="8" value="--><?php //if(isset($tel)){echo $tel;} ?><!--" >-->
<!--										<span class="reg_err" id="telMsg" >--><?php //if(isset($telMsg_php)){echo $telMsg_php;} ?><!--</span>-->
<!--									<div>-->
<!--
									<label class="reg_label">Delivery Address<label class="mandatory_field">*</label> : </label>
									<div>										
										<input class="reg_input2" type="text" placeholder="Flat and floor no." id="address1" name="address1" maxlength="100" value="<?php if(isset($address1)){echo $address1;} ?>" >
										<span class="reg_err" id="address1Msg" ><?php if(isset($address1Msg_php)){echo $address1Msg_php;} ?></span>
									<div>

									<div>
										<input class="reg_input2" type="text" placeholder="Name of building" id="address2" name="address2" maxlength="100" value="<?php if(isset($address2)){echo $address2;} ?>" >
										<span class="reg_err" id="address2Msg" ><?php if(isset($address2Msg_php)){echo $address2Msg_php;} ?></span>
									<div>

									<div>
										<input class="reg_input2" type="text" placeholder="Building no. and name of street" id="address3" name="address3" maxlength="100" value="<?php if(isset($address3)){echo $address3;} ?>" >
										<span class="reg_err" id="address3Msg" ><?php if(isset($address3Msg_php)){echo $address3Msg_php;} ?></span>
									<div>
									
									<div>
										<input class="reg_input2" type="text" placeholder="District" id="address4" name="address4" maxlength="100" value="<?php if(isset($address4)){echo $address4;} ?>" >
										<span class="reg_err" id="address4Msg" ><?php if(isset($address4Msg_php)){echo $address4Msg_php;} ?></span>
									<div>
									-->
									<br>

									<div>
										<input class="reg_input3" type="checkbox" id="tc" name="tc" value="agree" >
										<label class="reg_label3">By creating an account you agree to our <a href="../registration/registerTerms&Conditions.php" >Terms & Conditions</a>.<label class="mandatory_field">*</label></label>
										<span class="reg_err" id="tcMsg" ><?php if(isset($tcMsg_php)){echo $tcMsg_php;} ?></span>
									<div>

									<hr>

									<p></p>

									<div>
									  <div class="button_alignment">
									  	<input class="reg_input4" type="reset" name="Reset" value="Reset" onclick="resetErrMsg();">
									  	<input class="reg_input5" type="submit" name="signUp" value="Sign Up">
<!--									  </div>-->
<!--									  <br><br><label class="reg_label4"><u><b>Password format advices:</b></u></label>-->
<!--									  <br><label class="reg_label4">Password length must be 8 - 20 characters.</label>-->
<!--									  <br><label class="reg_label4">Password must contain at least 2 upper case characters.</label>-->
<!--									  <br><label class="reg_label4">Password must contain at least 2 lower case characters.</label>-->
<!--									  <br><label class="reg_label4">Password must contain at least 2 numeric characters.</label>-->
<!--									  <br><label class="reg_label4">Password must contain at least 2 special characters.</label>-->
<!--									</div>-->
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