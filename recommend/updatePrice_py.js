/**
 * Created by pcc on 2018/7/11.
 */


//document.write("<script type='text/javascript' src='../jquery-3.3.1.min.js'></script>");
//document.write("<script type='text/javascript' src='../jq_plugins.js'></script>");


//$(document).ready(function(){
//    //checkPythonResults();
//    //$('#updPrice').click(checkPythonResults());
//    document.getElementById("updPrice").addEventListener('click', checkPythonResults(), false);
//
//});
//window.onload = function(){
//    var btn = document.getElementById("updPrice");
//    btn.addEventListener('click', checkPythonResults(), false);
//}
//document.getElementById("updPrice").onclick = function(){checkPythonResults()};
$('#updPrice').click(checkPythonResults());

function checkPythonResults(){
    var execRes = "";
    $('#python-result').empty();

    $.ajax(
        {
            type:'post',
            url:'py_service.php',
            data:{
                checkPython:true
            },
            dataType:'json',
            success:function(result){
                if(result["code"]!=0){
                    //If the results of query is abnormal, display error msg given by backend.
                    execRes = result["message"];
                }
                else{
                    // If the response data is iterable, use EACH for iteration
                    //$.each(result["data"],function(i,n){
                    //    //var tarPrice 	= n["pred_price"];
                    //    execRes+= 	"<p>" + n + "</p>";
                    //    //$execRes+= 	n;
                    //
                    //});
                    execRes+= 	"<p>" + result["data"] + "</p>";  //If the data is not iterable, just append
                }

                $('#python-result').empty();
                $('#python-result').append(execRes);
            }
        }
    )
}