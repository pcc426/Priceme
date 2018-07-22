/******** [START] Place order JavaScript ********/
$(document).ready( 
	function(){
	    //document.getElementById('SubmitBtn').style.display = '';
	    //document.getElementById('ConfirmBtn').style.display = 'none';
	}
);

function formSubmit(){
	resetErrMsg();
	var isValid = cartFormValidate();
	if(!isValid){
		return false;
	}
}

function confirmFormSubmit(){
	//do nothing
}

function updateSubtotal(qtyID, price, subtotalID){
	var _qty = document.getElementById(qtyID).value;
	var _price = price;
	
	document.getElementById(subtotalID).innerHTML = _qty * _price;
	
	var _qtyList = $('[id^="qtyID"]');
	var _totalQty = 0;
	for(var i=0;i<_qtyList.length;i++){
		if(!isNaN(_qtyList[i].value)){
			_totalQty = _totalQty + parseInt(_qtyList[i].value);
		}
	}
	
	var _subtotalList = $('[id^="subtotalID"]');
	var _totalPrice = 0;
	for(var i=0;i<_subtotalList.length;i++){
		if(!isNaN(_subtotalList[i].innerText)){
			_totalPrice = _totalPrice + parseInt(_subtotalList[i].innerText);
		}
	}
	
	document.getElementById("totalQty").innerHTML = _totalQty;
	document.getElementById("totalPrice").innerHTML = _totalPrice;
	document.getElementById("confirmedTotalPrice").innerHTML = _totalPrice;
	document.getElementById("totalPayAmt").value = _totalPrice;
}

function clickCancel(){	
	document.getElementById('SubmitBtn').disabled = false;
	document.getElementById('ConfirmBtn').disabled = true;
	document.getElementById('CancelBtn').disabled = true;
	
	var _qtyList = $('[id^="qtyID"]');		
	for(var i=0;i<_qtyList.length;i++){
		_qtyList[i].disabled = false;					
	}
	
	document.getElementById("deliveryTimeslot").disabled = false;
	
	var paymentMethodList = document.getElementsByName('paymentMethod');
	var _paymentMethod;
	for(var i = 0; i < paymentMethodList.length; i++){
	    if(paymentMethodList[i].checked){
	    	_paymentMethod = paymentMethodList[i].value;
	    }
	}
	
    if (_paymentMethod == "CR") {
		document.getElementById("creditCardNo").disabled = false;
		document.getElementById("chequeNo").disabled = true;
    }else if(_paymentMethod == "CH") {
		document.getElementById("creditCardNo").disabled = true;
		document.getElementById("chequeNo").disabled = false;
    }else {
		document.getElementById("creditCardNo").disabled = true;
		document.getElementById("chequeNo").disabled = true;
    }
}

function resetErrMsg(){
	if(document.getElementById("cartInfoMsg") != undefined){
		document.getElementById("cartInfoMsg").innerHTML = "";
	}
	if(document.getElementById("cartMsg") != undefined){
		document.getElementById("cartMsg").innerHTML = "";
	}
	document.getElementById("creditCardNoMsg").innerHTML = "";
	document.getElementById("chequeNoMsg").innerHTML = "";
	document.getElementById("creditCardCVVMsg").innerHTML = "";
	document.getElementById("creditCardHolderNameMsg").innerHTML = "";
	document.getElementById("creditCardExpiryDateMsg").innerHTML = "";
}

