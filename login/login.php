<?php
session_start();
?>
<html>
<head>
    <meta charset="utf-8">

    <title>Unicorn Restaurant - Registration</title>

    <?php include_once("../import.php");?>

    <link rel="stylesheet" href="../unicorn.css" type="text/css">
    <link rel="stylesheet" href="../registration/registration.css" type="text/css">
    <script type="text/javascript" src="../unicorn.js"></script>
    <script type="text/javascript" src="../registration/registration.js"></script>

</head>

<body>
    <div id="loading"></div>
    <div id="app"  style="display:none;" >
        <div>

            <?php include_once("../leftPanel.php");?>

            <!-- ******** [START] Right panel ******** -->
            <div id="right-panel" class="right-panel">

                <?php include_once("../header.php");?>


</body>
</html>
<?php
include_once("../common/functions.php");


    if(!isset($_POST["login"])){
        exit("错误执行");
    }
    $con=mysqli_connect("localhost","root","","DPS");
    //include('connect.php');//链接数据库
    $userName = $_POST['userIDEmail'];//post获得用户名表单值
    $password = $_POST['pass'];//post获得用户密码单值

    if ($userName && $password){
             $sql = "select * from user where userName = '$userName' and password='$password'";//检测数据库是否有对应的username和password的sql
             $result = mysqli_query($con,$sql);//执行sql
             $rows=mysqli_num_rows($result);//返回一个数值
             if($rows){//0 false 1 true
                 $data = mysqli_fetch_array($result);
                 $_SESSION['userID']=$data['userID'];
                 $_SESSION['userName']=$data['userName'];
                 echo"Welcome Back ";
                 //echo $_SESSION['userID'];
                 echo $_SESSION['userName'];
                 echo"
                 <script>
                 setTimeout(function(){window.location.href='../recommend/homepage.php';},2000);
                 </script>";
                   exit;
             }else{
                echo "用户名或密码错误";
                echo "
                    <script>
                          setTimeout(function(){window.location.href='../recommend/homepage.php';},2000);
                    </script>

                ";//如果错误使用js 1秒后跳转到登录页面重试;
             }


    }else{//如果用户名或密码有空
                echo "表单填写不完整";
                echo "
                      <script>
//                            setTimeout(function(){window.location.href='login.html';},1000);
                      </script>";

                        //如果错误使用js 1秒后跳转到登录页面重试;
    }

    //mysqli_close($con);//关闭数据库

?>