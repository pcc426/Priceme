<?php
/**
 * Created by PhpStorm.
 * User: pcc
 * Date: 2018/7/11
 * Time: 18:52
 */
//$DEFAULT_PYTHON_FILE = './exec_py.py';
$DEFAULT_PYTHON_FILE = '../../ec_eclipse/dps_predict.py';

function exec_python($pyFileName){
    $PYTHON_HOME = "/usr/local/bin/";
    $pre_cmd = $PYTHON_HOME . "python3 " . $pyFileName;
//    $pre_cmd = "/usr/local/bin/python3 /Users/pcc/ec_eclipse/dps_predict.py";
//    $pre_cmd = "/usr/local/bin/python3 " . $pyFileName;
//    echo $pre_cmd;
    $cmd = exec($pre_cmd,$cmd,$ret);
//    $cmd = system($pre_cmd,$ret);
//    echo("ret is $ret  ");

    return array('cmd' => $cmd, 'ret' => $ret);
}


function results_jsonEncode($resArray){
    $api_output = array(
        'data'=>array(),
        'message'=>'',
        'code'=>2
    );
    if($resArray['ret'] != 0){
        $api_output['message'] = '<span style="color:red;">' . $resArray['cmd'] .'</span>';
        $api_output['code'] = $resArray['ret'];
    }
    else{
        $api_output['data'] = $resArray['cmd'];
        $api_output['message'] = '';
        $api_output['code'] = $resArray['ret'];
    }
    $json_print = json_encode($api_output, JSON_PRETTY_PRINT);
    return $json_print;

}

if(isset($_POST['checkPython'])){
    getPyResults($DEFAULT_PYTHON_FILE);
    exit();
}

function getPyResults($py_file){
    $res = exec_python($py_file);
    echo results_jsonEncode($res);
}

echo getPyResults($DEFAULT_PYTHON_FILE);
//echo exec_python($DEFAULT_PYTHON_FILE);

?>

