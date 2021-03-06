<?php
include_once("database.php");

//[START] Registration function

function getProductName($productID){
    $con=mysqli_connect("127.0.0.1","root","","dps");
    $sql= "select productName from product where productID='$productID' ";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);
    return $row['productName'];
}

function db_select_user_by_UserName($userName)
{
    try {
        $dbconnection = db_connect();

        //Prepared SQL statement
        $sql = "select userName from `user` where userName=:userName";
        $stmt = $dbconnection->prepare($sql);
        $paramArray = array(':userName' => $userName);
        $stmt->execute($paramArray);
        $fetch = $stmt->fetch();

        echo $fetch['userName'];
    }catch(PDOException $e){
        go_to_exception_page("db_select_user_by_UserName() -> ".$e);
    }

    //close db connection to release memory
    $dbconnection = null;
}

function sendEmail($Receiver, $Subject, $Content)
{
    $Sender = "From: cs5281unicorn_admin@unicorn.com";

    try {
        mail($Receiver, $Subject, $Content, $Sender);
        //echo "Send email success!!";
    } catch (Exception $e) {
        //echo "<br>" . $e->getMessage();
        go_to_exception_page("sendEmail() -> " . $e->getMessage());
    }
}

function optimizateInput($data)
{
    if (isset($data)) {
        $data = trim($data);
        //$data = stripslashes($data);
        //$data = htmlspecialchars($data);
    }
    return $data;
}

//This function will be called by Registration function email validation link
function login_after_activation($email, $regToken)
{
    $_updated_row_count = db_update_user_lastLoginTime($email, $regToken);

    if (isset($_updated_row_count)) {
        return true;    //login success
    } else {
        return false;    //login failure
    }
}

//[END] Registration function

//[START] Login and Logout function
function login_by_userId_or_email_password($userIdOrEmail, $password)
{
    $_user_in_db = array();
    $_user_in_db = db_select_user_by_UserID_or_Email_Password($userIdOrEmail, $password);
    $userID = $_user_in_db[0];
    $email = $_user_in_db[1];
    $privilege = $_user_in_db[2];

    if (isset($_user_in_db)) {
        //User ID and email is case sensitive
        if ($userIdOrEmail != $userID && $userIdOrEmail != $email) {
            return "false";    //login failure
        }

        $_updated_row_count = db_update_user_lastLoginTime_by_Email($email);

        if (isset($_updated_row_count) && $_updated_row_count > 0) {
            prepare_login_session($userID, $email, $privilege);
            return "true";    //login success
        } else {
            return "false";    //login failure
        }
    } else {
        return "false";
    }
}

function login_by_userId_or_email_passwordFake($userIdOrEmail, $password)
{
    $_user_in_db = array();
    $_user_in_db = db_select_user_by_UserID_or_Email_PasswordFake($userIdOrEmail, $password);
    $userID = $_user_in_db[0];
    $email = $_user_in_db[1];
    $privilege = $_user_in_db[2];

    if (isset($_user_in_db)) {
        //User ID and email is case sensitive
        if ($userIdOrEmail != $userID && $userIdOrEmail != $email) {
            return "false";    //login failure
        }

        $_updated_row_count = db_update_user_lastLoginTime_by_Email($email);

        if (isset($_updated_row_count) && $_updated_row_count > 0) {
            prepare_login_session($userID, $email, $privilege);
            return "true";    //login success
        } else {
            return "false";    //login failure
        }
    } else {
        return "false";
    }
}

function prepare_login_session($userID, $email, $privilege)
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Store Session Data
    $_SESSION['login_user_id'] = $userID;
    $_SESSION['login_user_email'] = $email;
    $_SESSION['login_user_privilege'] = $privilege;
    $_SESSION['login_date_time'] = time(); //Current date time in second format
    $_SESSION['last_request_time'] = time();
}

function check_session_timeout()
{
    if (checkUserLogon()) {
        $timeout = 3000;  //30 mins
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['last_request_time']) && (time() - $_SESSION['last_request_time'] > $timeout)) {
            // When last request time was more than 30 minutes ago, clear all session variables and destroy all sessions.
            session_unset();
            session_destroy();

            //go back to cart.php
            $logoutMsg = "Session is timeout and logout automatically.";
            header('Location: ../login/logout.php?logoutMsg=' . $logoutMsg);
            exit;
        } else {
            $_SESSION['last_request_time'] = time(); // update last activity time stamp
        }
    }
}

function refresh_session()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['last_request_time'])) {
        $_SESSION['last_request_time'] = time(); // refresh session with current time
    }
}

function logout()
{
    unset($_SESSION);
    session_unset(); // clear all session variables
    session_destroy();
}

function checkLogon()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['login_user_id'])) {
        $_msg = "Please login first!";
        go_to_exception_page($_msg);
        die();
    }
}

function checkAdmin()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['login_user_privilege']) || $_SESSION['login_user_privilege'] != "A") {
        $_msg = "Page access denied!";
        go_to_exception_page($_msg);
        die();
    }
}

function checkUserLogon(){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		//Double check if user logon
		if(isset($_SESSION['userName'])){
			return true;
		}

		return false;
	}

