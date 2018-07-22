<html>
<head>
    <meta charset="utf-8">

    <title>Unicorn Restaurant - Registration</title>

    <?php include_once("../import.php");?>

    <link rel="stylesheet" href="../unicorn.css" type="text/css">
    <link rel="stylesheet" href="./registration.css" type="text/css">
    <script type="text/javascript" src="../unicorn.js"></script>
    <script type="text/javascript" src="registration.js"></script>

</head>

<body>
<form name="regForm" method="post" action="register.php" onsubmit="return formSubmit()">
    <div id="loading"></div>
    <div id="app"  style="display:none;" >
        <div>

            <?php include_once("../leftPanel.php");?>

            <!-- ******** [START] Right panel ******** -->
            <div id="right-panel" class="right-panel">

                <?php include_once("../header.php");?>

</form>
</body>
</html>
<?php
include_once("../common/functions.php");
$con=mysqli_connect("localhost","root","","DPS");
$userID=$_POST['userID'];
$vendorName=$_POST['vendorName'];
$vendorTypeID=$_POST['vendorTypeID'];
$vendorAddress=$_POST['vendorAddress'];
$vendorTel=$_POST['vendorTel'];
$vendorDescription=$_POST['vendorDescription'];

//echo $vendorName;
//echo $vendorTypeID;

$sql="insert into vendor_info (userID,vendorName,vendorTypeID,vendorAddress,vendorTel,vendorDescription) values('$userID','$vendorName','$vendorTypeID','$vendorAddress','$vendorTel','$vendorDescription')";
        $result=mysqli_query($con,$sql);
        if(!$result)
        {
            echo"Register Unsuccessful！";
            echo"<a href='registerForm.php'>返回</a>";
        }
        else
        {
            echo"Register Successful!";
            echo "<script type='text/javascript'>";
            echo "setTimeout(\"window.location.href='../homepage.php'\",2000)";
            echo "</script>";

}

?>  