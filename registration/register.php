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
</body>
</html>
<?php
include_once("../common/functions.php");
$con=mysqli_connect("localhost","root","","DPS");
$userName=$_POST['userName'];
$pass=$_POST['pass'];
$repeatPass=$_POST['repeatPass'];
$userCategory=$_POST['userCategory'];
if($userName==""|| $pass=="")
{
    echo"User Name or Password can't be empty";
}
else
{
    if($pass!=$repeatPass)
    {
        echo"Password not match! Please input again";
        echo"<a href='registerForm.php'>Again</a>";
    }
    else
    {
        $sql="insert into user (userName,password,userCategory) values('$userName','$pass','$userCategory')";
        $result=mysqli_query($con,$sql);
        if(!$result)
        {
            echo"<script>
                        confirm('Register Failed!');
                        setTimeout(function(){window.location.href='../registration/registerForm.php';});
                  </script> ";
        }
        else
        {
            echo"<script>
                        confirm('Register successfully! Please input $userCategory information.');
                  </script> ";
        }
    }
}
if($userCategory=="Customer")
{   $userID=$getID=mysqli_insert_id($con);//$getID即为最后一条记录的ID
    $url = "./customer_Form.php";
    echo "<script type='text/javascript'>";
    echo "setTimeout(\"window.location.href='".$url."?userID=".$userID."'\")";
    echo "</script>";
}
if($userCategory=="Vendor")
{   $userID=$getID=mysqli_insert_id($con);//$getID即为最后一条记录的ID
    $url = "./vendor_Form.php";
    echo "<script type='text/javascript'>";
    echo "setTimeout(\"window.location.href='".$url."?userID=".$userID."'\")";
    echo "</script>";
}
?>  