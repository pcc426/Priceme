<?php
include_once("../common/functions.php");

//checkLogon();
//check_session_timeout();

//if (session_status() == PHP_SESSION_NONE) {
//	session_start();
//}

//if(isset($_SESSION['userID'])){
//	$userID_In_Session = $_SESSION['userID'];
//}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//Retrieve user contact information (address and contact no.)
if(isset($_SESSION['userName'])){
    $userID = $_SESSION['userName'];
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


if (!empty($_POST["ConfirmBtn"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    //[START] Create Order and Order_detail in database


//    if(isset($userID)){
//        $_result = array();
//        $_result = get_user_address_contactNo_by_userId($userID);
//
//        if(isset($_result)){
//            $_address = $_result[0];
//            $_tel = $_result[1];
//        }else{
//            return null;
//        }
//    }

    @$now = date("Y-m-d h:i:sa");
    @$expiryDate = date("Y-m-d h:i:sa", strtotime($now.' + 1 day')); //expiry date = current date + 2 days




    	/*
    	 OrderDetail($orderID, $foodID, $qty, $paymentAmt, $discountAmt, $createDate, $updateDate)
    	 */




    if(isset($_POST['hidden_paymentMethod'])){
        $_paymentMethod = $_POST['hidden_paymentMethod'];
    }

    if(isset($_POST['hidden_cardType'])){
        $_cardType = $_POST['hidden_cardType'];
    }

    if(isset($_POST['hidden_creditCardNo'])){
        $_creditCardNo = str_replace('-', '', trim($_POST['hidden_creditCardNo']));
    }

    if(isset($_POST['hidden_creditCardCVV'])){
        $_creditCardCVV = trim($_POST['hidden_creditCardCVV']);
    }

    if(isset($_POST['hidden_creditCardHolderName'])){
        $_creditCardHolderName = trim($_POST['hidden_creditCardHolderName']);
    }

    if(isset($_POST['hidden_creditCardExpiryDate'])){
        $_creditCardExpiryDate = preg_replace('/[\/]/', '', trim($_POST['hidden_creditCardExpiryDate']));
    }

    if(isset($_POST['hidden_chequeNo'])){
        $_chequeNo= $_POST['hidden_chequeNo'];
    }

    /*
     	Order($orderID, $userID, $status, $deliveryTimeslot, $orderEffectDate, $orderExpiryDate, $totalPaymentAmt, $totalDiscountAmt,
        $paymentDate, $paumentChannel, $creditCardType, $creditCardNo, $creditCardSecurityCode, $creditCardHolderName,
        $creditCardExpiryDate, $chequeNo, $remark, $createDate, $updateDate)
     */

    $_orderStatus = "OS21";

    /*
    if($_paymentMethod == "CA"){
    	$_orderStatus = "OS11";
    }
    */


    $_selectedProduct = $_SESSION['selected_product'];

    $orderDetail4Display = prepare_order_detail_for_display($_selectedProduct);

    $productID = $orderDetail4Display->getProductID();

    $product = select_product($productID);

    $promotion = select_promotion($productID);

    if(isset($promotion)){

        $now = date("Y-m-d h:i:sa");

        $inventoryRate = ($promotion->getEffectAmount()-$promotion->getSoldAmount()-1)/($promotion->getEffectAmount());

        $effectTimeLeft = (strtotime($promotion->getExpireTime())-strtotime($now))/(strtotime($promotion->getExpireTime())-strtotime($promotion->getEffectAmount()));

        if ($effectTimeLeft>1){

            $effectTimeLeft = -1;

        }

        $promotionID = $promotion->getPromotionID();

        $soldAmount = $promotion->getSoldAmount() + 1;

        updatePromotion($promotionID,$soldAmount);

    }else{

        $promotionID = -1;
        $inventoryRate = -1;
        $effectTimeLeft = -1;

    }


    $order = new Order("","","",
                "","","",
                "","","",
                "","","",
                "","","","","","");

    $order->setProductID($product->getProductID());
    $order->setPromotionID($promotionID);
    $order->setUserID($_SESSION['userID']);
    $order->setPaymentChannel($_paymentMethod);
    $order->setCreditCardType($_cardType);
    $order->setCreditCardNo($_creditCardNo);
    $order->setCreditCardSecurityCode($_creditCardCVV);
    $order->setCreditCardHolderName($_creditCardHolderName);
    $order->setCreditCardExpiryDate($_creditCardExpiryDate);
    $order->setCheckNo($_chequeNo);
    $order->setOrderPrice($product->getCurrentPrice());
    $order->setInventoryRate($inventoryRate);
    $order->setEffectTimeLeft($effectTimeLeft);

    $_orderID = place_order($order);

    updateProduct($product);

    //go to success page
    header('Location: ./cartCompleted.php?placedOrderID='.$_orderID);
    exit;

    //[END] Create Order and Order_detail in database
}else if (!empty($_POST["CancelBtn"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    unset($_SESSION['payment_method']);
    unset($_SESSION['card_type']);
    unset($_SESSION['credit_card_no']);
    unset($_SESSION['credit_card_cvv']);
    unset($_SESSION['credit_card_holder_name']);
    unset($_SESSION['credit_card_expiry_date']);
    unset($_SESSION['cheque_no']);

    //go back to cart.php
    header('Location: ../recommend/homepage.php');
    exit;
}
else{
	//[START] Get data from session
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

	//Retrieve user contact information (address and contact no.)
	if(isset($_SESSION['userID'])){
		$userID = $_SESSION['userID'];
	}

	$_paymentMethod         = isset($_SESSION['payment_method'])            ? $_SESSION['payment_method']           : "";
	$_cardType              = isset($_SESSION['card_type'])                 ? $_SESSION['card_type']                : "";
	$_creditCardNo          = isset($_SESSION['credit_card_no'])            ? $_SESSION['credit_card_no']           : "";
	$_creditCardCVV         = isset($_SESSION['credit_card_cvv'])           ? $_SESSION['credit_card_cvv']          : "";
	$_creditCardHolderName  = isset($_SESSION['credit_card_holder_name'])   ? $_SESSION['credit_card_holder_name']  : "";
	$_creditCardExpiryDate  = isset($_SESSION['credit_card_expiry_date'])   ? $_SESSION['credit_card_expiry_date']  : "";
	$_chequeNo              = isset($_SESSION['cheque_no'])                 ? $_SESSION['cheque_no']                : "";
	$_creditCardNoTmp = "";

	for($i=0; $i<strlen($_creditCardNo); $i+=4){
	    if($i != 12){
	        $_creditCardNoTmp = $_creditCardNoTmp.substr($_creditCardNo, $i, 4)."-";
	    }else {
	        $_creditCardNoTmp = $_creditCardNoTmp.substr($_creditCardNo, $i, 4);
	    }
	}
	$_creditCardNo = $_creditCardNoTmp;

	//clear session data to prevent user click on the back button in browser and duplicate to place order
	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}
	//unset($_SESSION['selected_food_map']);
	unset($_SESSION['delivery_timeslot']);
	unset($_SESSION['payment_method']);
	unset($_SESSION['card_type']);
	unset($_SESSION['credit_card_no']);
	unset($_SESSION['credit_card_cvv']);
	unset($_SESSION['credit_card_holder_name']);
	unset($_SESSION['credit_card_expiry_date']);
	unset($_SESSION['cheque_no']);
	//[END] Get data from session
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
		<form name="cartForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return confirmFormSubmit()">
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
                                <?php } else {
                                    if (isset($userID)) { ?>
                                        <span class='badge badge-pill badge-success'>Welcome <?php if (isset($userID)) {
                                                echo $userID;
                                            } ?></span> We promise to provide the best price for you!
                                    <?php } else { ?>
                                        <span class="cart_info" id="cartInfoMsg">We promise to provide the best price for you! </span>
                                    <?php }
                                }
                                ?>
								</div>
								<!-- ******** [END] Alert Message Display ******** -->
                                    <?php
                                    $_selectedProduct = $_SESSION['selected_product'];
                                    $orderDetail4Display = prepare_order_detail_for_display($_selectedProduct);
                                    //print_r($orderDetail4Display);
                                    //$_productID = $orderDetail4Display->getProductID();
                                    //echo($_productID);
                                    $_productID = $orderDetail4Display->getProductID();
                                    $_productName = $orderDetail4Display->getProductName();
                                    $_image = $orderDetail4Display->getImage();
                                    $_description = $orderDetail4Display->getDescription();
                                    $_price = $orderDetail4Display->getPrice();
                                    ?>


								<!-- ******** [START] Shopping Cart Division ******** -->
								<!-- ******** Confirm Order Details ******** -->
								<h5>&nbsp;&nbsp;Order Details</h5>
                                <div class="orderTable">
                                    <div class="orderTableHeading">
                                        <div class="orderTableHead" style="width : 300px" ><strong>Product Name</strong></div>
                                        <div class="orderTableHead" style="width : 250px"><strong>Image</strong></div>
                                        <div class="orderTableHead" >Description</div>
                                        <div class="orderTableCellAmt">Price</div>

                                    </div>
                    				<?php


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
									  <input class="placeOrder_button" type="submit" id="CancelBtn" name="CancelBtn" value="Cancel">
									  <input class="placeOrder_button" type="submit" id="ConfirmBtn" name="ConfirmBtn" value="Confirm Payment">
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
			<input type="hidden" name="hidden_paymentMethod" 			value="<?php if(isset($_paymentMethod))            {echo $_paymentMethod;} ?>">
			<input type="hidden" name="hidden_cardType" 				value="<?php if(isset($_cardType))                 {echo $_cardType;} ?>">
			<input type="hidden" name="hidden_creditCardNo" 			value="<?php if(isset($_creditCardNo))             {echo $_creditCardNo;} ?>">
			<input type="hidden" name="hidden_creditCardCVV" 			value="<?php if(isset($_creditCardCVV))            {echo $_creditCardCVV;} ?>">
			<input type="hidden" name="hidden_creditCardHolderName" 	value="<?php if(isset($_creditCardHolderName))     {echo $_creditCardHolderName;} ?>">
			<input type="hidden" name="hidden_creditCardExpiryDate" 	value="<?php if(isset($_creditCardExpiryDate))     {echo $_creditCardExpiryDate;} ?>">
			<input type="hidden" name="hidden_chequeNo" 				value="<?php if(isset($_chequeNo))                 {echo $_chequeNo;} ?>">

		</form>
	</body>
</html>