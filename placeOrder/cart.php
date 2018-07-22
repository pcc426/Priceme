<?php
include_once("../common/functions.php");

healthCheckDB();
//checkLogon();
check_session_timeout();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
}

$isFormDataValid = true;

$cartInfoMsg_php = "";
$cartMsg_php = "";
$creditCardNoMsg_php = "";
$chequeNoMsg_php = "";
$creditCardCVVMsg_php = "";
$creditCardHolderNameMsg_php = "";
$creditCardExpiryDateMsg_php = "";
$_description = "";
$_image = "";
$_productName = "";
$_price = "";


$_address = "";
$_tel = "";
$_deliveryTimeslot = "DT01";
$_paymentMethod = "CR";

$_selectedProduct = "";


$_cardType = "VS";
$_creditCardNo = "";
$_creditCardCVV = "";
$_creditCardHolderName = "";
$_creditCardExpiryDate = "";
$_chequeNo = "";

$_visaCardDisabled = "disabled";
$_masterCardDisabled = "disabled";
$_creditCardNoDisabled = "disabled";
$_creditCardCVVDisabled = "disabled";
$_creditCardHolderNameDisabled = "disabled";
$_creditCardExpiryDateDisabled = "disabled";
$_chequeNoDisabled = "disabled";


if(isset($_GET["pro_id"])){
    $_selectedProduct = $_GET["pro_id"];
}else if(isset($_POST["pro_id"])) {
    $_selectedProduct = $_POST["pro_id"];
}else {
    $_selectedProduct = "";
}

$_SESSION['selected_product'] = $_selectedProduct;

