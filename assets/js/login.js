$(document).on('submit','#form',function(e){
	e.preventDefault();

	$.ajax({
		url: base_url+'/login',
		method:'POST',
		data:$('#form').serialize(),
		dataType:'JSON',

		beforeSend:function(){
			$('.divLoading').show();
			$('#errorLogin').empty();
		},
		success:function(data){  
			$('.divLoading').hide();
			if(data==1){
				window.location=base_url+'/admin';
			}else if(data==2){
				window.location=base_url+'/egresado';
			}else if(data==3){
				window.location=base_url+'/vacantes/';
			}else if(data==4){
				$('#errorLogin').append('<div class="error-block"> Combinación de nombre de usuario/contraseña incorrecta. Favor intentar de nuevo </div>');
			}else if(data==5){
				$('#errorLogin').append('<div class="error-block"> Esta tratando de introducir un usuario no valido </div>');
			}else if(data==6){
				$('#errorLogin').append('<div class="error-block"> Debe proporcionar su usuario y contraseña para poder acceder </div>');
			}else if(data==7){
				alert("El usuario se encuentra desactivado, comuniquese con el departamento de Egresados para mayor información");
				window.location=base_url+'/logout';
			}
		},
	});
});