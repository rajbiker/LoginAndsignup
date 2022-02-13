$(document).ready(function(){
	$.ajax({
			type: "POST",
			url: "../php/session.php",
			data: {},
			dataType: "JSON",
			success: function(response) 
			{
				if(response.success){
					location.href = '../index.html';
				}
			}
		});
});