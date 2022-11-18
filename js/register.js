$('#register').click(function (event) { 
    var data={
        user_username:$('#user_username').val(),
        user_email:$('#user_email').val(),
        user_birthday:$('#user_birthday').val(),
        user_address:$('#user_address').val(),
		user_contact:$('#user_contact').val()
    }
	$.ajax({
	
		method:"POST",
		url:"php/register.php",
		data:$('#form').serialize(),
		success: function(msg){
			console.log(msg);
		},
		error: function(message){
			console.log(message);
		}
	});	
	$(location).prop("href","/Guvi/login.html");
});




// $("#register").click (function(){
// 	$.ajax({
// 		method:"POST",
// 		url:"php/register.php",
// 		data:$('#form').serialize(),
// 		success: function(msg){
// 			console.log(msg);
// 		},
// 		error: function(message){
// 			console.log(message);
// 		}
// 	});
// });