/* 
Automatic HTML form validation does not work in Internet Explorer 9 or earlier.
We have to implement javaScript client side validation in cartFormValidation() function.
*/
function cartFormValidate(isConfirm){
	var isValid = true;
	
	// ******** [START] Quantity validation ********
	var _qtyList = $('[id^="qtyID"]');		
	for(var i=0;i<_qtyList.length;i++){
		if(_qtyList[i].value > 5){
			document.getElementById("cartMsg").innerHTML = 							"[E201] Quantity of a food must be less than or equal to 5!";	
			isValid = false;
		}					
	}
	// ******** [END] Quantity validation ********
	
	// ******** [START] Total price validation ********
	var _totalPrice = ""; //document.getElementById("totalPrice").innerText;
	
    if (isValid && (_totalPrice == "" || _totalPrice == 0)) {
		//document.getElementById("cartMsg").innerHTML = 								"[E202] Total payment amount must be greater than 0!";
		//isValid = false;
    }
    // ******** [END] Total price validation ********
    
    // ******** [START] Payment method validation ********
	var paymentMethodList = document.getElementsByName('paymentMethod');
	var _creditCardNo = creditCardUnformatting(document.getElementById("creditCardNo").value.trim());
	var _creditCardCVV = document.getElementById("creditCardCVV").value.trim();
	var _creditCardHolderName = document.getElementById("creditCardHolderName").value.trim();
	var _creditCardExpiryDate = creditCardExpiryDateUnformatting(document.getElementById("creditCardExpiryDate").value.trim());
	var _chequeNo = document.getElementById("chequeNo").value.trim();
	
	var _paymentMethod;
	for(var i = 0; i < paymentMethodList.length; i++){
	    if(paymentMethodList[i].checked){
	    	_paymentMethod = paymentMethodList[i].value;
	    }
	}

    if (_paymentMethod == "CR") {
    	if(_creditCardNo == ""){
			document.getElementById("creditCardNoMsg").innerHTML = 					"[E203] Credit card no. must be input!";
			document.getElementById("creditCardNo").focus();
	        isValid = false;
    	}else {    		 
    		var regularExpress4CreditCardNo = /^\d+$/;		
    		var isValidCreditCardNo = regularExpress4CreditCardNo.test(_creditCardNo);
      
    		if(!isValidCreditCardNo){
	    		document.getElementById("creditCardNoMsg").innerHTML = 				"[E204] Credit card no. must be numeric!";				
		   		document.getElementById("creditCardNo").focus();
	            isValid = false;
    		}else if(_creditCardNo.length != 16){
        		document.getElementById("creditCardNoMsg").innerHTML = 				"[E205] Credit card no. length must be 16 digits!";
        		document.getElementById("creditCardNo").focus();
                isValid = false;
        	}
    	}
    	
    	if(_creditCardCVV == ""){
			document.getElementById("creditCardCVVMsg").innerHTML = 				"[E206] Credit card CVV no. must be input!";
			if(isValid){
				document.getElementById("creditCardCVV").focus();
			}
	        isValid = false;
    	}else {    		 
    		var regularExpress4CreditCardCVV = /^\d+$/;		
    		var isValidCreditCardCVV = regularExpress4CreditCardCVV.test(_creditCardCVV);
      
    		if(!isValidCreditCardCVV){
	    		document.getElementById("creditCardCVVMsg").innerHTML = 			"[E207] Credit card CVV no. must be numeric!";				
	    		if(isValid){
	    			document.getElementById("creditCardCVV").focus();
	    		}
	            isValid = false;
    		}else if(_creditCardCVV.length != 3){
        		document.getElementById("creditCardCVVMsg").innerHTML = 			"[E208] Credit card CVV no. length must be 3 digits!";
	    		if(isValid){
	    			document.getElementById("creditCardCVV").focus();
	    		}
                isValid = false;
        	}
    	}
    	
    	if(_creditCardHolderName == ""){
			document.getElementById("creditCardHolderNameMsg").innerHTML = 			"[E209] Credit card holder name must be input!";
			if(isValid){
				document.getElementById("creditCardHolderName").focus();
			}
	        isValid = false;
    	}else{
			var regularExpress4ccName = /^[A-Za-z]/;		
			var isValidCCName = regularExpress4ccName.test(_creditCardHolderName);

			if(!isValidCCName){
				document.getElementById("creditCardHolderNameMsg").innerHTML =      "[E217] Credit card holder name must be composed of English alphabets!";	
				
				if(isValid){
					document.getElementById("creditCardHolderName").focus();
				}
				isValid = false;
			}
    	}
    	
    	if(_creditCardExpiryDate == ""){
			document.getElementById("creditCardExpiryDateMsg").innerHTML = 			"[E210] Credit card expiry date must be input!";
			if(isValid){
				document.getElementById("creditCardExpiryDate").focus();
			}
	        isValid = false;
    	}else {    		 
    		var regularExpress4creditCardExpiryDate = /^\d+$/;		
    		var isValidcreditCardExpiryDate = regularExpress4creditCardExpiryDate.test(_creditCardExpiryDate);
      
    		if(!isValidcreditCardExpiryDate){
	    		document.getElementById("creditCardExpiryDateMsg").innerHTML = 		"[E211] Credit card expiry date must be numeric!";				
	    		if(isValid){
	    			document.getElementById("creditCardExpiryDate").focus();
	    		}
	            isValid = false;
    		}else if(_creditCardExpiryDate.length != 4){
        		document.getElementById("creditCardExpiryDateMsg").innerHTML = 		"[E212] Credit card expiry date must be 4 digits!";
	    		if(isValid){
	    			document.getElementById("creditCardExpiryDate").focus();
	    		}
                isValid = false;
        	}else{
        		var _mm = parseInt(_creditCardExpiryDate.substring(0, 2));
        		var _yy = parseInt(_creditCardExpiryDate.substring(2, 4));
        		var _yyyy = new Date().getFullYear() + "";
        		var _currentYear = parseInt(_yyyy.substring(2, 4));
        		
        		if(_mm <= 0 || _mm > 12 || _yy < _currentYear){
	        		document.getElementById("creditCardExpiryDateMsg").innerHTML = 	"[E213] Credit card expiry date is invalid!";
		    		if(isValid){
		    			document.getElementById("creditCardExpiryDate").focus();
		    		}
	                isValid = false;
        		}
        	}
    	}
    } else if(_paymentMethod == "CH") {
       	if(_chequeNo == ""){
			document.getElementById("chequeNoMsg").innerHTML = 						"[E214] Cheque no. must be input!";
			if(isValid){
				document.getElementById("chequeNo").focus();
			}
	        isValid = false;
    	}else {
    		var _chequeNoDigitOnly = _chequeNo.trim().replace(/\D/g, ""); //replace all characters except numeric characters
    		var regularExpress4ChequeNo = /^\d+$/;		
    		var isValidChequeNo = regularExpress4ChequeNo.test(_chequeNoDigitOnly);
      
    		if(!isValidChequeNo){
	    		document.getElementById("chequeNoMsg").innerHTML = 					"[E215] Cheque no. must be numeric!";	
	    		if(isValid){
	    			document.getElementById("chequeNo").focus();
	    		}
	            isValid = false;
    		}else if(_chequeNo.length != 10){
        		document.getElementById("chequeNoMsg").innerHTML = 					"[E216] Cheque no. length must be 10 digits!";
        		if(isValid){
        			document.getElementById("chequeNo").focus();
        		}
                isValid = false;
        	}
    	}
    } else if(_paymentMethod == "CA") {
    	//do nothing
    } else {
		document.getElementById("cartMsg").innerHTML = 								"[E217] System error, please try again later!";	
		isValid = false;
    }
    // ******** [END] Payment validation ********
    
    return isValid;
}

