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
		<form name="regForm" method="post" action="vendor_info.php" >
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
									<h3>Please input your information
                                    </h3>
									<hr>
									<label class="mandatory_field">* Mandatory field</label><br>
                                    <div>
                                        <label class="reg_label">User ID<label class="mandatory_field"></label> : </label>
                                        <input class="reg_input" type="text" id="userID" name="userID" maxlength="50" readonly="readonly" value="<?php echo $_GET['userID']?>" >
                                        </div>

									<div>
										<label class="reg_label">Vendor Name<label class="mandatory_field">*</label> : </label>
										<input class="reg_input" type="text" id="vendorName" name="vendorName" maxlength="50" value="<?php if(isset($vendorName)){echo $vendorName;} ?>" >
									</div>

                                    <div>
                                        <label class="reg_label">Vendor Type<label class="mandatory_field">*</label> : </label>
                                    <?php
                                    $con=mysqli_connect("127.0.0.1","root","","DPS");
                                    ?>
                                    <select id="vendorTypeID" name="vendorTypeID" style="width:100mm">
                                        <option value=0>--Please Select--</option>
                                        <?php
                                        $sql= "select vendorTypeID,typeName from vendor_type ";
                                        $result = mysqli_query($con,$sql);
                                        while($row = mysqli_fetch_array($result))
                                        {
                                            echo "<option value='$row[vendorTypeID]'>$row[typeName]</option>";//循环，拼凑下拉框选项
                                        }
                                        ?>
                                    </select>
                                    </div>

									<div>
										<label class="reg_label">Address<label class="mandatory_field">*</label> : </label>
										<input class="reg_input" type="text" id="vendorAddress" name="vendorAddress" maxlength="100" value="<?php if(isset($vendorAddress)){echo $vendorAddress;} ?>" >
									</div>

                                    <div>
                                        <label class="reg_label">Tel.<label class="mandatory_field">*</label> : </label>
                                        <input class="reg_input" type="text" id="vendorTel" name="vendorTel" maxlength="100" value="<?php if(isset($vendorTel)){echo $vendorTel;} ?>" >
                                    </div>

                                    <div>
                                        <label class="reg_label">Description<label class="mandatory_field">*</label> : </label>
                                        <textarea cols="45" rows="5" id="vendorDescription" name="vendorDescription">
                                        </textarea>
<!--                                        <textarea class="reg_input"  id="vendorDescription" name="vendorDescription" maxlength="100" value="--><?php //if(isset($vendorDescription)){echo $vendorvendorDescription;} ?><!--" >-->
                                    </div>

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
