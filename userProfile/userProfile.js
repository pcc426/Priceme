/******** [START] User profile JavaScript ********/
function goToUpdateUserProfile(){
	location.href='updateUserProfile.php';
}

function goToUserProfile(){
	location.href='userProfile.php';
}

function formSubmit(){
	resetErrMsg();

	if(!updateUserProfileFormValidate()){
		return false;
	}
}

function resetErrMsg(){
	document.getElementById("emailMsg").innerHTML = "";
	
	document.getElementById("currentPassInfoMsg").innerHTML = "";
	document.getElementById("currentPassMsg").innerHTML = "";
	document.getElementById("newPassInfoMsg").innerHTML = "";
	document.getElementById("newPassMsg").innerHTML = "";
	document.getElementById("repeatNewPassInfoMsg").innerHTML = "";
	document.getElementById("repeatNewPassMsg").innerHTML = "";
	
	document.getElementById("engSurnameMsg").innerHTML = "";
	document.getElementById("engMidNameMsg").innerHTML = "";
	//document.getElementById("engNameMsg").innerHTML = "";
	document.getElementById("telMsg").innerHTML = "";
	document.getElementById("address1Msg").innerHTML = "";
	document.getElementById("address2Msg").innerHTML = "";
	document.getElementById("address3Msg").innerHTML = "";
	document.getElementById("address4Msg").innerHTML = "";
}

