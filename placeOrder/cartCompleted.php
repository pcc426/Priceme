<?php
include_once("../common/functions.php");

//healthCheckDB();

//checkLogon();
//check_session_timeout();

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if(isset($_SESSION['userID'])){
	$userID_In_Session = $_SESSION['userID'];
}

$isFormDataValid = true;

$cartInfoMsg_php = "";
$cartMsg_php = "";
$creditCardNoMsg_php = "";
$chequeNoMsg_php = "";
$creditCardCVVMsg_php = "";
$creditCardHolderNameMsg_php = "";
$creditCardExpiryDateMsg_php = "";

$_selectedFoodMap = [];
$_selectedOrderDetailMap = [];
$orderDetail4Display_array = [];
$_address = "";
$_tel = "";
$_deliveryTimeslot = "";
$_paymentMethod = "";
$_cardType = "";
$_creditCardNo = "";
$_creditCardCVV = "";
$_creditCardHolderName = "";
$_creditCardExpiryDate = "";
$_chequeNo = "";

$_visaCardDisabled = "disabled";
$_masterCardDisabled = "disabled";
$_creditCardNoDisabled = "disabled";
$_chequeNoDisabled = "disabled";
$_creditCardCVVDisabled = "disabled";
$_creditCardHolderNameDisabled = "disabled";
$_creditCardExpiryDateDisabled = "disabled";
$_placedOrderID = "";



if (!empty($_POST["okBtn"]) && $_SERVER["REQUEST_METHOD"] == "POST") {    
    header('Location: ../recommend/recom_home.php');
    exit;
}else if (!empty($_POST["printBtn"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST["placedOrderID"])){
		$_placedOrderIDTmp = htmlspecialchars($_POST["placedOrderID"]);
	}
	header('Location: ../index.php');
	exit;
}else{	
	if(isset($_GET["placedOrderID"])){
    	$_placedOrderID = htmlspecialchars($_GET["placedOrderID"]);
	}
	
    if($_placedOrderID == ""){
        //go back to cart.php
        header('Location: ./cart.php');
        exit;
    }else{
    	$cartInfoMsg_php = "Placed order successfully! The order number is " . $_placedOrderID . " !";
    }
    
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    //Retrieve user contact information (address and contact no.)

    $userID = $_SESSION['userID'];


    
    unset($_SESSION['selected_food_map']);
    unset($_SESSION['delivery_timeslot']);
    unset($_SESSION['payment_method']);
    unset($_SESSION['card_type']);
    unset($_SESSION['credit_card_no']);
    unset($_SESSION['credit_card_cvv']);
    unset($_SESSION['credit_card_holder_name']);
    unset($_SESSION['credit_card_expiry_date']);
    unset($_SESSION['cheque_no']);
    
    $_orderInDB = get_order_info_by_orderID($_placedOrderID);
    $orderDetail4Display_array = prepare_order_detail_for_display($_placedOrderID);

	$_orderTime                 = $_orderInDB -> getOrderTime();
	$_orderPrice                = $_orderInDB->getOrderPrice();
	$_productID                 = $_orderInDB->getProductID();
	$_paymentMethod            = $_orderInDB -> getPaymentChannel();
	$_cardType                 = $_orderInDB -> getCreditCardType();
	$_creditCardNo             = $_orderInDB -> getCreditCardNo();
	$_creditCardCVV            = $_orderInDB -> getCreditCardSecurityCode();
	$_creditCardHolderName     = $_orderInDB -> getCreditCardHolderName();
	$_creditCardExpiryDate     = $_orderInDB -> getCreditCardExpiryDate();
	$_chequeNo                 = $_orderInDB -> getCheckNo();
	
	if($_chequeNo == "0"){
		$_chequeNo = "";
	}
	if($_creditCardNo== "0"){
		$_creditCardNo= "";
	}
	if($_creditCardCVV== "0"){
		$_creditCardCVV= "";
	}
	if($_creditCardExpiryDate== "0"){
		$_creditCardExpiryDate= "";
	}
	$_creditCardNoTmp = "";
	
	for($i=0; $i<strlen($_creditCardNo); $i+=4){
	    if($i != 12){
	        $_creditCardNoTmp = $_creditCardNoTmp.substr($_creditCardNo, $i, 4)."-";
	    }else {
	        $_creditCardNoTmp = $_creditCardNoTmp.substr($_creditCardNo, $i, 4);
	    }
	}
	$_creditCardNo = $_creditCardNoTmp;	
}
?>

