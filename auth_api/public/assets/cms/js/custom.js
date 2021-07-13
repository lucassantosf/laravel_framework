$(document).ready(function(){
	//Masks
	$('.iptdate').mask('00/00/0000'); //Data
	
	$('.iptcep').mask('00000-000'); //CEP

	$('.iptphoneddd').focusout(function(){ //Telefone com DDD
	    var phone, element;
	    element = $(this);
	    element.unmask();
	    phone = element.val().replace(/\D/g, '');
	    if(phone.length > 10) {
	        element.mask("(00) 00000-0000");
	    } else {
	        element.mask("(00) 0000-00009");
	    }
	}).trigger('focusout');

	$('.iptphone').focusout(function(){ //Telefone sem DDD
	    var phone, element;
	    element = $(this);
	    element.unmask();
	    phone = element.val().replace(/\D/g, '');
	    if(phone.length > 10) {
	        element.mask("00000-0000");
	    } else {
	        element.mask("00000-0009");
	    }
	}).trigger('focusout');
});