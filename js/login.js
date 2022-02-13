$(document).ready(function(){
	$('#login').submit(function(e){
		e.preventDefault();
		var emailErr=""; var passErr="";
		var email = $("#email").val();
		var Password = $("#password").val();
		if(email == "" && Password !==""){
			 emailErr = "Enter Valid Email Id";
		}
		if(Password == "" && email == ""){
			passErr ="Enter Valid Password";
		}
		if(emailErr == "" && passErr == "" ){
		  $.ajax({
			  type: "POST",
			  url: "../php/login.php",
			  data: $('#login').serialize(),
			  dataType: "JSON",
			  success: function(response) 
			  {
				if(response.success){	
				  location.href = '../index.html';
				}
				else{
					$('#loginvalidation').html(response.msg);
				}
			  },
			  error:function(){
				  
			  }
		  });
		}
		else{
			$('#loginvalidation').html(emailErr+"   "+passErr );
		}
   });
   $('a#signup-link').click(function(e){
		  e.preventDefault();
		  location.href = '../html/register.html';
	  });
  });