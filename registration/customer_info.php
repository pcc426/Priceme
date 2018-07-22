<html>
<head>
    <meta charset="utf-8">

    <title>Priceme</title>

    <?php include_once("../import.php");?>

    <link rel="stylesheet" href="../unicorn.css" type="text/css">
    <link rel="stylesheet" href="./registration.css" type="text/css">
    <script type="text/javascript" src="registration.js"></script>
</head>

<body>

        <div>
            <?php include_once("../leftPanel.php");?>

            <!-- ******** [START] Right panel ******** -->
            <div id="right-panel" class="right-panel">

                <?php include_once("../header.php");?>

                <!-- ******** [START] Navigation Body ******** -->
                <div>

</body>
</html>
<?php
include_once("../common/functions.php");
$con=mysqli_connect("localhost","root","","DPS");
$userID=$_POST['userID'];
$customerName=$_POST['customerName'];
$email=$_POST['email'];
$tel=$_POST['tel'];

$sql="insert into customer_info (userID,customerName,customerEmail,customerTel) values('$userID','$customerName','$email','$tel')";
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
            echo "setTimeout(\"window.location.href='../recommend/homepage.php'\",2000)";
            echo "</script>";


}

?>  