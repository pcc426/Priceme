/**
 * Created by pcc on 06/03/2018.
 */

document.write("<script type='text/javascript' src='../unicorn.js'></script>");
document.write("<script type='text/javascript' src='../jq_plugins.js'></script>");


$(document).ready(function(){
	prepareSearchSection();
    /*liveSearch();
    loadRecomFood();
    loadAllCateFood();
    loadSec();
    loadSearchBox();
    searchByCookieValue();
    showItemCount();*/
});




function prepareSearchSection(){
	var $searchSection = "";
    $.ajax(
        {
            type:'post',
            url:'recommendService.php',
            async: false,
            data:{    //发送到服务器的数据
                prepareCate:true
            },
            dataType:'json',
            success:function(result){   //成功则执行function函数
                $searchSection += '<select class="foodCategorySel" id="id_foodCategory" name="foodCategory">	                                      ';
                $searchSection += '       <option value=""></option>                                                                                  ';
                $searchSection += '       <option value="All">All</option>                                                                                  ';

                if(result["code"]!=0){
                    //If the results of query is abnormal, display error msg given by backend.
                    $searchSection = result["message"];
                }
                else{
                    $.each(result["data"],function(i,n){  //each() 方法规定为每个匹配元素规定运行的函数.result:要遍历的东西。function(index,element)：必需。为每个匹配元素规定运行的函数。•index - 选择器的 index 位置•element - 当前的元素（也可使用 "this" 选择器）

                        var $foodCategory 	= n["typeName"];
                        $searchSection += '<option value="' + $foodCategory + '">' + $foodCategory + '</option>                                        ';
                    });
                }

                $searchSection += '</select>											                                                               ';
                $searchSection += '<input class="foodSearch ui-widget" type="text" id="id_searchFood" name="searchFood" placeholder="Search here...">  ';
                //$searchSection += '<input class="recom_button" type="button" id="id_searchBtn" name="searchBtn" value="Search">                        ';
                $('#search-section').append($searchSection);
            }
        }
    )
}



/******** [END] Place order JavaScript ********/