<html>
<head>
    <meta charset="ASCII">

    <title>Unicorn Restaurant - Shopping Cart</title>

    <?php include_once("../import.php");?>

    <link rel="stylesheet" href="../unicorn.css" type="text/css">
    <link rel="stylesheet" href="./placeOrder.css" type="text/css">
    <script type="text/javascript" src="../unicorn.js"></script>
    <script type="text/javascript" src="./placeOrder.js"></script>
</head>

<body>
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
                            <?php if(isset($cartInfoMsg_php) && !empty($cartInfoMsg_php)){ ?>
                                <span class="cart_info" id="cartInfoMsg" ><?php if(isset($cartInfoMsg_php)){echo $cartInfoMsg_php;} ?></span>
                            <?php }else if(isset($cartMsg_php) && !empty($cartMsg_php)){ ?>
                                <span class="cart_err" id="cartMsg" ><?php if(isset($cartMsg_php)){echo $cartMsg_php;} ?></span>";
                            <?php }else{
                                if(isset($userID)){ ?>
                                    <span class='badge badge-pill badge-success'>Welcome <?php if(isset($userID)){echo $userID;} ?></span>
                                <?php 		}else{ ?>
                                    <span class="cart_info" id="cartInfoMsg" ></span>
                                <?php }
                            }
                            ?>
                        </div>
                        <!-- ******** [END] Alert Message Display ******** -->



                        <!-- ******** [START] Shopping Cart Division ******** -->
                        <!-- ******** Confirm Order Details ******** -->
                        <h5>Order Details</h5>
                        <div class="orderTable">
                            <div class="orderTableHeading">
                                <div class="orderTableHead" style="width : 300px" ><strong>Product Name</strong></div>
                                <div class="orderTableHead" style="width : 250px"><strong>Image</strong></div>
                                <div class="orderTableHead" >Description</div>
                                <div class="orderTableCellAmt">Price</div>

                            </div>
                            <?php
                            $orderDetail4Display = unserialize($_SESSION['orderDetail4Display']) ;
                            //print_r($orderDetail4Display);
                            //$_productID = $orderDetail4Display->getProductID();
                            //echo($_productID);
                            $_productID = $orderDetail4Display->getProductID();
                            $_productName = $orderDetail4Display->getProductName();
                            $_image = $orderDetail4Display->getImage();
                            $_description = $orderDetail4Display->getDescription();
                            $_price = $orderDetail4Display->getPrice();

                            echo "<div class='orderTableRow'>";
                            echo "<div class='orderTableCell'>".$_productName."</div>";
                            if(!isset($_image)){
                                echo "<div class='orderTableCell'></div>";
                            }else{
                                echo "<div class='orderImg' ><img src='$_image' width='200px' height='128px'></div>";
                            }
                            echo "<div class='orderTableCell' style=\"padding: 5px 10px 20px;\">".$_description."</div>";
                            echo "<div class='orderTableCellAmt'>$" . $_price . "</div>";
                            echo "<input type='hidden' name='selectedProduct' value='" . $_productID . "'>";
                            echo "</div>";

                            ?>
                        </div>

                        <hr>
                        <!-- ******** Confirm Delivery Address, Contact Phone No. and Delivery Timeslot ******** -->
                        <div class="info">

                            <hr>
                            <!-- ******** Confirm Payment Method and Payment Information ******** -->
                            <div>
                                <label class="cart_label">Payment Method : </label>
                                <div>
                                    <input type="radio" id="paymentMethod1" name="paymentMethod" value="CR" onclick="clickCreditCard()" <?php if (isset($_paymentMethod) && $_paymentMethod=="CR") echo "checked";?> disabled>Credit Card <br>
                                    <input class="cart_input_card_type" type="radio" id="cardType1" name="cardType" value="VS" onclick="clickVisaCard()" <?php if (isset($_cardType) && $_cardType=="VS") echo "checked";?> disabled>Visa Card
                                    <input class="cart_input_card_type" type="radio" id="cardType2" name="cardType" value="MA" onclick="clickMasterCard()" <?php if (isset($_cardType) && $_cardType=="MA") echo "checked";?> disabled>Master Card <br>
                                    <input class="cart_input" type="text" id="creditCardNo" name="creditCardNo" placeholder="Credit Card No." maxlength="19" value="<?php if(isset($_creditCardNo)){echo $_creditCardNo;} ?>" disabled onblur="creditCardFormatting()"><span class="cart_err" id="creditCardNoMsg" ><?php if(isset($creditCardNoMsg_php)){echo $creditCardNoMsg_php;} ?></span><br>
                                    <input class="cart_input2" type="text" id="creditCardCVV" name="creditCardCVV" placeholder="Credit Card CVV" maxlength="3" value="<?php if(isset($_creditCardCVV)){echo $_creditCardCVV;} ?>" <?php if (isset($_creditCardCVVDisabled)) echo $_creditCardCVVDisabled;?>><span class="cart_err" id="creditCardCVVMsg" ><?php if(isset($creditCardCVVMsg_php)){echo $creditCardCVVMsg_php;} ?></span><br>
                                    <input class="cart_input" type="text" id="creditCardHolderName" name="creditCardHolderName" placeholder="Credit Card Holder Name" maxlength="50" value="<?php if(isset($_creditCardHolderName)){echo $_creditCardHolderName;} ?>" <?php if (isset($_creditCardHolderNameDisabled)) echo $_creditCardHolderNameDisabled;?>><span class="cart_err" id="creditCardHolderNameMsg" ><?php if(isset($creditCardHolderNameMsg_php)){echo $creditCardHolderNameMsg_php;} ?></span><br>
                                    <input class="cart_input" type="text" id="creditCardExpiryDate" name="creditCardExpiryDate" placeholder="Credit Card Expiry Date (MM/YY)" maxlength="5" value="<?php if(isset($_creditCardExpiryDate)){echo $_creditCardExpiryDate;} ?>" <?php if (isset($_creditCardExpiryDateDisabled)) echo $_creditCardExpiryDateDisabled;?>><span class="cart_err" id="creditCardExpiryDateMsg" ><?php if(isset($creditCardExpiryDateMsg_php)){echo $creditCardExpiryDateMsg_php;} ?></span><br>
                                    <input type="radio" id="paymentMethod2" name="paymentMethod" value="CA" onclick="clickCash()" <?php if (isset($_paymentMethod) && $_paymentMethod=="CA") echo "checked";?> disabled>Cash <br>
                                    <input type="radio" id="paymentMethod3" name="paymentMethod" value="CH" onclick="clickCheque()" <?php if (isset($_paymentMethod) && $_paymentMethod=="CH") echo "checked";?> disabled>Cheque <input class="cart_input3" type="text" id="chequeNo" name="chequeNo" placeholder="Cheque No." maxlength="10" value="<?php if(isset($_chequeNo)){echo $_chequeNo;} ?>" disabled><span class="cart_err" id="chequeNoMsg" ><?php if(isset($chequeNoMsg_php)){echo $chequeNoMsg_php;} ?></span><br>
                                </div>
                            </div>
                        </div>

                        <div>
                            <a href="../recommend/homepage.php" ><input class="placeOrder_button" type="submit"  name = "Back" value="Back"></a>

                        </div>
                    </div>
                    <!-- ******** [END] Shopping Cart Division ******** -->

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