function creditCardFormatting(){
	var _creditCardNoTmp = document.getElementById("creditCardNo").value.trim();
	var _creditCardNoTmpFormatted = "";
	
	if(_creditCardNoTmp.length != 16){
		return;
	}
	
    for (i=0; i<_creditCardNoTmp.length; i+=4) {
    	if(i != 12){
    		_creditCardNoTmpFormatted = _creditCardNoTmpFormatted + _creditCardNoTmp.substring(i, i+4) + "-";
    	}else{
    		_creditCardNoTmpFormatted = _creditCardNoTmpFormatted + _creditCardNoTmp.substring(i, i+4);
    	}
    }

    document.getElementById("creditCardNo").value = _creditCardNoTmpFormatted;
}

function creditCardExpiryDateFormatting(){
	var _creditCardExpiryDateTmp = document.getElementById("creditCardExpiryDate").value.trim();
	var _creditCardExpiryDateTmpFormatted = "";
	
	if(_creditCardExpiryDateTmp.length != 4){
		return;
	}
	
    for (i=0; i<_creditCardExpiryDateTmp.length; i+=2) {
    	if(i != 2){
    		_creditCardExpiryDateTmpFormatted = _creditCardExpiryDateTmpFormatted + _creditCardExpiryDateTmp.substring(i, i+2) + "/";
    	}else{
    		_creditCardExpiryDateTmpFormatted = _creditCardExpiryDateTmpFormatted + _creditCardExpiryDateTmp.substring(i, i+2);
    	}
    }

    document.getElementById("creditCardExpiryDate").value = _creditCardExpiryDateTmpFormatted;
}

function creditCardUnformatting(creditCardNo){
	return creditCardNo.trim().replace(/-/g, "");
}

