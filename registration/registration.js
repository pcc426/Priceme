/******** [START] Account registration JavaScript ********/
function formSubmit(){
	resetErrMsg();

	if(!regFormValidate()){
		return false;
	}
}

function resetErrMsg(){
	document.getElementById("userNameMsg").innerHTML = "";
	document.getElementById("userNameInfoMsg").innerHTML = "";
	// document.getElementById("emailMsg").innerHTML = "";
	// document.getElementById("emailInfoMsg").innerHTML = "";
	document.getElementById("passMsg").innerHTML = "";
	document.getElementById("repeatPassMsg").innerHTML = "";
	// document.getElementById("engSurnameMsg").innerHTML = "";
	// document.getElementById("engMidNameMsg").innerHTML = "";
	//document.getElementById("engNameMsg").innerHTML = "";
	// document.getElementById("telMsg").innerHTML = "";
	// document.getElementById("address1Msg").innerHTML = "";
	// document.getElementById("address2Msg").innerHTML = "";
	// document.getElementById("address3Msg").innerHTML = "";
	// document.getElementById("address4Msg").innerHTML = "";
	document.getElementById("tcMsg").innerHTML = "";
	//document.getElementById("emailMsg").innerHTML = "";
	//document.getElementById("repeatPassMsg").innerHTML = "";
	//document.getElementById("telMsg").innerHTML = "";
	//document.getElementById("telMsg").innerHTML = "";
}