if (!empty($_POST["SubmitBtn"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['userID'])) {
        $cartMsg_php = "[E218] Please login first!";
        $isFormDataValid = false;
    }

// ******** [START] Quantity validation ********
//	if(isset($_POST['selectedFood'])){
//		$_selectedFood = $_POST['selectedFood'];
//		foreach( $_selectedFood as $v ) {
//			if(isset($_POST["qtyID".$v])){
//				$qtyTmp = $_POST["qtyID".$v];
//				if($qtyTmp > 5){
//					$cartMsg_php= "[E201] Quantity of a food must be less than or equal to 5!";
//					$isFormDataValid = false;
//				}
//			}
//		}
//	}
// ******** [END] Quantity validation ********

// ******** [START] Total price validation ********
//    if (isset($_POST['totalPayAmt'])) {
//        $_totalPayAmt = $_POST['totalPayAmt'];
//        if ($_totalPayAmt < 1) {
//            $cartMsg_php = "[E202] Total payment amount must be greater than 0!";
//            $isFormDataValid = false;
//        }
//    }
// ******** [END] Total price validation ********


// ******** [START] Payment validation ********
    if (isset($_POST['paymentMethod'])) {
        $_paymentMethod = $_POST['paymentMethod'];
        if ($_paymentMethod == "CR") { //paid by credit card
            if (isset($_POST['cardType'])) {
                $_cardType = $_POST['cardType'];
            } else {
                $_cardType = "";
            }

            if (!isset($_POST['creditCardNo']) || $_POST['creditCardNo'] == "") {
                $creditCardNoMsg_php = "[E203] Credit card no. must be input!";
                $isFormDataValid = false;
            } else {
                $_creditCardNo = str_replace('-', '', trim($_POST['creditCardNo']));
                if (!is_numeric($_creditCardNo)) {
                    $creditCardNoMsg_php = "[E204] Credit card no. must be numeric!";
                    $isFormDataValid = false;
                } else if (strlen($_creditCardNo) != 16) {
                    $creditCardNoMsg_php = "[E205] Credit card no. length must be 16 digits!";
                    $isFormDataValid = false;
                }
            }

            if (!isset($_POST['creditCardCVV']) || $_POST['creditCardCVV'] == "") {
                $creditCardCVVMsg_php = "[E206] Credit card CVV no. must be input!";
                $isFormDataValid = false;
            } else {
                $_creditCardCVV = trim($_POST['creditCardCVV']);
                if (!is_numeric($_creditCardCVV)) {
                    $creditCardCVVMsg_php = "[E207] Credit card CVV no. must be numeric!";
                    $isFormDataValid = false;
                } else if (strlen($_creditCardCVV) != 3) {
                    $creditCardCVVMsg_php = "[E208] Credit card CVV no. length must be 3 digits!";
                    $isFormDataValid = false;
                }
            }

            if (!isset($_POST['creditCardHolderName']) || $_POST['creditCardHolderName'] == "") {
                $creditCardHolderNameMsg_php = "[E209] Credit card holder name must be input!";
                $isFormDataValid = false;
            } else {
                $_creditCardHolderName = trim($_POST['creditCardHolderName']);

                $ccNameExp = "#[A-Za-z]#";
                if (!preg_match($ccNameExp, $_creditCardHolderName)) {
                    $creditCardHolderNameMsg_php = "[E217] Credit card holder name must be composed of English alphabets!";
                    $isFormDataValid = false;
                }
            }

            if (!isset($_POST['creditCardExpiryDate']) || $_POST['creditCardExpiryDate'] == "") {
                $creditCardExpiryDateMsg_php = "[E210] Credit card expiry date must be input!";
                $isFormDataValid = false;
            } else {
                $_creditCardExpiryDate = preg_replace('/[\/]/', '', trim($_POST['creditCardExpiryDate']));
                if (!is_numeric($_creditCardExpiryDate)) {
                    $creditCardExpiryDateMsg_php = "[E211] Credit card expiry date must be numeric!";
                    $isFormDataValid = false;
                } else if (strlen($_creditCardExpiryDate) != 4) {
                    $creditCardExpiryDateMsg_php = "[E212] Credit card expiry date must be 4 digits!";
                    $isFormDataValid = false;
                } else {
                    $_mm = substr($_creditCardExpiryDate, 0, 2);
                    $_yy = substr($_creditCardExpiryDate, 2, 2);
                    $_yyyy = date('Y');
                    $_currentYear = substr($_yyyy, 2, 2);

                    if ($_mm <= 0 || $_mm > 12 || $_yy < $_currentYear) {
                        $creditCardExpiryDateMsg_php = "[E213] Credit card expiry date is invalid!";
                        $isFormDataValid = false;
                    }
                }
            }
        } else if ($_paymentMethod == "CH") { //paid by cheque
            $_cardType = "";

            if (!isset($_POST['chequeNo'])) {
                $chequeNoMsg_php = "[E214] Cheque no. must be input!";
                $isFormDataValid = false;
            } else {
                $_chequeNo = $_POST['chequeNo'];
                if (!is_numeric($_chequeNo)) {
                    $chequeNoMsg_php = "[E215] Cheque no. must be numeric!";
                    $isFormDataValid = false;
                } else if (strlen($_chequeNo) < 10) {
                    $chequeNoMsg_php = "[E216] Cheque no. length must be 10 digits!";
                    $isFormDataValid = false;
                }
            }
        } else {
            $_cardType = "";
        }
    }
// ******** [END] Payment validation ********

    if ($isFormDataValid) {
        //[START] Put form data into session for passing to cartConfirmation.php
        if (isset($_POST['selectedProduct'])) {

            $_selectedProduct = $_POST['selectedProduct'];


        }

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['selected_product']         = $_selectedProduct;

//	    $_SESSION['selected_food_map']         = $_selectedFoodMap;
//	    if(isset($_POST['deliveryTimeslot'])){
//	    	$_deliveryTimeslot= $_POST['deliveryTimeslot'];
//	    }
//	    $_SESSION['delivery_timeslot']         = $_deliveryTimeslot;

        $_SESSION['payment_method'] = $_paymentMethod;
        $_SESSION['card_type'] = $_cardType;
        $_SESSION['credit_card_no'] = $_creditCardNo;
        $_SESSION['credit_card_cvv'] = $_creditCardCVV;
        $_SESSION['credit_card_holder_name'] = $_creditCardHolderName;
        $_SESSION['credit_card_expiry_date'] = $_creditCardExpiryDate;
        $_SESSION['cheque_no'] = $_chequeNo;
        //[END] Put form data into session for passing to cartConfirmation.php

        //go to success page
        header('Location: ./cartConfirm.php');
        exit;

    }
} else {

    unset($_SESSION['payment_method']);
    unset($_SESSION['card_type']);
    unset($_SESSION['credit_card_no']);
    unset($_SESSION['credit_card_cvv']);
    unset($_SESSION['credit_card_holder_name']);
    unset($_SESSION['credit_card_expiry_date']);
    unset($_SESSION['cheque_no']);

//  $_selectedFoodMap = isset($_SESSION['selected_food_map']) ? $_SESSION['selected_food_map'] : array();

    $_selectProduct = isset($_SESSION['selected_product']) ? $_SESSION['selected_product'] : "";

    //$orderDetail4Display = new OrderDetail4Display("2", "2", "2", "2", "2");


    $orderDetail4Display = prepare_order_detail_for_display($_selectedProduct);
    $_SESSION['orderDetail4Display'] = serialize($orderDetail4Display);
    //Retrieve user contact information (address and contact no.)
    if (isset($_SESSION['login_user_id'])) {
        $userID = $_SESSION['login_user_id'];
    }
//
//    getuser
//    if(isset($userID)){
//    	$_result = array();
//    	$_result = get_user_address_contactNo_by_userId($userID);
//
//    	if(isset($_result)){
//    		$_address = $_result[0];
//    		$_tel = $_result[1];
//    	}else{
//    		return null;
//    	}
//    }

    /*
    //[START] Get data from session. When user click cancel button in cartConfirm.php, the following data will be kept in session
    $_deliveryTimeslot      = isset($_SESSION['delivery_timeslot'])         ? $_SESSION['delivery_timeslot']        : "";
    $_paymentMethod         = isset($_SESSION['payment_method'])            ? $_SESSION['payment_method']           : "CR";
    $_cardType              = isset($_SESSION['card_type'])                 ? $_SESSION['card_type']                : "VS";
    $_creditCardNo          = isset($_SESSION['credit_card_no'])            ? $_SESSION['credit_card_no']           : "";
    $_creditCardCVV         = isset($_SESSION['credit_card_cvv'])           ? $_SESSION['credit_card_cvv']          : "";
    $_creditCardHolderName  = isset($_SESSION['credit_card_holder_name'])   ? $_SESSION['credit_card_holder_name']  : "";
    $_creditCardExpiryDate  = isset($_SESSION['credit_card_expiry_date'])   ? $_SESSION['credit_card_expiry_date']  : "";
    $_creditCardNoTmp = "";

    for($i=0; $i<strlen($_creditCardNo); $i+=4){
        if($i != 12){
            $_creditCardNoTmp = $_creditCardNoTmp.substr($_creditCardNo, $i, 4)."-";
        }else {
            $_creditCardNoTmp = $_creditCardNoTmp.substr($_creditCardNo, $i, 4);
        }
    }
    $_creditCardNo = $_creditCardNoTmp;
    $_chequeNo = isset($_SESSION['cheque_no']) ? $_SESSION['cheque_no'] : "";

    unset($_SESSION['selected_food_map']);
    unset($_SESSION['delivery_timeslot']);
    unset($_SESSION['payment_method']);
    unset($_SESSION['card_type']);
    unset($_SESSION['credit_card_no']);
    unset($_SESSION['credit_card_cvv']);
    unset($_SESSION['credit_card_holder_name']);
    unset($_SESSION['credit_card_expiry_date']);
    unset($_SESSION['cheque_no']);
    //[END] Get data from session. When user click cancel button in cartConfirm.php, the following data will be kept in session
    */

    if ($_paymentMethod == "CR") {
        $_visaCardDisabled = "";
        $_masterCardDisabled = "";
        $_creditCardNoDisabled = "";
        $_creditCardCVVDisabled = "";
        $_creditCardHolderNameDisabled = "";
        $_creditCardExpiryDateDisabled = "";

        $_chequeNoDisabled = "disabled";
    } else if ($_paymentMethod == "CH") {
        $_visaCardDisabled = "disabled";
        $_masterCardDisabled = "disabled";
        $_creditCardNoDisabled = "disabled";
        $_creditCardCVVDisabled = "disabled";
        $_creditCardHolderNameDisabled = "disabled";
        $_creditCardExpiryDateDisabled = "disabled";

        $_chequeNoDisabled = "";
    } else {
        $_visaCardDisabled = "disabled";
        $_masterCardDisabled = "disabled";
        $_creditCardNoDisabled = "disabled";
        $_creditCardCVVDisabled = "disabled";
        $_creditCardHolderNameDisabled = "disabled";
        $_creditCardExpiryDateDisabled = "disabled";

        $_chequeNoDisabled = "disabled";
    }
}

