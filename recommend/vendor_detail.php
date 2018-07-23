<?php

include_once("../common/functions.php");
include_once("../conn.php");

/*healthCheckDB();
healthCheckDBTables();
check_session_timeout();
*/

$sql2="select * from vendor_info where userID='$user_id'";
$result2=mysqli_query($conn,$sql2);
$data2=mysqli_fetch_array($result2);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['userName'])){
    $userID = $_SESSION['userName'];
}
?>

<html>

<head>
    <meta charset="utf-8">

    <title>Unicorn Restaurant - Home</title>

    <?php include_once("../import.php");?>

    <link rel="stylesheet" href="../unicorn.css" type="text/css">
    <link rel="stylesheet" href="homepage.css" type="text/css">
</head>

<body style="line-height:1;">
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
                    <div class="alert mt-4 alert-success">
                        <?php
                        if(isset($_successMsg) && !empty($_successMsg)){
                            echo "$_successMsg";
                        }else{
                            if(isset($userID)){
                                echo "<span class='badge badge-pill badge-success'>Welcome ".$userID."</span> We promise to provide the best price for you！";
                            }else{
                                echo "We promise to provide the best price for you！";
                            }
                        }
                        ?>
                    </div>
                    <!-- ******** [END] Alert Message Display ******** -->



                    <!-- ******** [START] Food Navigation Division ******** -->
                    <div></div>
                    <fieldset><legend><h4>Vendor Information</h4></legend>
                        <table class="vendorInfo">
                            <tr>
                                <td>
                                <?php echo $data2['vendorName']?>
                                </td>
                                <td rowspan="4" align="right">
                                    <img class="vendorIcon" src="<?php echo $data2['vendorImage']?>">
                                </td>
                            </tr>
                            <!--<tr>
                                <td>
                                    <?php echo $data2['review']?> reviews |
                                    Per capita: $ <?php echo $data2['perCap']?> |
                                    Rating <img width="120" height="20" src="<?php echo $data2['rating']?>"/>
                                </td>
                            </tr>-->
                            <tr>
                                <td>
                                Address:&nbsp;<?php echo $data2['vendorAddress']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                Tel:&nbsp;<?php echo $data2['vendorTel']?>
                                </td>
                            </tr>
                        </table>
                    </fieldset><br>

                    <fieldset><legend><h4>Coupon List</h4></legend>
                        <table>
						<tr>
						<?php
						$i=0;
						$sql1="select * from product where userID='$user_id'";
						$result1=mysqli_query($conn,$sql1);
						while($data1=mysqli_fetch_array($result1)){
							if($i%4==0 &&$i!=0) echo "</tr><tr><td colspan=5 height=10></td></tr><tr>";
									$i++;
						?>
								<td>
        							<table class="item">
            							<TBODY>
              								<TR>
                								<TD colspan="2">
 													<a href="pro_detail.php?pro_id=<?php echo $data1['productID']?>">
 														<img class="pic" src="<?php echo $data1['productImage']?>"/>
 													</a>
                  								</TD>
                                                <TD>
                                                </TD>
                							</TR>
                							<TR>
                								<TD class="item1" colspan="2">
              										<a href="pro_detail.php?pro_id=<?php echo $data1['productID']?>">
              											<?php echo $data1['productName']?>
              										</a>
            									</TD>
                                                <TD>
                                                </TD>
											</TR>
											<TR>
												<TD class="item1">
              											$<?php echo $data1['currentPrice']?>
            									</TD>
                                                <TD align="right">
                                                    <a href="../placeOrder/cart.php?pro_id=<?php echo $data1['productID']?>">
                                                        <img src="../resources/cart.PNG">
                                                    </a>
                                                </TD>
                							</TR>
              							</TBODY>
      								</table>
      							</td>
						<?php
						}
						?>
						</tr>
					</table>
                    </fieldset><br>

					<fieldset><legend><h4>Comment</h4></legend>

                            <?php
                            /*$sql3="select * from order LEFT JOIN product ON customer_info.'customerName' = order.'customerName' where userID='$user_id'";
                            $result3=mysqli_query($conn,$sql3);
                            $data3=mysqli_fetch_array($result3);*/

                            /*$sql4="select * from comment where userID='$user_id'";
                            $result4=mysqli_query($conn,$sql4);*/

                            $sql4="select * from `order`,product where `order`.productID=product.productID AND product.userID=$user_id";
                            $result4=mysqli_query($conn,$sql4);

                            $sql5="select * from customer_info LEFT JOIN `order` ON customer_info.`userID` = `order`.`userID`";
                            $result5=mysqli_query($conn,$sql5);

                            while($data4=mysqli_fetch_array($result4)){
                            ?>
                            <table cellpadding="5px" width="100%" style="margin: 15px;">
                                <tr>
                                    <td width="100px">
                                        <img class="userIcon" src="<?php $data5=mysqli_fetch_array($result5);echo $data5['customerIcon']?>">
                                    </td>
                                    <td width="100px">
                                        <?php echo $data5['customerName']?>
                                    </td>
                                    <td>
                                        <?php echo $data4['rating']?>
                                    </td>
                                    <td align="right">
                                        <?php echo $data4['orderTime']?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <?php echo $data4['commentContent']?>
                                    </td>
                                </tr>
                            </table><hr>
                            <?php
                            }
                            ?>
                        </table>
                    </fieldset><br>
                    <!-- ******** [END] Food Navigation Division ******** -->

                    <?php include_once("../footer.php");?>



                </div>
            </div>
            <!-- ******** [END] Navigation Body ******** -->



        </div>
        <!-- ******** [END] Right panel ******** -->


    </div>
</div>

</body>
</html>