function creditCardExpiryDateUnformatting(creditCardExpiryDate){
	return creditCardExpiryDate.trim().replace(/\//g, "");
}

function clickCreditCard(){	
	resetErrMsg();
	document.getElementById("creditCardNo").value = "";
    document.getElementById('creditCardNo').disabled = false;
	document.getElementById("chequeNo").value = "";
    document.getElementById('chequeNo').disabled = true;
    
    document.getElementById('cardType1').checked = true;
    document.getElementById('cardType1').disabled = false;
    document.getElementById('cardType2').disabled = false;
    
    document.getElementById("creditCardCVV").value = "";
    document.getElementById('creditCardCVV').disabled = false;
    
    document.getElementById("creditCardHolderName").value = "";
    document.getElementById('creditCardHolderName').disabled = false;
    
    document.getElementById("creditCardExpiryDate").value = "";
    document.getElementById('creditCardExpiryDate').disabled = false;
}

function clickVisaCard(){	
	resetErrMsg();
	document.getElementById("creditCardNo").value = "";
	document.getElementById("creditCardCVV").value = "";
	document.getElementById("creditCardHolderName").value = "";
	document.getElementById("creditCardExpiryDate").value = "";
}

function clickMasterCard(){	
	resetErrMsg();
	document.getElementById("creditCardNo").value = "";
	document.getElementById("creditCardCVV").value = "";
	document.getElementById("creditCardHolderName").value = "";
	document.getElementById("creditCardExpiryDate").value = "";
}

function clickCash(){
	resetErrMsg();
    document.getElementById("creditCardNo").value = "";
	document.getElementById('creditCardNo').disabled = true;
	
    document.getElementById("chequeNo").value = "";
    document.getElementById('chequeNo').disabled = true;
    
    document.getElementById('cardType1').checked = false;
    document.getElementById('cardType1').disabled = true;
    document.getElementById('cardType2').disabled = true;
    
    document.getElementById("creditCardCVV").value = "";
    document.getElementById('creditCardCVV').disabled = true;
    
    document.getElementById("creditCardHolderName").value = "";
    document.getElementById('creditCardHolderName').disabled = true;
    
    document.getElementById("creditCardExpiryDate").value = "";
    document.getElementById('creditCardExpiryDate').disabled = true;    
}

function clickCheque(){	
	resetErrMsg();
	document.getElementById("creditCardNo").value = "";
	document.getElementById('creditCardNo').disabled = true;
    document.getElementById('chequeNo').disabled = false;

    document.getElementById('cardType1').checked = false;
    document.getElementById('cardType1').disabled = true;
    document.getElementById('cardType2').disabled = true;
    
    document.getElementById("creditCardCVV").value = "";
    document.getElementById('creditCardCVV').disabled = true;
    
    document.getElementById("creditCardHolderName").value = "";
    document.getElementById('creditCardHolderName').disabled = true;
    
    document.getElementById("creditCardExpiryDate").value = "";
    document.getElementById('creditCardExpiryDate').disabled = true;   
}

function gotoPrintVersion(placeOrderId)
{
	var currentURL = document.location.href;
	var newURL = currentURL;
		newURL = currentURL.replace("/cartCompleted.php","/cartCompletedPrint.php");
	window.open(newURL,'CSB','width=900,height=1000,resizable=1,scrollbars=1')
}

function printOrder() {
    window.print();
}

/*
function clickSubmit(){
	resetErrMsg();

	if(!cartFormValidate()){
		document.getElementById('SubmitBtn').disabled = false;
		document.getElementById('ConfirmBtn').disabled = true;
		document.getElementById('CancelBtn').disabled = true;
		
		var _qtyList = $('[id^="qtyID"]');		
		for(var i=0;i<_qtyList.length;i++){
			_qtyList[i].disabled = false;					
		}
		
		document.getElementById("deliveryTimeslot").disabled = false;
		
		var paymentMethodList = document.getElementsByName('paymentMethod');
		var _paymentMethod;
		for(var i = 0; i < paymentMethodList.length; i++){
		    if(paymentMethodList[i].checked){
		    	_paymentMethod = paymentMethodList[i].value;
		    }
		}
				
	    if (_paymentMethod == "CR") {
			document.getElementById("creditCardNo").disabled = false;
			document.getElementById("chequeNo").disabled = true;
	    }else if(_paymentMethod == "CH") {
			document.getElementById("creditCardNo").disabled = true;
			document.getElementById("chequeNo").disabled = false;
	    }else {
			document.getElementById("creditCardNo").disabled = true;
			document.getElementById("chequeNo").disabled = true;
	    }
	}else{
		document.getElementById('SubmitBtn').disabled = true;
		document.getElementById('ConfirmBtn').disabled = false;
		document.getElementById('CancelBtn').disabled = false;
		
		var _qtyList = $('[id^="qtyID"]');		
		for(var i=0;i<_qtyList.length;i++){
			_qtyList[i].disabled = true;					
		}
		
		document.getElementById("deliveryTimeslot").disabled = true;
		document.getElementById("creditCardNo").disabled = true;
		document.getElementById("chequeNo").disabled = true;
	}	
	return false;
}
*/

/*
$("button").click(function(){
	var num;
	if($(this).text() == "-"){
		var $num = $(this).next();
		num = parseInt($num.text());
		num--;
		if(num <= 0){
			$num.text(0);
		}else{
			$num.text(num);
		}
	}else{
		var $num = $(this).prev();
		num = parseInt($num.text());
		num++;
		$num.text(num);
	}

	var price = parseInt($(this).parent().prev().children("span").text());
	$(this).parent().next().children("span").text(price*num);

	var $span = $("tbody>tr>td:last-child>span");
	var totalNum = 0;
	for(var i=0;i<$span.length;i++){
		var total = parseInt($($span[i]).text());
		totalNum += total;
	}
	$("tfoot>tr>td:last>span").text(totalNum);
});
*/
/******** [END] Place order JavaScript ********/

