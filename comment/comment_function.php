<?php
	include_once("../common/database.php");

	function initComment(){
		echo "I AM RUNNING <br>";
	}
	
	/** Strips the data from any malicious attempts
	 * @param any input
	 * @return clean data
	*/
	function test_data($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}	
	
	/** Return last OrderID from db Comment table
	 * @param UserID (currently logged user)
	 * @return OrderID from Comment for UserID
	*/


	function db_get_last_OrderID_from_Order($user_id)
	{
		
		try {
			// connect
			$dbconnection = db_connect();
			// query the last order_id for "user_id"
			$sql = "select * from `order` where `userId`='$user_id' LIMIT 1";

			$stmt = $dbconnection->query($sql);

			// result
			$OrderIDfetch = $stmt->fetch();
		
			// disconnect
			$dbconnection = null;

			@$order = new Order($OrderIDfetch["orderID"],$OrderIDfetch["productID"],$OrderIDfetch["promotionID"],$OrderIDfetch["userID"],$OrderIDfetch["paymentChannel"],$OrderIDfetch["creditCardType"],$OrderIDfetch["creditCardNo"],$OrderIDfetch["creditCardSecurityCode"],$OrderIDfetch["creditCardHolderName"],$OrderIDfetch["creditCardExpireDate"],$OrderIDfetch["checkNo"],$OrderIDfetch["orderTime"],$OrderIDfetch["orderPrice"],$OrderIDfetch["productScore"],$OrderIDfetch["commentContent"],$OrderIDfetch["vendorScore"],$OrderIDfetch["inventoryRate"],$OrderIDfetch["effectTimeLeft"]);


			// return value
			return $order;

	    }catch(PDOException $e){
			return -1;
	        go_to_exception_page("db_get_last_OrderID_from_Order() -> get data -> ".$e);
	    }
	}
	
	
	/** Returns last order ID for the user
	 !!! should I check here whether the user is logged in ? whether there is outstanding order ?
	 * @param ID of currently logged user
	 * @return oredrID of the last order
	*/
	function getOrderWithUserID($user_id)
	{
		try {
			// connect
			$dbconnection = db_connect();
			// query
			$sql = "select * from `order` where `userID`='$user_id'";
			$stmt = $dbconnection->query($sql);

			// result
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			// disconnect
			$dbconnection = null;

			return $result;


	    }catch(PDOException $e){
			return -1;
	        go_to_exception_page("getOrderIDWithUserID() -> set data -> ".$e);
	    }
	}
	
	
	/** Returns array of 5 latest items according to orderID
	 * @param ID of order get the list of $max_count foods from
    * @param maximum number of foods retrieved
	 * @return array of FoodIDs (up to 5) of items in current order
	*/
	function getFoodIDWithOrderID($order_id, $max_count)
	{
		try {
			// connect
			$dbconnection = db_connect();
			// query
			$sql = "select `food_id` from `order_detail` where `order_id`='$order_id' limit $max_count";
			$stmt = $dbconnection->query($sql);
			
			// return Array initialization
         for ($i = 0; $i < $max_count; $i++){
            $out[$i] = -1;
            
         }
			//$out['0'] = -1;
			//$out['1'] = -1;
			//$out['2'] = -1;
			//$out['3'] = -1;
			//$out['4'] = -1;
			// local variable
			$x = 0;
			
			// fill in return Array
			while ($row = $stmt->fetch())
			{
				$out[$x] = $row['food_id'];
				
				//echo "out = " . $out[$x] . "<br>";
				
				// prevent overflow
				if( $x == $max_count){
					break;
				}
            $x = $x + 1;
            
			}
			
			// disconnect
			$dbconnection = null;

			
			return $out;
			
	    }catch(PDOException $e){
	        go_to_exception_page("getFoodIDWithOrderID() -> set data -> ".$e);
	    }

		return -1;
	}
	
	/** Returns Food Name according to its foodID
	 * @param foodID of the item
	 * @return name of the food
	*/
	function getFoodNameWithFoodID($food_id)
	{
		try {
			// connect
			$dbconnection = db_connect();
			// query
			$sql = "select `food_name` from `food` where `food_id`='$food_id' limit 1";
			$stmt = $dbconnection->query($sql);
			
			// fetch value
			$food_name = $stmt->fetch();

			// disconnect
			$dbconnection = null;

			return $food_name['food_name'];
			
	    }catch(PDOException $e){
	        go_to_exception_page("getFoodNameWithFoodID() -> set data -> ".$e);
	    }

		return -1;
	}
	
	/** Store comment posted by user
	 * @param ID of user sending the comment
	 * @param order ID of the users current order
	 * @param rating (number of stars)
	 * @param content of the comment
	 * @return success/failure
	*/
	function addComment($userID, $orderID, $rating, $comment, $vendor){
		
		try {
			// connect
	        $dbconnection = db_connect();
			
			// conversion
			$int_rating = (int)$rating;
            $int_vendor = (int)$vendor;
			
	        //prepared SQL statement
			$sql = "update `order` set `productScore` = '$int_rating',`vendorScore` = '$int_vendor',`commentContent` = '$comment' where userID = '$userID' and orderID = '$orderID'";
	        $stmt = $dbconnection->prepare($sql);
			// execute 
			if ( $stmt->execute() === TRUE) {
				//echo "New record created successfully"  . "<br>";
			} else {
				echo "Error: " . $sql . "<br>";
			}
	    }catch(PDOException $e){
	        go_to_exception_page("addComment() -> set data -> ".$e);
	    }
		
		// disconnect
		$dbconnection = null;
	}
	
	
	function fetchComments(&$user_id, &$order_id, &$rating, &$content, &$create_date, $number_of_comments){
		
		try {
			// connect
	        $dbconnection = db_connect();

			// query
			$sql = "select `user_id`, `order_id`, `rating`, `content`, `create_date` from `comment` order by `create_date` DESC LIMIT $number_of_comments";
			$stmt = $dbconnection->query($sql);
			
			// number of fetched rows
			$num_of_rows = $stmt->rowCount();
			
			// get the values
			for($x = 0; $x <= ($num_of_rows - 1); $x++){
				$row = $stmt->fetch();
				$user_id[$x]     = $row['user_id'];
				$order_id[$x]    = $row['order_id'];
				$rating[$x]      = $row['rating'];
				$content[$x]     = $row['content'];
				$create_date[$x] = $row['create_date'];
				
				// checking
				//echo 'uesr_id : ' . $user_id[$x] . '<br>';
				//echo 'rating : '  . $rating[$x] . '<br>';
				//echo 'content : ' . $content[$x] . '<br>';
			}
			
			// clean the rest
			for($y = $num_of_rows; $y <= ($number_of_comments - 1); $y++){
				$row = $stmt->fetch();
				$user_id[$y]     = 'DB out of data';
				$order_id[$x]    = 'DB out of data';
				$rating[$y]      = 'DB out of data';
				$content[$y]     = 'DB out of data';
				$create_date[$y] = 'DB out of data';
				
				//echo 'Not enough data in database' . '<br>';
			}
			
			// fetch value
			$food_name = $stmt->fetch();
			

	    }catch(PDOException $e){
	        go_to_exception_page("fetchComments() -> set data -> ".$e);
	    }
		
		// disconnect
		$dbconnection = null;
      
      // number of comments fetched
      //echo 'number of rows ' .$num_of_rows. '<br>';
      return $num_of_rows;
		
	}
	


?>