//[END] Login and Logout function

//[START] User Profile function
function select_user_all_info_by_UserID($userID)
{
    $user = db_select_user_all_info_by_UserID($userID);
    return $user;
}

//[END] User Profile function

//[START] Place order function
function prepare_order_detail_for_display($_selectProduct)
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    //$selectedFoodMap = $_SESSION['selected_food_map'];
    $selectedProduct = $_selectProduct;


    if (!isset($selectedProduct)) {
        return ""; //Customer has no selected food
    }

    $orderDetail4Display = db_prepare_order_detail($selectedProduct);

    return $orderDetail4Display;

}

function select_product($_selectProduct)
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $selectedProduct = $_selectProduct;


    if (!isset($selectedProduct)) {
        return "";
    }

    $product = db_select_product($selectedProduct);

    return $product;

}

function select_promotion($_selectProduct)
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $selectedProduct = $_selectProduct;


    if (!isset($selectedProduct)) {
        return "";
    }

    $promotion = db_select_promotion($selectedProduct);

    return $promotion;

}



function place_order($order)
{


    $_orderID = db_insert_order($order);
    return $_orderID;
}

function updatePromotion($promotionID,$soldAmount)
{
    db_update_promotion($promotionID, $soldAmount);
}

function updateProduct($product)
{
    $productID = $product->getProductID();
    $soldAmount = $product->getSoldAmount();

    db_update_promotion($productID, $soldAmount);
}

function get_order_info_by_orderID($placedOrderID)
{
    $_orderColumnArray = db_select_order_by_OrderID($placedOrderID);

    $_orderInDB = new Order($_orderColumnArray["orderID"],$_orderColumnArray["productID"],$_orderColumnArray["promotionID"],
        $_orderColumnArray["userID"],$_orderColumnArray["paymentChannel"],$_orderColumnArray["creditCardType"],
        $_orderColumnArray["creditCardNo"],$_orderColumnArray["creditCardSecurityCode"],
        $_orderColumnArray["creditCardHolderName"],$_orderColumnArray["creditCardExpiryDate"],
        $_orderColumnArray["checkNo"],$_orderColumnArray["orderTime"],$_orderColumnArray["orderPrice"],
        "","","",$_orderColumnArray["inventoryRate"],$_orderColumnArray["effectTimeLeft"]);

    return $_orderInDB;
}

function get_order_detail_by_OrderID($placedOrderID)
{
    $_orderDetailArrayInDB = [];
    $_orderDetailArray = db_select_order_detail_by_OrderID($placedOrderID);

    foreach ($_orderDetailArray as $_orderDetailTmp) {
        $_orderDetailInDB = new OrderDetail(
            $_orderDetailTmp["order_id"], $_orderDetailTmp["food_id"], $_orderDetailTmp["qty"], $_orderDetailTmp["payment_amt"],
            $_orderDetailTmp["discount_amt"], $_orderDetailTmp["create_date"], $_orderDetailTmp["update_date"]);

        array_push($_orderDetailArrayInDB, $_orderDetailInDB);
    }

    return $_orderDetailArrayInDB;
}


function checkOutstandingOrderInSession()
{
    $count = countOutstandingOrderedFoodInSession();
    if ($count > 0) {
        return true;
    } else {
        return false;
    }
}

function countOutstandingOrderedFoodInSession()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $countAll = 0;
    if (isset($_SESSION['selected_food_map'])) {
        $_selectedFoodMap_in_session = $_SESSION['selected_food_map'];

        for ($row = 0; $row < count($_selectedFoodMap_in_session); $row++) {
            $qty = $_selectedFoodMap_in_session[$row]["qty"];
            $countAll = $countAll + $qty;
        }
    }
    return $countAll;
}

//[END] Place order function

//[START] Comment function
function get_order_list_by_userID($userID)
{
    return db_select_order_by_UserID($userID);
}

function save_comment($commentObj)
{
    return db_insert_comment($commentObj);
}

//[END] Comment function

//[START] Notification function
function get_notification_list_by_userID($userID)
{
    return db_select_notification_by_UserID($userID);
}

function update_notification($notificationObj)
{
    return db_update_notification($notificationObj);
}

function get_notification_count_by_userID($userID)
{
    return db_select_notification_count_by_UserID($userID);
}

//[END] Notification function

//[START] Admin function
function count_Food_By_Food_Cat_Name($foodCate, $foodName)
{

    return db_select_food_by_FoodCat_FoodName($foodCate, $foodName);
}

function add_food($foodObj)
{

    return db_insert_food($foodObj);
}

function add_food_tag($foodTag)
{
    return db_insert_food_tag($foodTag);
}

//[END] Admin function

/*
test_smtp();

function test_smtp()
{
    $to = "customer1@gmail.com";
    $subject = "Food order 1";
    $txt = "Total: $1,500";
    $headers = "From: cs5281unicorn_admin@unicorn.com";

    try{
        mail($to,$subject,$txt,$headers);
        echo "Success!";
    } catch(Exception $e){
        echo "Fail :(";
    }
}
*/

?>