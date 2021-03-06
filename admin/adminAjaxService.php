<?php

include_once("../common/functions.php");

checkLogon();
checkAdmin();

if(isset($_POST['getExistingFoodCat'])){
    load_All_Food_Name_Cat();
    exit();
}

function load_All_Food_Name_Cat(){
    $res = db_select_all_food_category_name();
    echo results_jsonEncode($res);
}

function results_jsonEncode($oriResArray){
    $api_output = array(
        'data'=>array(),
        'message'=>'',
        'code'=>2
    );
    if(!is_array($oriResArray)){
        $api_output['message'] = '<span style="color:red;">[E901] The result from sql is not an array!</span>';
        $api_output['code'] = 1;
    }
    else if(count($oriResArray) == 0){
        $api_output['message'] = '<span style="color:red;">[E902] No results!</span>';
        $api_output['code'] = 2;
    }
    else{
        $api_output['data'] = $oriResArray;
        $api_output['message'] = '';
        $api_output['code'] = 0;
    }
    $json_print = json_encode($api_output, JSON_PRETTY_PRINT);
    return $json_print;
    
}

if(isset($_POST['foodCatName2Check'])){
    $FoodCatName= $_POST['foodCatName2Check'];
    $data_array = json_decode(json_encode($FoodCatName), true);    
    $foodCate = $data_array['foodCate'];
    $foodName = $data_array['foodName'];  
    
    $count = count_Food_By_Food_Cat_Name($foodCate, $foodName);
    
    if(isset($count) && $count >= 0){
        echo $count;
    }else{
        echo -1;
    }
    exit();
}



?>