<?php

include_once("../common/database.php");
include_once("../common/functions.php");
// custom functions
include_once("./comment_function.php");


// prevent hacking
//echo htmlspecialchars($_SERVER["PHP_SELF"]);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// check the data
  $userID = test_data($_POST["userID"]);
  $orderID = test_data($_POST["orderID"]);
  $rating = test_data($_POST["rating"]);
  $comment = test_data($_POST["comment"]);
  $vendor = test_data($_POST["vendor-rate"]);

  
  // insert the data to db
  addComment($userID, $orderID, $rating, $comment, $vendor);
  
  // java script answer
  echo "
	<script type=\"text/javascript\">
		window.alert('Thank you for your opinion !');
	</script>
";
}


header("refresh:0; url=comment_init.php"); // javascript pop-up works fine
exit();

?>