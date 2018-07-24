<?php
/**
 * Created by IntelliJ IDEA.
 * User: QU Xinmiao
 * Date: 20/6/2018
 * Time: 下午3:23
 */

include_once("functions.php");
include_once("entity.php");

//$a = db_select_product_by_productID(1);
//
//$p = $a->getPrice();

$order = new Order("","","","","","","","","","","","","","","","","","");

db_insert_order($order);