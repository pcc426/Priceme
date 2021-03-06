<?php
include_once("../common/functions.php");
include_once("../conn.php");

/*healthCheckDB();
healthCheckDBTables();
check_session_timeout();
*/


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['userName'])){
    $userID = $_SESSION['userName'];
}


?>

<html>

<head>
    <meta charset="utf-8">

    <title>Priceme - Home</title>

    <?php include_once("../import.php");?>

    <link rel="stylesheet" href="../unicorn.css" type="text/css">
    <link rel="stylesheet" href="homepage.css" type="text/css">
</head>

<body style="line-height:1;">

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
                        <?php
                        if(isset($_successMsg) && !empty($_successMsg)){
                            echo "$_successMsg";
                        }else{
                            if(isset($userID)){
                                echo "<span class='badge badge-pill badge-success'>Welcome ".$userID."</span> We promise to provide the best price for you！";
                            }else{
                                echo "We promise to provide the best price for you！";
                            }
                        }
                        ?>

                    </div>

                    <div>
                        <!--Price update section start-->
                        <td>
                            <button id="updPrice">Refresh Price!</button>
                        </td>
                        <td>
                            <label>update results:</label>
                            <div id="python-result"> </div>
                        </td>
                        <script type="text/javascript" src="./updatePrice_py.js"></script>

                        <!--Price update section end-->
                    </div>

                    <!-- ******** [END] Alert Message Display ******** -->

                    <form id="searchForm" action="homepage.php" method="post">
                    <table style="margin-left:20px;">
                        <tr>
                            <td>
                                    <select name="vendorType" style="width: 150px;" class="textbox">
                                       <option value="1">Please choose</option>
                                        <?php
                                        $sql2="select * from vendor_type";
                                        $result2=mysqli_query($conn,$sql2);
                                        while($data2=mysqli_fetch_array($result2))
                                        {
                                            ?>
                                            <option value="<?php echo $data2['vendorTypeID']?>"><?php echo $data2['typeName']?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                            </td>
                            <td>
                                <!-- enter键处发windows事件,enter键的ASCII是13 -->
                                <input class="textbox" id="productName" size="20" onKeyPress="if(event.keyCode==13){searchFormSubmit();return false;}" name="productName" type="text" />
                            </td>
                            <td>
                                <input type="submit" value="Search" class="textbox" style="color: #fff;background-color: #d44a4d; border-radius: 5px";>
                            </td>
                            <!--Price update section start-->
<!--                            <script type="text/javascript" src="./updatePrice_py.js"></script>-->
<!--                            <td>-->
<!--                                <button id="updPrice">Refresh Price!</button>-->
<!--                            </td>-->
<!--                            <td>-->
<!--                                <label>update results:</label>-->
<!--                                <div id="python-result"> </div>-->
<!--                            </td>-->
<!---->
                            <!--Price update section end-->
                        </tr>
                    </table>
                    </form>
					<fieldset><legend><h4>Search Result</h4></legend>
                        <table>
                            <tr>
                                <?php
                                $i=0;
								if($_POST['vendorType']="1" && $_POST["productName"]!=""){
									$sql3="select * from vendor_info where vendorName like '%$productName%'";
								}
								else if($_POST['vendorType']!="1" && $_POST["productName"]=""){
									$sql3="select * from vendor_info where vendorTypeID = '$vendorType'";
								}
								else if($_POST['vendorType']="1" && $_POST["productName"]=""){
									echo "<script>alert('Please input vendor category or vendor name!')</script>";
								}
								else{
                                $sql3="select * from vendor_info where vendorTypeID = '$vendorType'and vendorName like '%$productName%'";
								}
                                $result3=mysqli_query($conn,$sql3);
                                while($data3=mysqli_fetch_array($result3)){
                                    if($i%4==0 &&$i!=0) echo "</tr><tr><td colspan=5 height=10></td></tr><tr>";
                                    $i++;
                                    ?>
                                    <td>
                                        <table class="item">
                                            <TBODY>
                                            <TR>
                                                <TD>
                                                    <a href="vendor_detail.php?user_id=<?php echo $data3['userID']?>">
                                                        <img class="pic" src="<?php echo $data3['vendorImage']?>"/>
                                                    </a>
                                                </TD>
                                            </TR>
                                            <TR>
                                                <TD class="item1">
                                                    <a href="vendor_detail.php?user_id=<?php echo $data3['userID']?>">
                                                        <?php echo $data3['vendorName']?>
                                                    </a>
                                                </TD>
                                            </TR>
                                            <TR>
                                                <TD class="item1" style="font-size: 12px;">
                                                    <?php echo $data3['vendorDescription']?>
                                                </TD>
                                            </TR>
                                            </TBODY>
                                        </table>
                                    </td>
                                    <?php
                                }
                                ?>
                            </tr>
                        </table>
                    </fieldset><br>
                    <!-- ******** [START] Food Navigation Division ******** -->
                  
                    
                    <fieldset><legend><h4>Recommend</h4></legend>
					<table class="table1">
						<tr>
						<?php
						$i=0;
						$sql="select * from vendor_info";
						$result=mysqli_query($conn,$sql);
						while($data=mysqli_fetch_array($result)){
							if($i%4==0 &&$i!=0) echo "</tr><tr><td colspan=5 height=10></td></tr><tr>";
									$i++;
						?>
								<td>
        							<table class="item">
            							<TBODY>
              								<TR>
                								<TD>
 													<a href="vendor_detail.php?user_id=<?php echo $data['userID']?>">
 														<img width="240" height="200" src="<?php echo $data['vendorImage']?>"/>
 													</a>
                  								</TD>
                							</TR>
                							<TR padding="5px">
                								<TD class="item1">
              										<a href="vendor_detail.php?user_id=<?php echo $data['userID']?>">
              											<?php echo $data['vendorName']?>
              										</a>
            									</TD>
                							</TR>
                                            <TR>
                                                <TD class="item1" style="font-size: 12px;">
                                                    <?php echo $data['vendorDescription']?>
                                                </TD>
                                            </TR>
              							</TBODY>
      								</table>
      							</td>
						<?php
						}
						?>
						</tr>
					</table>
                    </fieldset><br>
					
                    <!-- ******** [END] Food Navigation Division ******** -->
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