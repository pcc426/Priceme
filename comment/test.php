<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 18/7/2018
 * Time: 下午11:09
 */

include_once("comment_function.php");

$order = db_get_last_OrderID_from_Order("1");

print_r($order);

