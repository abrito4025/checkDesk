var botonPago = {
   crear: function({
     configuracionBoton = {
    		 contenedor:"",
    		 titulo:""
     },
     ambiente = 'produccion',
     medioPago = 'PagoEnLinea',
     idAutorizacionPortal = '',
     opcionesVentana = {
         windowoption : 'location=yes',
         target : '_self'
    },
    cliente = {
    		 urlRetorno:"",
    		 numeroAutorizacion : "",
    		 data:{}
     },
     debug = false,
     error = function(mensajeError) {}
   } = {}) {

	 cliente = cliente || {};
	 var numeroAutorizacion;

	 const windowoption = opcionesVentana.windowoption;
	 const target = opcionesVentana.target;

	 var urlBase = getUrlAmbiente(ambiente);
	 const urlRetorno = cliente.urlRetorno;
	 const data = cliente.data;


	 configuracionBoton = configuracionBoton || {};

     const titulo = configuracionBoton.titulo;
     const contenedor = configuracionBoton.contenedor;

     if(idAutorizacionPortal==null || idAutorizacionPortal===''){
    	 idAutorizacionPortal = getUuid();
     }

     if(cliente.numeroAutorizacion === undefined){
    	 numeroAutorizacion = "";
     }else {
    	 numeroAutorizacion = cliente.numeroAutorizacion;
     }

    try {

     var btnPagoInterno = {
       iniciar: function() {
         this.crearBoton();
         this.agregarEvento();
       },

       crearBoton: function() {
         var r = $('<input type="button" class="btn-pago btn-form"  value="' + titulo + '"/>');
         $(contenedor).append(r);
       },
       agregarEvento: function() {
           $(".btn-pago").bind("click", function(event){

 								event.preventDefault();

 							    var parametros =   {  codigoCentroRecaudacion : getCampoValor(data.codigoCentroRecaudacion),
 									  			  	  codigoServicio: getSelectValor(data.codigoServicio),
 									  			      montoServicio: getCampoValor(data.montoServicio),
 									  			      urlRetorno: urlRetorno,
 									  			      nombre: getCampoValor(data.nombre),
 									 	              numeroDocumento: getCampoValor(data.numeroDocumento),
 									 	              tipoDocumento: getSelectValor(data.tipoDocumento),
 									 	              medioPago: medioPago,
 									 	              idAutorizacionPortal: idAutorizacionPortal,
 									 	              numeroAutorizacion : numeroAutorizacion
 									  			    };

 							    if(debug){
 							    	mostrarValoresDebug(parametros);
 							    }

 							    invocarUrlPost(urlBase, windowoption, target, parametros);

 							});
       }

     };

     btnPagoInterno.iniciar();
  } catch(err) {
	      error(err);
  }
 }
};

function invocarUrlPost(urlBase, windowoption, target, data) {
	 var url = urlBase + '/pasarela-pago/transaccion';

    openWindowWithPost(url, windowoption, target, data);
}

function getCampoValor(selector){
	  return $('input[name="'+selector+'"]').val();
}

function mostrarValoresDebug(parametros){
	   console.log('codigoCentroRecaudacion: ' + parametros.codigoCentroRecaudacion);
		console.log('codigoServicio: ' + parametros.codigoServicio);
		console.log('numeroDocumento: ' + parametros.numeroDocumento);
		console.log('tipoDocumento: ' + parametros.tipoDocumento);


		console.log('nombre: ' + parametros.nombre);
		console.log('urlRetorno: ' + parametros.urlRetorno);
		console.log('medioPago: ' + parametros.medioPago);

		console.log('idAutorizacionPortal: ' + parametros.idAutorizacionPortal);
		console.log('numeroAutorizacion: ' + parametros.numeroAutorizacion);
}

function getSelectValor(selector){
	  return $('select#'+selector).val();
}

function getUuid(){
	return Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
}


function openWindowWithPost(url, windowoption, name, params) {
	   var form = document.createElement("form");
	   form.setAttribute("method", "post");
	   form.setAttribute("action", url);
	   form.setAttribute("target", name);

	   for (var i in params) {
	     if (params.hasOwnProperty(i)) {
	       var input = document.createElement('input');
	       input.type = 'hidden';
	       input.name = i;
	       input.value = params[i];
	       form.appendChild(input);
	     }
	   }

	   document.body.appendChild(form);

	   window.open(url, name, windowoption);

	   form.submit();

	   document.body.removeChild(form);
 };

 function getUrlAmbiente(ambiente){
		const urlDesarrollo = 'https://prw-psp-1.hacienda.gob.do';
		const urlProduccion = 'https://prw-psp-1.hacienda.gob.do';

		if(ambiente==='desarrollo'){
		    	url =  urlDesarrollo;
		}

		if(ambiente==='produccion'){
		   url =  urlProduccion;
		}

		return url;
}