/* 
Automatic HTML form validation does not work in Internet Explorer 9 or earlier.
We have to implement javaScript client side validation in regFormValidation() function.
*/
function regFormValidate(){
	var isValid = true;
	var isValidUserIDFormat = true;
	var isValidEmailFormat = true;
	var _userName = document.forms["regForm"]["userName"].value;
	//var _email = document.forms["regForm"]["email"].value;
	var _pass = document.forms["regForm"]["pass"].value;
	var _repeatPass = document.forms["regForm"]["repeatPass"].value;
	// var _engSurname = document.forms["regForm"]["engSurname"].value;
	// var _engMidName = document.forms["regForm"]["engMidName"].value;
	// var _engName = document.forms["regForm"]["engName"].value;
	// var _tel = document.forms["regForm"]["tel"].value;
	// var _address1 = document.forms["regForm"]["address1"].value;
	// var _address2 = document.forms["regForm"]["address2"].value;
	// var _address3 = document.forms["regForm"]["address3"].value;
	// var _address4 = document.forms["regForm"]["address4"].value;
	var _tc = document.forms["regForm"]["tc"].checked;
	
	// ******** [START] User ID validation ********	
	isValid = checkUserNameValidInSync();
	// ******** [END] User ID validation ********
	
	// ******** [START] Email validation ********
    // if (_email == "") {
	// 	document.getElementById("emailMsg").innerHTML = "[E006] Email must be input!";
	//
	// 	if(isValid){
	// 		document.forms["regForm"]["email"].focus();
	// 	}
     //    isValid = false;
     //    isValidEmailFormat = false;
    // }
	//
	// //Validate email address format
    // if (_email != "") {
	// 	//var regularExpress4EmailPattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	// 	//var isEmailValid = regularExpress4EmailPattern.test(_email);
	// 	var isEmailValid = validateEmailFormat(_email)
    //
	// 	if(!isEmailValid){
	// 		document.getElementById("emailMsg").innerHTML = "[E008] Invalid Email!";
	//
	// 		if(isValid){
	// 			document.forms["regForm"]["email"].focus();
	// 		}
	// 		isValid = false;
	// 		isValidEmailFormat = false;
	// 	}
    // // }
    //
	// if(isValidEmailFormat){
	// 	if(checkEmailExistInSync()){
	// 		document.forms["regForm"]["email"].focus();
	// 		isValid = false;
	// 	};
	// }
	// ******** [END] Email validation ********
	
	// ******** [START] Password validation ********
    if (_pass == "") {
		document.getElementById("passMsg").innerHTML = "[E009] Password must be input!";				
		
		if(isValid){
			document.forms["regForm"]["pass"].focus();   
		}
        isValid = false;
    }
	
	/*
		Check password format and character combination
		rule 1 : Password length must be 8 - 20 characters
		rule 2 : Password must contain at least 2 upper case characters
		rule 3 : Password must contain at least 2 lower case characters
		rule 4 : Password must contain at least 2 numeric characters
		rule 5 : Password must contain at least 2 special characters
	*/
	if(_pass != ""){
		// var anUpperCase = /[A-Z]/;
		// var aLowerCase = /[a-z]/;
		// var aNumber = /[0-9]/;
		// var aSpecial = /[!|@|#|$|%|^|&|*|(|)|-|_]/;
		var passValid = true;
		
		if(_pass.length < 6 || _pass.length > 20){
			document.getElementById("passMsg").innerHTML = "[E010] Password length must be 6 - 20 characters!";
			document.forms["regForm"]["pass"].value="";
			if(isValid){
				document.forms["regForm"]["pass"].focus();   
			}
			isValid = false;
			passValid = false;
		}

		// var numUpper = 0;
		// var numLower = 0;
		// var numNums = 0;
		// var numSpecials = 0;
		// for(var i=0; i<_pass.length; i++){
		// 	if(anUpperCase.test(_pass[i])){
		// 		numUpper++;
		// 	}else if(aLowerCase.test(_pass[i])){
		// 		numLower++;
		// 	}else if(aNumber.test(_pass[i])){
		// 		numNums++;
		// 	}else if(aSpecial.test(_pass[i])){
		// 		numSpecials++;
		// 	}
		// }

		// if(numUpper < 2 && passValid){
		// 	document.getElementById("passMsg").innerHTML = "[E011] Password must contain at least 2 upper case characters!";
		// 	document.forms["regForm"]["pass"].value="";
		//
		// 	if(isValid){
		// 		document.forms["regForm"]["pass"].focus();
		// 	}
		// 	isValid = false;
		// 	passValid = false;
		// }
		//
		// if(numLower < 2 && passValid){
		// 	document.getElementById("passMsg").innerHTML = "[E012] Password must contain at least 2 lower case characters!";
		// 	document.forms["regForm"]["pass"].value="";
		//
		// 	if(isValid){
		// 		document.forms["regForm"]["pass"].focus();
		// 	}
		// 	isValid = false;
		// 	passValid = false;
		// }
		//
		// if(numNums < 2 && passValid){
		// 	document.getElementById("passMsg").innerHTML = "[E013] Password must contain at least 2 numeric characters!";
		// 	document.forms["regForm"]["pass"].value="";
		//
		// 	if(isValid){
		// 		document.forms["regForm"]["pass"].focus();
		// 	}
		// 	isValid = false;
		// 	passValid = false;
		// }
		//
		// if(numSpecials <2 && passValid){
		// 	document.getElementById("passMsg").innerHTML = "[E014] Password must contain at least 2 special characters!";
		// 	document.forms["regForm"]["pass"].value="";
		//
		// 	if(isValid){
		// 		document.forms["regForm"]["pass"].focus();
		// 	}
		// 	isValid = false;
		// 	passValid = false;
		// }
	}	
	// ******** [END] Password validation ********
	
	// ******** [START] Repeat Password validation ********
    if (_repeatPass == "") {
		document.getElementById("repeatPassMsg").innerHTML = "[E0151] Repeat Password must be input!";
		
		if(isValid){
			document.forms["regForm"]["repeatPass"].focus();   
		}
        isValid = false;
    }
	
	//Check password equal to repeat password
    if (_pass != "" && _repeatPass != "" && _pass != _repeatPass) {
		document.getElementById("repeatPassMsg").innerHTML = "[E016] Repeat Password must be equal to Password!";				
		document.forms["regForm"]["repeatPass"].value="";
		
		if(isValid){
			document.forms["regForm"]["repeatPass"].focus();   
		}
        isValid = false;
    }	
	// ******** [END] Repeat Password validation ********

    // if (_engSurname == "") {
		// document.getElementById("engSurnameMsg").innerHTML = "[E017] English Surname must be input!";
    //
		// if(isValid){
		// 	document.forms["regForm"]["engSurname"].focus();
		// }
    //     isValid = false;
    // }
    //
    // if (_engMidName == "") {
		// document.getElementById("engMidNameMsg").innerHTML = "[E018] English Middle Name must be input!";
		//
		// if(isValid){
		// 	document.forms["regForm"]["engMidName"].focus();
		// }
    //     isValid = false;
    // }
	
	//English middle name is NOT mandatory field.
	
	//Sex field is checkbox with default value 'Male', no need to check empty	
	
	// ******** [START] Contact phone number validation ********
    // if (_tel == "") {
	// 	document.getElementById("telMsg").innerHTML = "[E019] Contact Phone No. must be input!";
	//
	// 	if(isValid){
	// 		document.forms["regForm"]["tel"].focus();
	// 	}
     //    isValid = false;
    // }
	
	//Contact phone number must be numeric and the length should be 8 digits
    // if (_tel != "") {
	// 	var _telDigitOnly = _tel.trim().replace(/\D/g, "");
	// 	var regularExpress4Tel = /^\d+$/;
	// 	var isValidTel = regularExpress4Tel.test(_telDigitOnly);
    //
	// 	if(!isValidTel){
	// 		document.getElementById("telMsg").innerHTML = "[E020] Contact Phone No. must be numeric!";
	//
	// 		if(isValid){
	// 			document.forms["regForm"]["tel"].focus();
	// 		}
	// 		isValid = false;
	// 	}
	//
	// 	else{
	// 		if(_telDigitOnly.length != 8){
	// 			document.getElementById("telMsg").innerHTML = "[E026] Contact Phone No. must be at least 8 digits!";
	//
	// 			if(isValid){
	// 				document.forms["regForm"]["tel"].focus();
	// 			}
	// 			isValid = false;
	// 		}
	// 	}
    // }
	// ******** [END] Contact phone number validation ********

    // if (_address1 == "") {
		// document.getElementById("address1Msg").innerHTML = "[E021] Flat and floor no. must be input!";
		//
		// if(isValid){
		// 	document.forms["regForm"]["address1"].focus();
		// }
    //     isValid = false;
    // }
    //
    // if (_address2 == "") {
		// document.getElementById("address2Msg").innerHTML = "[E022] Name of building must be input!";
		//
		// if(isValid){
		// 	document.forms["regForm"]["address2"].focus();
		// }
    //     isValid = false;
    // }
    //
    // if (_address3 == "") {
		// document.getElementById("address3Msg").innerHTML = "[E023] Building no. and name of street must be input!";
		//
		// if(isValid){
		// 	document.forms["regForm"]["address3"].focus();
		// }
    //     isValid = false;
    // }
    //
    // if (_address4 == "") {
		// document.getElementById("address4Msg").innerHTML = "[E024] District must be input!";
		//
		// if(isValid){
		// 	document.forms["regForm"]["address4"].focus();
		// }
    //     isValid = false;
    // }

    if (_tc == false) {
		document.getElementById("tcMsg").innerHTML = "[E025] Terms & Conditions must be accepted!";				
		
		if(isValid){
			document.forms["regForm"]["tc"].focus(); 
			document.forms["regForm"]["tc"].checked	= false;		
		}			
        isValid = false;
    }	
	return isValid;
}

