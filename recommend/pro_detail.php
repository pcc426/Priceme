<?php
include_once("../common/functions.php");
include_once("../conn.php");

/*healthCheckDB();
healthCheckDBTables();
check_session_timeout();
*/

$pro_id = $_GET["pro_id"];

$sql="select * from product where productID='$pro_id'";
$result=mysqli_query($conn,$sql);
$data=mysqli_fetch_array($result);

$sql1="select * from promotion where productID='$pro_id'";
$result1=mysqli_query($conn,$sql1);
$data1=mysqli_fetch_array($result1);

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

                <form action="../placeOrder/cart.php" method="post">
					<fieldset>
                        <table width="90%">
                            <tr>
                                <td rowspan="6">
                                    <img width="500" height="300" src="<?php echo $data['productImage']?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo $data['productName']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Price:$<?php echo $data['currentPrice']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Valid time:<?php echo $data1['effectTime']?>-<?php echo $data1['expireTime']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Sold:<?php echo $data['soldAmount']?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type= "hidden" name = "pro_id" value= "<?php echo $pro_id ?>" />
                                    <button type="submit" value="Buy" style="width:70px;height:40px;color: #fff;background-color: #ca1515;border: 1px;border-radius: 10px;">Buy</button>
                                </td>
                            </tr>
                        </table>
                    </fieldset><br>
                </form>

					<fieldset><legend><h4>Coupon details</h4></legend>
                        <table style="margin: 10px;">
                            <tr>
                                <td>
                                    <?php echo $data['productDescription']?>
                                </td>
                            </tr>
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