/* 
Automatic HTML form validation does not work in Internet Explorer 9 or earlier.
We have to implement javaScript client side validation in updateUserProfileFormValidation() function.
*/
function updateUserProfileFormValidate(){
	var isValid = true;
	var _email 			= document.forms["updateUserProfileForm"]["email"].value;
	
	var _currentPass	= document.forms["updateUserProfileForm"]["currentPass"].value;
	var _newPass		= document.forms["updateUserProfileForm"]["newPass"].value;
	var _repeatNewPass	= document.forms["updateUserProfileForm"]["repeatNewPass"].value;
	
	var _engSurname 	= document.forms["updateUserProfileForm"]["engSurname"].value;
	var _engMidName 	= document.forms["updateUserProfileForm"]["engMidName"].value;
	var _engName 		= document.forms["updateUserProfileForm"]["engName"].value;
	var _tel 			= document.forms["updateUserProfileForm"]["tel"].value;
	var _address1 		= document.forms["updateUserProfileForm"]["address1"].value;
	var _address2 		= document.forms["updateUserProfileForm"]["address2"].value;
	var _address3 		= document.forms["updateUserProfileForm"]["address3"].value;
	var _address4 		= document.forms["updateUserProfileForm"]["address4"].value;

	// ******** [START] Email validation ********
	checkEmailExist();
	
    if (_email == "") {
		document.getElementById("emailMsg").innerHTML = "[E701] Email must be input!";				
		
		if(isValid){
			document.forms["updateUserProfileForm"]["email"].focus();  
		}			
        isValid = false;
    }
	
	//Validate email address format
    if (_email != "") {
		//var regularExpress4EmailPattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		//var isEmailValid = regularExpress4EmailPattern.test(_email);
		var isEmailValid = validateEmailFormat(_email)
  
		if(!isEmailValid){
			document.getElementById("emailMsg").innerHTML = "[E702] Invalid Email!";
			
			if(isValid){
				document.forms["updateUserProfileForm"]["email"].focus();  
			}			
			isValid = false;			
		}
    }	
	// ******** [END] Email validation ********
	
    // ******** [START] Password validation ********
    if(_currentPass.trim() != "" || _newPass.trim() != "" || _repeatNewPass.trim() != "") {
    	_currentPass 	= _currentPass.trim();
    	_newPass 		= _newPass.trim();
    	_repeatNewPass 	= _repeatNewPass.trim();
    	
	    if (_currentPass == "") {
			document.getElementById("currentPassMsg").innerHTML = "[E716] Current password must be input!";				
			
			if(isValid){
				document.forms["updateUserProfileForm"]["currentPass"].focus();   
			}
	        isValid = false;
	    }
		
	    if (_newPass == "") {
			document.getElementById("newPassMsg").innerHTML = "[E717] New password must be input!";				
			
			if(isValid){
				document.forms["updateUserProfileForm"]["newPass"].focus();   
			}
	        isValid = false;
	    }
	    
	    if (_repeatNewPass == "") {
			document.getElementById("repeatNewPassMsg").innerHTML = "[E718] Repeat new password must be input!";				
			
			if(isValid){
				document.forms["updateUserProfileForm"]["repeatNewPass"].focus();   
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
		if(_newPass != ""){
			var anUpperCase = /[A-Z]/;
			var aLowerCase = /[a-z]/; 
			var aNumber = /[0-9]/;
			var aSpecial = /[!|@|#|$|%|^|&|*|(|)|-|_]/;
			var passValid = true;
			
			if(_newPass.length < 8 || _newPass.length > 20){
				document.getElementById("newPassMsg").innerHTML = "[E719] New password length must be 8 - 20 characters!";	
				document.forms["updateUserProfileForm"]["newPass"].value="";
				
				if(isValid){
					document.forms["updateUserProfileForm"]["newPass"].focus();   
				}
				isValid = false;
				passValid = false;
			}
	
			var numUpper = 0;
			var numLower = 0;
			var numNums = 0;
			var numSpecials = 0;
			for(var i=0; i<_newPass.length; i++){
				if(anUpperCase.test(_newPass[i])){
					numUpper++;
				}else if(aLowerCase.test(_newPass[i])){
					numLower++;
				}else if(aNumber.test(_newPass[i])){
					numNums++;
				}else if(aSpecial.test(_newPass[i])){
					numSpecials++;
				}
			}
	
			if(numUpper < 2 && passValid){
				document.getElementById("newPassMsg").innerHTML = "[E720] New password must contain at least 2 upper case characters!";
				document.forms["updateUserProfileForm"]["newPass"].value="";
				
				if(isValid){
					document.forms["updateUserProfileForm"]["newPass"].focus();   
				}
				isValid = false;
				passValid = false;
			}
			
			if(numLower < 2 && passValid){
				document.getElementById("newPassMsg").innerHTML = "[E721] New password must contain at least 2 lower case characters!";
				document.forms["updateUserProfileForm"]["newPass"].value="";
				
				if(isValid){
					document.forms["updateUserProfileForm"]["newPass"].focus();   
				}
				isValid = false;
				passValid = false;
			}
			
			if(numNums < 2 && passValid){
				document.getElementById("newPassMsg").innerHTML = "[E722] New password must contain at least 2 numeric characters!";
				document.forms["updateUserProfileForm"]["newPass"].value="";
					
				if(isValid){
					document.forms["updateUserProfileForm"]["newPass"].focus();   
				}
				isValid = false;
				passValid = false;
			}
			
			if(numSpecials <2 && passValid){
				document.getElementById("newPassMsg").innerHTML = "[E723] New password must contain at least 2 special characters!";	
				document.forms["updateUserProfileForm"]["newPass"].value="";
				
				if(isValid){
					document.forms["updateUserProfileForm"]["newPass"].focus();   
				}
				isValid = false;
				passValid = false;
			}	
		}	
		    
		//Check new password equal to repeat new password
	    if (_newPass != "" && _repeatNewPass != "" && _newPass != _repeatNewPass) {
			document.getElementById("repeatNewPassMsg").innerHTML = "[E724] Repeat new password must be equal to New password!";				
			document.forms["updateUserProfileForm"]["repeatNewPass"].value="";
			
			if(isValid){
				document.forms["updateUserProfileForm"]["repeatNewPass"].focus();   
			}
	        isValid = false;
	    }
	    
	    if (_newPass != "" && _currentPass != "" && _newPass == _currentPass) {
			document.getElementById("newPassMsg").innerHTML = "[E726] New password must be different from Current password!";				
			document.forms["updateUserProfileForm"]["newPass"].value="";
			
			if(isValid){
				document.forms["updateUserProfileForm"]["newPass"].focus();   
			}
	        isValid = false;
	    }
    }
    // ******** [END] Password validation ********
        
    if (_engSurname == "") {
		document.getElementById("engSurnameMsg").innerHTML = "[E703] English Surname must be input!";				

		if(isValid){
			document.forms["updateUserProfileForm"]["engSurname"].focus();
		}			
        isValid = false;
    }

    if (_engMidName == "") {
		document.getElementById("engMidNameMsg").innerHTML = "[E704] English Middle Name must be input!";				
		
		if(isValid){
			document.forms["updateUserProfileForm"]["engMidName"].focus();   
		}
        isValid = false;
    }
	
	//English middle name is NOT mandatory field.
	
	//Sex field is checkbox with default value 'Male', no need to check empty	
	
	// ******** [START] Contact phone number validation ********
    if (_tel == "") {
		document.getElementById("telMsg").innerHTML = "[E705] Contact Phone No. must be input!";				
		
		if(isValid){
			document.forms["updateUserProfileForm"]["tel"].focus();   
		}
        isValid = false;
    }
	
	//Contact phone number must be numeric and the length should be 8 digits
    if (_tel != "") {
		var _telDigitOnly = _tel.trim().replace(/\D/g, "");
		var regularExpress4Tel = /^\d+$/;		
		var isValidTel = regularExpress4Tel.test(_telDigitOnly);
  
		if(!isValidTel){
			document.getElementById("telMsg").innerHTML = "[E706] Contact Phone No. must be numeric!";				
			
			if(isValid){
				document.forms["updateUserProfileForm"]["tel"].focus();   
			}
			isValid = false;
		}
		/*
		else{
			if(_telDigitOnly.length != 8){
				document.getElementById("telMsg").innerHTML = "[E022] Contact Phone No. must be 8 digits!";				
				
				if(isValid){
					document.forms["updateUserProfileForm"]["tel"].focus();   
				}
				isValid = false;
			}
		}
		*/
    }
	// ******** [END] Contact phone number validation ********

    if (_address1 == "") {
		document.getElementById("address1Msg").innerHTML = "[E707] Flat and floor no. must be input!";				
		
		if(isValid){
			document.forms["updateUserProfileForm"]["address1"].focus();   
		}
        isValid = false;
    }
	
    if (_address2 == "") {
		document.getElementById("address2Msg").innerHTML = "[E708] Name of building must be input!";				
		
		if(isValid){
			document.forms["updateUserProfileForm"]["address2"].focus();   
		}
        isValid = false;
    }
	
    if (_address3 == "") {
		document.getElementById("address3Msg").innerHTML = "[E709] Building no. and name of street must be input!";				
		
		if(isValid){
			document.forms["updateUserProfileForm"]["address3"].focus();  
		}			
        isValid = false;
    }

    if (_address4 == "") {
		document.getElementById("address4Msg").innerHTML = "[E710] District must be input!";				
		
		if(isValid){
			document.forms["updateUserProfileForm"]["address4"].focus();  
		}			
        isValid = false;
    }	
	
	return isValid;
}

function validateEmailFormat($_email){
	var regularExpress4EmailPattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var isEmailValid = regularExpress4EmailPattern.test($_email);
	return isEmailValid;
}

/*
Ajax call to check if USER ID and email already registered.
Ajax call to upload user profile image.
*/
$(document).ready( 
	function(){ 
		$("#email").blur(
			function(){
				document.getElementById("emailInfoMsg").innerHTML = "";
				document.getElementById("emailMsg").innerHTML = "";
				checkEmailExist();
			}
		);
	}
);

function checkEmailExist()
{
	var _email=document.getElementById("email").value.trim();
	var _currentEmail=document.getElementById("currentEmail").value.trim();
	if(_email == _currentEmail){
		return;
	}
	var _userID=document.getElementById("userID").value.trim();
	
	if(_email != "" && _userID != "")
	{
		var _emailUserID = {"email":_email, "userID":_userID}; 
		if(validateEmailFormat(_email)){
			$.ajax(
				{
					type: 'post',
					url: './userProfileAjaxService.php',
					
					data: {
						emailUserID2Check:_emailUserID
					},
					
					success: function (response) 
					{
						if(response=="N")
						{
							document.getElementById("emailInfoMsg").innerHTML="[I701] Email is acceptable!";
						}
						else
						{
							document.getElementById("emailMsg").innerHTML="[E711] Email is already registered, please register by other email!";
						}
					}
				}
			);
		}else{
			document.getElementById("emailMsg").innerHTML = "[E702] Invalid Email!";
		}
	}
}

/*
function uploadProfileImg(){
	document.getElementById("profileImgInfoMsg").innerHTML = "";
	document.getElementById("profileImgMsg").innerHTML = "";
	uploadUserProfileImg();
}

function uploadUserProfileImg()
{
	alert("ddddd");
	//var _profileImg = document.getElementById("profileImg").value;
	
	var _userProfileImg = new FormData();
	_userProfileImg.append('file', $('#profileImg')[0].files[0]);
	alert("bbb" + _userProfileImg);
	if(_userProfileImg != "")
	{
		$.ajax(
			{
				type: 'post',
				url: './userProfileAjaxService.php',
				
				data: new FormData(this),
			    
			    //async: false,
			    cache: false,
				processData: false,  // tell jQuery not to process the data
				contentType: false,  // tell jQuery not to set contentType
				enctype: 'multipart/form-data',
				
				success: function (response) 
				{
					alert("result:" + response);
					if(response=="N")
					{
						document.getElementById("profileImgInfoMsg").innerHTML="[I702] User profile image is updated successfully!";
					}
					else
					{
						document.getElementById("profileImgMsg").innerHTML="[E713] Failed to update user profile image!";
					}
				}
			}
		)
	}
}
*/
/******** [END] User profile JavaScript ********/