// function validateEmailFormat($_email){
// 	var regularExpress4EmailPattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
// 	var isEmailValid = regularExpress4EmailPattern.test($_email);
// 	return isEmailValid;
// }

function validateUserName($_userName, $_formValidate){
	isValid = true;
	_userName = $_userName;
	_formValidate = $_formValidate;
	
    if (_userName == "") {
		document.getElementById("userNameMsg").innerHTML = "[E001] User ID must be input!";

		if(isValid && _formValidate){
			document.forms["regForm"]["userName"].focus();
		}
        isValid = false;
    }
	
	if(_userName.length < 5 || _userName.length > 50){
		document.getElementById("userNameMsg").innerHTML = "[E003] User ID length must be 5 - 50 characters!";
		
		if(isValid && _formValidate){
			document.forms["regForm"]["userName"].focus();
		}
		isValid = false;
	}
    //
	// if (!_userName == "") {
	// 	var regularExpress4UserID = /^[A-Za-z]{1}/;
	// 	var isValidUserID = regularExpress4UserID.test(_userID);
	//
	// 	if(!isValidUserID){
	// 		document.getElementById("userIDMsg").innerHTML = "[E004] The User ID must start with English alphabet!";
	//
	// 		if(isValid && _formValidate){
	// 			document.forms["regForm"]["userID"].focus();
	// 		}
	// 		isValid = false;
	// 	}
	// }

	if (!_userName == "") {
		var regularExpress4UserName = /^[A-Za-z0-9]/;
		var isValidUserName = regularExpress4UserName.test(_userName);
		
		if(!isValidUserName){
			document.getElementById("userNameMsg").innerHTML = "[E005] The User ID must be composed of English alphabets or English alphabets and numbers!";
			
			if(isValid && _formValidate){
				document.forms["regForm"]["userName"].focus();
			}
			isValid = false;
		}
	}
	return isValid;
}

