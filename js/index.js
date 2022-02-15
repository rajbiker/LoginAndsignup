function setVal(arr){
	$('#fn').html(arr.FirstName);
	$('#ln').html(arr.LastName);
	$('#ei').html(arr.Email);
	$('#mn').html(arr.contact);
	$('#ag').html(arr.Age);
	$('#do').html(arr.Dob);
	$('#un').html(arr.UserName);
	var tempV = arr.FirstName;
    $('#headtext').html(tempV.concat(" "+arr.LastName));
}
function checkUserName(){
	if($('#username').val() !== ""){
		$.ajax({
			type:"POST",
			url:"php/connection.php",
			data: {'userName': $('#UserName').val(),'flag':"checkUser"},
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
$(document).ready(function(){
	$.ajax({
	type: "POST",
	url: "php/session.php",
	data: {},
	dataType: "JSON",
	success: function(response) 
	{
		if(response.success){
			const arr = response.data;
			setVal(arr);
		}
		else{
		   location.href = 'html/login.html';
		}
	}
	});
	$('#update-form').click(function(e){
	    e.preventDefault();
		var email = $('#ei').html();
		var Password = $("#password").val();
		var FirstName = $("#FirstName").val();
		var LastName = $("#LastName").val();
		var age = $("#age").val();
		var dob = $("#dob").val();
		var contact = $("#contact").val();
		var userName = $("#userName").val();
		var repassword = Password;
		var valdate  = varCheck(email,Password,contact,userName,LastName,FirstName,dob,age,repassword);
		if(typeof valdate === "undefined" ){
    		$.ajax({
    			type: "POST",
    			url: "php/index.php",
    			data: $('#profile').serialize(),
    			dataType: "JSON",	
    			success: function(response) 
    			{
    			  if(response.success){
    			    location.reload();
    			    $('#validationmsg').html("User details updated successfully");
    				const arr = response.data;
    				setVal(arr);
    		      }
    			  else{
    				  $('#validationmsg').html(response.msg);
    			  }
    			},
    		});
		}
		{
		     $('#validationmsg').html(valdate);   
		}
	});
	$('#logout-form').click(function(){
		$.ajax({
			type: "POST",
			url: "php/logout.php",
			data: '',
			dataType: "JSON",	
			success: function(response) 
			{
			  if(response.success){
				location.href = 'html/login.html';
			  }
			},
		});
	});
}); 
