<?php

include_once("../common/database.php");
include_once("../common/functions.php");
// custom functions
include_once("./comment_function.php");

healthCheckDB();

check_session_timeout();

// DEBUGGING
$debuggingFlag = false; // enabled debug output


// PARAMETERS
/* this decides how many entries from database will be fetched*/
$num_of_comment_sections = 5;
/* decides how many food entries will be shown in the list*/
$num_of_food_entries = 5;
/* decides how many rating stars are displayed*/
$num_of_ratings = 5;


// VARIABLES
// logic variables
$userLogged = false;
$userNoComment = false;
// arrays for current comment
$nowUserID = "";

$nowArrayFood = array();
$nowDate = "";
// arrays for previous comments
$prevArrayUserID   = array();
$prevArrayOrderID  = array();
$prevArrayRatings  = array();
$prevArrayContent  = array();
$prevArrayDates    = array();
$prevArrayFood     = array();

// auxiliary - temporary holding values between function calls
$foodIDList        = array();

// Extra messages
$commentMsg_php = "";
$commentInfoMsg_php = "";

// LOGIC
// 1) check whether the user is logged in
$userLogged=checkUserLogon();


	if($debuggingFlag){
		echo "1) check user logged-in : ";
		if($userLogged){
			echo "TRUE<br>";
		}else{
			echo "FALSE<br>";
		}
	}

// 2) check whether the user already commented on payed order
if( $userLogged ){
	// fetch user id
	$nowUserID = isset($_SESSION['userID']) ? $_SESSION['userID'] : "";
    $userID = $_SESSION['userName'];
	$orderID = $_GET['order_id'];

    $OrderIDfetch = db_select_order_by_OrderID($orderID);

    $order = new Order($OrderIDfetch["orderID"],$OrderIDfetch["productID"],$OrderIDfetch["promotionID"],$OrderIDfetch["userID"],$OrderIDfetch["paymentChannel"],$OrderIDfetch["creditCardType"],$OrderIDfetch["creditCardNo"],$OrderIDfetch["creditCardSecurityCode"],$OrderIDfetch["creditCardHolderName"],$OrderIDfetch["creditCardExpiryDate"],$OrderIDfetch["checkNo"],$OrderIDfetch["orderTime"],$OrderIDfetch["orderPrice"],$OrderIDfetch["productScore"],$OrderIDfetch["commentContent"],$OrderIDfetch["vendorScore"],$OrderIDfetch["inventoryRate"],$OrderIDfetch["effectTimeLeft"]);

	if( $order->getProductScore()==""){
      // OrderID in not yet in comment table = enable comment
		$userNoComment = true;

//        $order = new Order("","","","","","","","","","","","","","","","","","");
//        // get last Order ID from Comment and Order db table





        $product = select_product($order->getProductID());

        $productName = $product->getProductName();

	}else{
      // OrderID is already in comment table = disable comment
      $userNoComment = false;
   }

}

// 3) fetch previous comment form database
//$num_of_comment_sections = fetchComments($prevArrayUserID, $prevArrayOrderID, $prevArrayRatings, $prevArrayContent, $prevArrayDates, $num_of_comment_sections);
//// 4) get the food names
//for ($x = 0; $x < $num_of_comment_sections; $x++) {
//   // fetch foodID List/Array for specific order ID
//   $foodIDList=getFoodIDWithOrderID($prevArrayOrderID[$x], $num_of_food_entries);
//   // parse foodID names
//   for ($y = 0; $y < $num_of_food_entries; $y++) {
//      if( ($foodIDList[$y] != -1) || ($foodIDList[$y] != NULL) ){
//         $prevArrayFood[$x][$y] = getFoodNameWithFoodID($foodIDList[$y]);
//      }else{
//         $prevArrayFood[$x][$y] = '';
//      }
//   }
//}

// TESTING
//$userLogged=true;
//$userNoComment=true;

// 5) determine state of the website
// 5.a) user is logged in and can comment


?>

