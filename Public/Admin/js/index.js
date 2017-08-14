// JavaScript Document

$('.exitDialog input[type=button]').click(function(e){
	$('.exitDialog').Dialog('close');
	if($(this).hasClass('ok')){
		window.location.href = "/index.php/Admin/Login/logout";
	}
});