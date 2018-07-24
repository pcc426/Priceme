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
		<form name="regForm" method="post" action="customer_info.php" >
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
									<h3>Please input your information</h3>
									<hr>
									<label class="mandatory_field">* Mandatory field</label><br>
                                    <div>
                                        <label class="reg_label">Customer ID<label class="mandatory_field"></label> : </label>
                                        <input class="reg_input" type="text" id="userID" name="userID" maxlength="50" readonly="readonly" value="<?php echo $_GET['userID']?>" >
                                        <div>

									<div>
										<label class="reg_label">Customer Name<label class="mandatory_field">*</label> : </label>
										<input class="reg_input" type="text" id="customerName" name="customerName" maxlength="50" value="<?php if(isset($customerName)){echo $customerName;} ?>" >
									<div>

									<div>
										<label class="reg_label">Email<label class="mandatory_field">*</label> : </label>
										<input class="reg_input" type="email" id="email" name="email" maxlength="100" value="<?php if(isset($email)){echo $email;} ?>" >
										<span class="reg_info" id="emailInfoMsg" ><?php if(isset($emailInfoMsg_php)){echo $emailInfoMsg_php;} ?></span>
										<span class="reg_err" id="emailMsg" ><?php if(isset($emailMsg_php)){echo $emailMsg_php;} ?></span>
									<div>


									<div>
										<label class="reg_label">Contact Phone No.<label class="mandatory_field">*</label> : </label>
										<input class="reg_input" type="text" id="tel" name="tel" maxlength="8" value="<?php if(isset($tel)){echo $tel;} ?>" >
										<span class="reg_err" id="telMsg" ><?php if(isset($telMsg_php)){echo $telMsg_php;} ?></span>
									<div>
									<br>

									<hr>

									<p></p>

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