<html>

	<head>
		<meta charset="utf-8">
		
		<title>Unicorn Restaurant - Comment</title>
		
		<?php include_once("../import.php");?>
		
		<link rel="stylesheet" href="../unicorn.css" type="text/css">
		<link rel="stylesheet" href="./comment.css" type="text/css">
		
		<script type="text/javascript" src="../unicorn.js"></script>
		<script type="text/javascript" src="../jq_plugins.js"></script>
		<script type="text/javascript" src="./comment.js"></script>			
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
							<?php if(!$userLogged){ ?>
								<div class="alert mt-4 alert-success">
									<span class="badge badge-pill badge-success">Welcome!!</span> Please, log in and place an order to be able to post comment.
								</div>
							<?php }else if(!$userNoComment){ ?>
								<div class="alert mt-4 alert-success">
									<span class="badge badge-pill badge-success">Welcome <?php echo $userID ?> </span> Please, place & pay for an order to comment on it.
								</div>
							<?php }else{ ?>
								<div class="alert mt-4 alert-success">
									<span class="badge badge-pill badge-success">Welcome <?php echo $userID ?> </span> Let us know what you think about your last order.
								</div>
							<?php } ?>

							<!-- ******** [END] Alert Message Display ******** -->


                            <!-- ******** [START] Food Comment Section ******** -->
							<div class="comment-section">
								<!-- ******** User Logged In & New Order ******** -->

								<?php if($userLogged && $userNoComment){
									echo '<form action="send_comment.php" method="POST" name="comment">                                                                          ';
									echo '	<!--hide values passed by form-->                                                                                                   ';
									echo '	<!--userID-->                                                                                                                       ';
									echo '	<input type="hidden" name="userID" value="'.$nowUserID.'" />                                                                        ';
									echo '	<!--orderID-->                                                                                                                      ';
									echo '	<input type="hidden" name="orderID" value="'.$order->getOrderID().'" />                                                                    ';
									echo '	<!--createDate-->                                                                                                                   ';
									echo '	<input type="hidden" name="createDate" value="'.$nowDate.'" />                                                                      ';
									echo '	<!--comment section-->                                                                                                              ';
                           echo '<div class="comment-container">                                                                                                        ';
                           echo '      <div class="comment-init">                                                                                                       ';
                           // previous order/comment
                           echo '         <div class="comment-order">                                                                                                   ';
                           echo '            <p id="text-order">Your order ID:</p>                                                                                      ';
                           echo '         </div>                                                                                                                        ';
                           // user name
                           echo '         <div class="comment-name">                                                                                                    ';
                           echo '            <p id="text-name">'.$order->getOrderID().'</p>                                                                                       ';
                           echo '         </div>                                                                                                                        ';
                           // rating stars                                                                                                                              ';
                                    echo '<div class="comment-wtf">';
									echo '         <div class="comment-star">                                                                                                    ';
									echo '   	      Product Score:<div class="star-rating">                                                                                                  ';
									echo '   		      <input id="star-5" type="radio" name="rating" value="5" checked="checked">                                              ';
									echo '   		      <label for="star-5" title="5 stars">                                                                                    ';
									echo '   				      <i class="active fa fa-star" aria-hidden="true"></i>                                                              ';
									echo '   	      	</label>                                                                                                                ';
									echo '   	      	<input id="star-4" type="radio" name="rating" value="4">                                                                ';
									echo '   	      	<label for="star-4" title="4 stars">                                                                                    ';
									echo '   	      			<i class="active fa fa-star" aria-hidden="true"></i>                                                              ';
									echo '   	      	</label>                                                                                                                ';
									echo '   	      	<input id="star-3" type="radio" name="rating" value="3">                                                                ';
									echo '   	      	<label for="star-3" title="3 stars">                                                                                    ';
									echo '							<i class="active fa fa-star" aria-hidden="true"></i>                                                              ';
									echo '					</label>                                                                                                                ';
									echo '					<input id="star-2" type="radio" name="rating" value="2">                                                                ';
									echo '					<label for="star-2" title="2 stars">                                                                                    ';
									echo '							<i class="active fa fa-star" aria-hidden="true"></i>                                                              ';
									echo '					</label>                                                                                                                ';
									echo '					<input id="star-1" type="radio" name="rating" value="1">                                                                ';
									echo '					<label for="star-1" title="1 star">                                                                                     ';
									echo '							<i class="active fa fa-star" aria-hidden="true"></i>                                                              ';
									echo '					</label>                                                                                                                ';
									echo '				</div>                                                                                                                     ';
                                    echo '				</div>                                                                                                                     ';

                                    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="vendor-rating">Vendor Score: ';

                                    echo ' <input type="radio"  name="vendor-rate" checked = "checked" value = "5">&nbsp;PERFECT '     ;

                                    echo '  <input type="radio"  name="vendor-rate"  value = "3">&nbsp;OK '     ;

                                    echo ' <input type="radio"  name="vendor-rate"  value = "1">&nbsp;AWFUL '     ;


                                    echo '</div>';

                                    echo '</div>';


                                    echo '</div>';


                           echo '      <div class="comment-body">                                                                                                       ';
                           // print food order/list
                           echo '         <div class="comment-order-list">                                                                                              ';
                           echo '            <ul>                                                                                                                       ';

                              echo '               <li id="order-item-0">'.$productName.'</li>                                                                     ';

                           echo '            </ul>				                                                                                                            ';
                           echo '         </div>                                                                                                                        ';
                           // comment
									echo '         <div class="comment-input">                                                                                                   ';
									echo '         	<textarea name="comment" placeholder="Your opinion ... " maxlength="1000"></textarea>                                      ';
									echo '         </div>                                                                                                                        ';
                           echo '      </div>                                                                                                                           ';
                           echo '      <div class="comment-footer">                                                                                                     ';
                           echo '      <div >                                                                                                             ';
									echo '         <input class="comment_button" type="submit" value="Post Comment">                                                                                    ';
									echo '      </div>                                                                                                                           ';
                           // date of comment
                           echo '         <div class="time">                                                                                                            ';
                           echo '            <p id="text-time">'.$nowDate.'</p>                                                                                         ';
                           echo '         </div>                                                                                                                        ';
                           echo '      </div>                                                                                                                           ';
                           echo '   </div>                                                                                                                              ';
                           echo '</form>                                                                                                                                ';
                        }
                        ?>
		<!-- ******** Previous comments from the database ******** -->