/*
Ajax call to check if USER ID and email already registered.
*/
$(document).ready( 
	function(){
		$("#userName").blur(
			function(){
				document.getElementById("userNameInfoMsg").innerHTML = "";
				document.getElementById("userNameMsg").innerHTML = "";
				checkUserNameExist();
			}
		);
 
		// $("#email").blur(
		// 	function(){
		// 		document.getElementById("emailInfoMsg").innerHTML = "";
		// 		document.getElementById("emailMsg").innerHTML = "";
		// 		checkEmailExist();
		// 	}
		// );
	}
);

			
function checkUserNameExist()
{
	var _userName=document.getElementById("userName").value;
	if(_userName)
	{
		if(validateUserName(_userName, false)){
			$.ajax(
				{
					type: 'post',
					url: './registerAjaxService.php',
					
					data: {
						userID2Check:_userName
					},
					
					success: function (response) 
					{
						if(response=="N")
						{
							document.getElementById("userNameInfoMsg").innerHTML="[I001] User ID is acceptable!";
						}
						else
						{
							document.getElementById("userNameMsg").innerHTML="[E002] The User ID is already in used; please try a different User ID!";
						}
					}
				}
			);
		}
	}
}

// function checkEmailExist()
// {
// 	var _email=document.getElementById("email").value;
// 	if(_email)
// 	{
// 		if(validateEmailFormat(_email)){
// 			$.ajax(
// 				{
// 					type: 'post',
// 					url: './registerAjaxService.php',
//
// 					data: {
// 						email2Check:_email
// 					},
//
// 					success: function (response)
// 					{
// 						if(response=="N")
// 						{
// 							document.getElementById("emailInfoMsg").innerHTML="[I002] Email is acceptable!";
// 						}
// 						else
// 						{
// 							document.getElementById("emailMsg").innerHTML="[E007] Email is already registered, please register by other email!";
// 						}
// 					}
// 				}
// 			);
// 		}else{
// 			document.getElementById("emailMsg").innerHTML = "[E008] Invalid Email!";
// 		}
// 	}
// }

function checkUserNameValidInSync()
{
	var _userName=document.getElementById("userName").value;
	if(_userName)
	{
		if(validateUserName(_userName, true)){
			$.ajax(
				{
					type: 'post',
					url: './registerAjaxService.php',
					async: false,
					data: {
						userID2Check:_userName
					},
					
					success: function (response)
					{
						if(response=="N")
						{
							document.getElementById("userIDInfoMsg").innerHTML="[I001] User ID is acceptable!";
							return true;
						}
						else
						{
							document.getElementById("userIDMsg").innerHTML="[E002] The User ID is already in used; please try a different User ID!";
							return false;
						}
					}
				}
			);
		}else{
			return false;
		}
	}else{
		document.getElementById("userIDMsg").innerHTML = "[E001] User ID must be input!";				
		document.forms["regForm"]["userID"].focus();
		return false;
	}
}

// function checkEmailValidInSync()
// {
// 	var _email=document.getElementById("email").value;
// 	if(_email)
// 	{
// 		if(validateEmailFormat(_email)){
// 			$.ajax(
// 				{
// 					type: 'post',
// 					url: './registerAjaxService.php',
// 					async: false,
// 					data: {
// 						email2Check:_email
// 					},
//
// 					success: function (response)
// 					{
// 						if(response=="N")
// 						{
// 							document.getElementById("emailInfoMsg").innerHTML="[I002] Email is acceptable!";
// 							return true;
// 						}
// 						else
// 						{
// 							document.getElementById("emailMsg").innerHTML="[E007] Email is already registered, please register by other email!";
// 							return false;
// 						}
// 					}
// 				}
// 			);
// 		}else{
// 			document.getElementById("emailMsg").innerHTML = "[E008] Invalid Email!";
// 			return false;
// 		}
// 	}
// }
/******** [END] Account registration JavaScript ********/
