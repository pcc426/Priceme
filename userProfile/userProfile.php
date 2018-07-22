<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once("../common/functions.php");

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

$userName		= "";
$tel 			= "";

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
$userID = $_SESSION['userID'];

$con=mysqli_connect("localhost","root","","DPS");
$sql_profile= "select customerName,customerEmail,customerTel from customer_info where userID='$userID' ";
$result_profile = mysqli_query($con,$sql_profile);

$row = mysqli_fetch_array($result_profile);
	$customerName	= $row['customerName'];
	$customerEmail	= $row['customerEmail'];
	$customerTel 	= $row['customerTel'];

$con=mysqli_connect("localhost","root","","DPS");
$sql_order= "SELECT orderID,productID,promotionID,paymentChannel,orderTime,orderPrice,commentContent FROM `order` WHERE userID=11 ";
$result_order = mysqli_query($con,$sql_order);
$order_amount = mysqli_num_rows($result_order);


?>

<html>
	<head>
		<meta charset="utf-8">
		
		<title>Priceme</title>
		
		<?php include_once("../import.php");?>
		
		<link rel="stylesheet" href="../unicorn.css" type="text/css">
		<link rel="stylesheet" href="./userProfile.css" type="text/css">
		<script type="text/javascript" src="../unicorn.js"></script>
		<script type="text/javascript" src="./userProfile.js"></script>    			
	</head>

	<body>	
		<form name="userProfileForm">
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

								<!-- ******** [START] User Profile Division ******** -->
								<h3>Profile</h3>
								<hr>
									<div class="profile_info">
										<div class="user_profile_label"><label>User ID : </label></div>
										<div class="user_profile_label2"><label><?php if(isset($userID)){echo $userID;} ?></label></div><br>
										
										<div class="user_profile_label"><label>Email : </label></div>
										<div class="user_profile_label2"><label><?php if(isset($customerEmail)){echo $customerEmail;} ?></label></div><br>
										
										<div class="user_profile_label"><label>Name : </label></div>
										<div class="user_profile_label2"><label><?php if(isset($customerName)){echo $customerName;} ?></label></div><br>
										<div class="user_profile_label"><label>Contact Phone No. : </label></div>
										<div class="user_profile_label2"><label><?php if(isset($customerTel)){echo $customerTel;} ?></label></div><br>
                                        <hr>
                                        <table style='text-align:left;' border='1'>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Product Name</th>
                                                <th>Promotion ID</th>
                                                <th>Payment Channel</th>
                                                <th>Order Time</th>
                                                <th>Price</th>
                                                <th>Comment</th>
                                                <th></th>
                                            </tr>
                                        <?php
                                        for($i=0;$i<$order_amount;$i++){
                                            $sql = mysqli_fetch_assoc($result_order);
                                            $orderID=$sql['orderID'];
                                            $productID = $sql['productID'];

                                            $productName= getProductName($productID);
                                            $promotionID = $sql['promotionID'];
                                            $paymentChannel = $sql['paymentChannel'];
                                            $orderTime = $sql['orderTime'];
                                            $orderPrice = $sql['orderPrice'];
                                            $commentContent = $sql['commentContent'];
                                            echo "<tr>
                                                    <td>$orderID</td>
                                                    <td>$productName</td>
                                                    <td>$promotionID</td>
                                                    <td>$paymentChannel</td>
                                                    <td>$orderTime</td>
                                                    <td>$orderPrice</td>
                                                    <td>$commentContent</td>
                                                    <td><a href=\"comment.php\">Add Comment</a></td>
                                                  </tr>";
                                        }
                                        ?>
                                        </table>
									</div>

									
									<div class="stop_floating_alignment"></div>
									<hr>
									<div class="button_alignment">
										<input class="profile_button" type="button" value="OK" onclick=location.href='homepage.php'>
									</div>
								<!-- ******** [END] User Profile Division ******** -->

							</div>
						</div>
						
					</div>
					<!-- ******** [END] Right panel ******** -->
					
					
				</div>
			</div>
		</form>
	</body>
</html>