?>

<html>
<head>
    <meta charset="utf-8">

    <title>Unicorn Restaurant - Shopping Cart</title>

    <?php include_once("../import.php"); ?>

    <link rel="stylesheet" href="../unicorn.css" type="text/css">
    <link rel="stylesheet" href="./placeOrder.css" type="text/css">
    <script type="text/javascript" src="../unicorn.js"></script>
    <script type="text/javascript" src="./placeOrder.js"></script>
</head>

<body>
<form name="cartForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
      onsubmit="return formSubmit()">
    <div id="loading"></div>
    <div id="app" style="display:none;">
        <div>

            <?php include_once("../leftPanel.php"); ?>


            <!-- ******** [START] Right panel ******** -->
            <div id="right-panel" class="right-panel">

                <?php include_once("../header.php"); ?>


                <!-- ******** [START] Navigation Body ******** -->
                <div>
                    <div>

                        <!-- ******** [START] Alert Message Display ******** -->
                        <div class="alert mt-4 alert-success">
                            <?php if (isset($cartInfoMsg_php) && !empty($cartInfoMsg_php)) { ?>
                                <span class="cart_info" id="cartInfoMsg"><?php if (isset($cartInfoMsg_php)) {
                                        echo $cartInfoMsg_php;
                                    } ?></span>
                            <?php } else if (isset($cartMsg_php) && !empty($cartMsg_php)) { ?>
                                <span class="cart_err" id="cartMsg"><?php if (isset($cartMsg_php)) {
                                        echo $cartMsg_php;
                                    } ?></span>
                            <?php } else {
                                if (isset($userID)) { ?>
                                    <span class='badge badge-pill badge-success'>Welcome <?php if (isset($userID)) {
                                            echo $userID;
                                        } ?></span> We promise to deliver the freshest foods to you as soon as possible.
                                <?php } else { ?>
                                    <span class="cart_info" id="cartInfoMsg">We promise to deliver the freshest foods to you as soon as possible.</span>
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
                                <div class="orderTableHead"><strong>Product Name</strong></div>
                                <div class="orderTableHead"><strong>Image</strong></div>
                                <div class="orderTableHead">Description</div>
                                <div class="orderTableCellAmt">Price</div>

                            </div>
                            <?php

                            $_productID = $orderDetail4Display->getProductID();
                            $_productName = $orderDetail4Display->getProductName();
                            $_image = $orderDetail4Display->getImage();
                            $_price = $orderDetail4Display->getPrice();
                            $_description = $orderDetail4Display->getDescription();


                            echo "<div class='orderTableRow'>";
                            echo "<div class='orderTableCell'>" . $_productName . "</div>";
                            if(!isset($_image)){
                            	echo "<div class='orderTableCell'></div>";
                            }else{
                            	echo "<div class='orderTableCell'><img src='$_image' width='150px' height='100px'></div>";
                            }
                            echo "<div class='orderTableCell'>" . $_description . "</div>";
                            echo "<div class='orderTableCellAmt'>$" . $_price . "</div>";
                            echo "<input type='hidden' name='selectedProduct' value='" . $_productID . "'>";



                            ?>
                        </div>

                        <!-- ******** Confirm Delivery Address, Contact Phone No. and Delivery Timeslot ******** -->
                        <div class="info">

                            <!-- ******** Confirm Payment Method and Payment Information ******** -->
                            <div>

                                <label class="cart_label">Payment Method : </label>
                                <div>
                                    <input class="cart_radio" type="radio" id="paymentMethod1" name="paymentMethod"
                                           value="CR"
                                           onclick="clickCreditCard()" <?php if (isset($_paymentMethod) && $_paymentMethod == "CR") echo "checked"; ?>>Credit
                                    Card <br>
                                    <input class="cart_input_card_type" type="radio" id="cardType1" name="cardType"
                                           value="VS"
                                           onclick="clickVisaCard()" <?php if (isset($_cardType) && $_cardType == "VS") echo "checked"; ?> <?php if (isset($_visaCardDisabled)) echo $_visaCardDisabled; ?>>Visa
                                    Card
                                    <input class="cart_input_card_type" type="radio" id="cardType2" name="cardType"
                                           value="MA"
                                           onclick="clickMasterCard()" <?php if (isset($_cardType) && $_cardType == "MA") echo "checked"; ?> <?php if (isset($_masterCardDisabled)) echo $_masterCardDisabled; ?>>Master
                                    Card <br>
                                    <input class="cart_input" type="text" id="creditCardNo" name="creditCardNo"
                                           placeholder="Credit Card No." maxlength="19"
                                           value="<?php if (isset($_creditCardNo)) {
                                               echo $_creditCardNo;
                                           } ?>" <?php if (isset($_creditCardNoDisabled)) echo $_creditCardNoDisabled; ?>
                                           onblur="creditCardFormatting()"> <span class="cart_err"
                                                                                  id="creditCardNoMsg"><?php if (isset($creditCardNoMsg_php)) {
                                            echo $creditCardNoMsg_php;
                                        } ?></span><br>
                                    <input class="cart_input2" type="text" id="creditCardCVV" name="creditCardCVV"
                                           placeholder="Credit Card CVV" maxlength="3"
                                           value="<?php if (isset($_creditCardCVV)) {
                                               echo $_creditCardCVV;
                                           } ?>" <?php if (isset($_creditCardCVVDisabled)) echo $_creditCardCVVDisabled; ?>>
                                    <span class="cart_err"
                                          id="creditCardCVVMsg"><?php if (isset($creditCardCVVMsg_php)) {
                                            echo $creditCardCVVMsg_php;
                                        } ?></span><br>
                                    <input class="cart_input" type="text" id="creditCardHolderName"
                                           name="creditCardHolderName" placeholder="Credit Card Holder Name"
                                           maxlength="50" value="<?php if (isset($_creditCardHolderName)) {
                                        echo $_creditCardHolderName;
                                    } ?>" <?php if (isset($_creditCardHolderNameDisabled)) echo $_creditCardHolderNameDisabled; ?>>
                                    <span class="cart_err"
                                          id="creditCardHolderNameMsg"><?php if (isset($creditCardHolderNameMsg_php)) {
                                            echo $creditCardHolderNameMsg_php;
                                        } ?></span><br>
                                    <input class="cart_input" type="text" id="creditCardExpiryDate"
                                           name="creditCardExpiryDate" placeholder="Credit Card Expiry Date (MM/YY)"
                                           maxlength="5" value="<?php if (isset($_creditCardExpiryDate)) {
                                        echo $_creditCardExpiryDate;
                                    } ?>" <?php if (isset($_creditCardExpiryDateDisabled)) echo $_creditCardExpiryDateDisabled; ?>
                                           onblur="creditCardExpiryDateFormatting()"> <span class="cart_err"
                                                                                            id="creditCardExpiryDateMsg"><?php if (isset($creditCardExpiryDateMsg_php)) {
                                            echo $creditCardExpiryDateMsg_php;
                                        } ?></span><br>
                                    <input class="cart_radio" type="radio" id="paymentMethod2" name="paymentMethod"
                                           value="CA"
                                           onclick="clickCash()" <?php if (isset($_paymentMethod) && $_paymentMethod == "CA") echo "checked"; ?>>Cash
                                    <br>
                                    <input class="cart_radio" type="radio" id="paymentMethod3" name="paymentMethod"
                                           value="CH"
                                           onclick="clickCheque()" <?php if (isset($_paymentMethod) && $_paymentMethod == "CH") echo "checked"; ?>>Cheque
                                    <input class="cart_input3" type="text" id="chequeNo" name="chequeNo"
                                           placeholder="Cheque No." maxlength="10" value="<?php if (isset($_chequeNo)) {
                                        echo $_chequeNo;
                                    } ?>" <?php if (isset($_chequeNoDisabled)) echo $_chequeNoDisabled; ?>> <span
                                            class="cart_err" id="chequeNoMsg"><?php if (isset($chequeNoMsg_php)) {
                                            echo $chequeNoMsg_php;
                                        } ?></span><br>
                                </div>
                            </div>
                        </div>

                        <div>
                            <input class="placeOrder_button" type="submit" id="SubmitBtn" name="SubmitBtn"
                                   value="Submit">
                        </div>
                    </div>
                    <!-- ******** [END] Shopping Cart Division ******** -->

                    <?php include_once("../footer.php"); ?>


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