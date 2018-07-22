<?php

include_once("../common/functions.php");



if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

logout();

$_logoutMsg = "";

if(isset($_GET["logoutMsg"])){
    $_logoutMsg = htmlspecialchars($_GET["logoutMsg"]);
}

?>

<html>
	<head>
		<meta charset="utf-8">		
		<title>Priceme</title>
		
		<?php include_once("../import.php");?>

		<link rel="stylesheet" href="../unicorn.css" type="text/css">
		<link rel="stylesheet" href="./login.css" type="text/css">
		<script type="text/javascript" src="./login.js"></script>
	</head>

	<body>	
		<form name="loginForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return formSubmit()">
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

								<!-- ******** [START] Logout Division ******** -->
								<?php if(isset($_logoutMsg) && $_logoutMsg!= ""){?>
								<label><span style="color:red"><?php echo $_logoutMsg;?></span></label>
								<?php }else {?>
								<br><br>
								<label><h1>Logout successfully!</h1></label>
								<p style="margin-bottom: 10em;>
								<?php }?>									
								<!-- ******** [END] Logout Division ******** -->

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