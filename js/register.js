function checkUserName(){
	if($('#username').val() !== ""){
		$.ajax({
			type:"POST",
			url:"../php/connection.php",
			data: {'userName': $('#username').val(),'flag':"checkUser"},
			dataType:"JSON",
			success: function(resp){
				if(resp.success){
					$('#usernamestatus').html("User name Available");	
				}
				else{
					$('#usernamestatus').html("User name already exists");
				}
			}
		});	
	}
}
function checkEmail(){
	if($('#email').val() !== ""){
		$.ajax({
			type:"POST",
			url:"../php/connection.php",
			data: {'email': $('#email').val(),'flag':"checkEmail"},
			dataType:"JSON",
			success: function(resp){
				if(resp.success){
					$('#Emailidstatus').html("Email Id available");	
				}
				else{
					$('#Emailidstatus').html("Email id already exists");
				}
			}
		});		
	}
}
$(document).ready(function(){
	$('#registration').submit(function(e){
		e.preventDefault();
		var email = $("#email").val();
		var Password = $("#password").val();
		var FirstName = $("#FirstName").val();
		var LastName = $("#LastName").val();
		var age = $("#age").val();
		var dob = $("#dob").val();
		var contact = $("#contact").val();
		var userName = $("#username").val();
		var repassword = $("#re-password").val();
		var valdate  = varCheck(email,Password,contact,userName,LastName,FirstName,dob,age,repassword);
		if(typeof valdate === "undefined" ){
			$.ajax({
				type: "POST",
				url: "../php/register.php",
				data: $('#registration').serialize(),
				dataType: "JSON",
				success: function(response) 
				{
					if(response.success){
						location.href = '../index.html';
					}
					else{
						if(response.msg == "session already set"){
							location.href = '../html/login.html';
						}
						else{
                            $(this).prop('disabled',true);						  
							$('#validationmsg').html(response.msg+" Please refresh");
						}
					}
				}
			});
		}
		else{
		  $('#validationmsg').html(valdate);
		}
	});
	$('a#login-link').click(function(e){
		location.href = '../html/login.html';
	});
});