<!--                     --><?php //
//                        for ($c = 0; $c < $num_of_comment_sections; $c++) {
//                           echo '<div class="comment-container">                                                                                                        ';
//                           echo '      <div class="comment-init">                                                                                                       ';
//                           // previous order/comment
//                           echo '         <div class="comment-order">                                                                                                   ';
//                           echo '            <p id="text-order">Previous order</p>                                                                                      ';
//                           echo '         </div>                                                                                                                        ';
//                           // user name
//                           echo '         <div class="comment-name">                                                                                                    ';
//                           echo '            <p id="text-name">'.$prevArrayUserID[$c].'</p>                                                                             ';
//                           echo '         </div>                                                                                                                        ';
//                           // rating stars                                                                                                                              ';
//                           echo '         <div class="comment-star">                                                                                                    ';
//                           echo '            <div class="star-static">                                                                                                  ';
//                           // print 5 stars
//                           for ($r = 0; $r < $num_of_ratings; $r++) {
//                              if($prevArrayRatings[$c] > $r ):
//                                 echo '               <i class="active fa fa-star" style="color:f2b600;" aria-hidden="true"></i>                                        ';
//                              else:
//                                 echo '               <i class="active fa fa-star" style="color:bbb;" id="checked" aria-hidden="true"></i>                              ';
//                              endif;
//                           }
//                           echo '            </div>                                                                                                                     ';
//                           echo '         </div>                                                                                                                        ';
//                           echo '      </div>                                                                                                                           ';
//                           echo '      <div class="comment-body">                                                                                                       ';
//                           echo '         <!-- order contant -->                                                                                                        ';
//                           echo '         <div class="comment-order-list">                                                                                              ';
//                           echo '            <ul>                                                                                                                       ';
//                           // print food order/list
//                           for ($f = 0; $f < $num_of_food_entries; $f++) {
//                              echo '               <li id="order-item-0">'.$prevArrayFood[$c][$f].'</li>                                                                ';
//                           }
//                           echo '            </ul>				                                                                                                            ';
//                           echo '         </div>                                                                                                                        ';
//                           echo '         <div class="comment-input">                                                                                                   ';
//                           // comment
//                           echo '            <p id="prev-comment-0">'.$prevArrayContent[$c].'</p>                                                                       ';
//                           echo '         </div>                                                                                                                        ';
//                           echo '      </div>                                                                                                                           ';
//                           echo '      <div class="comment-footer">                                                                                                     ';
//                           echo '         <div class="time">                                                                                                            ';
//                           // date of comment
//                           echo '            <p id="text-time">'.$prevArrayDates[$c].'</p>                                                                              ';
//                           echo '         </div>                                                                                                                        ';
//                           echo '      </div>                                                                                                                           ';
//                           echo '   </div>                                                                                                                              ';
//                        }
//                     ?>
                     <div>
                     <!-- ******** Footer ******** -->
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