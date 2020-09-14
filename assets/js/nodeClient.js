socket.on( 'message', function( data ) {
	$("#"+data.message ).html( data.name );
	var $row = $("#"+data.message).closest("tr");

	if ($row.find("span.cupo").text() == data.name) {
		$row.addClass('class-full');
	}else{
		$row.removeClass('class-full');
	}
});

function awesome(){
	$('.seleccion:checkbox').change(function(){
		var creditos = 0;

		$(':checkbox:checked').each(function() {
			creditos += parseInt(this.value);
		});

		$("#creditos").html(creditos);

	}).trigger('change');
	//llamar los input
	var inputs = $('tbody').find('input');
	//alm name de input 
	var arr = [];

	//viajar por cada input
	for (var i = inputs.length - 1; i >= 0; i--) {
		if (inputs[i].checked == true){
			$("input[name='"+inputs[i].name+"']").prop("disabled", true);
            
            var $row = $("input[name='"+inputs[i].name+"']").closest("tr");
            $row.addClass("row-disabled");

            var $row = $("#"+inputs[i].id).closest("tr");
            $row.removeClass("row-disabled");

			$("#"+inputs[i].id).prop("disabled", false);
		}
	}
}
awesome();

$('#form :checkbox').click(function() { 
	var $this = $(this);
	var $row = $this.closest("tr");
	var $tds = $row.find("span.inscritos"); 

	var IDgrupo = $this.attr('id');
	var name = $this.attr('name');
	var idMateria = $this.data('code');
	var correquisito = $this.attr('correquisito');

	if ($this.is(':checked')) { 
        // the checkbox was checked 
        if (correquisito) {
            $this.prop('checked',false);
        	$('#contenedor').empty();
        	$.ajax({
        		url: "./Main/seleccionarCorrequisito",
        		type: "POST",
        		dataType: "json",
        		data: {IDgrupo: IDgrupo, idMateria: idMateria},
        		success:function(data){ 	
        			$('#MateriaCo').val(IDgrupo);	
        			$('#contenedor').html(data);
        			$('#modalCo').modal({show:true});
        		}
        	});
        }
        else{
        	$.ajax({
        		url: "./inscripcion",
        		type: "POST",
        		dataType: "json",
        		data: {IDgrupo: IDgrupo},
        		success: function(data) {
        			if (data[0]['Insertado'] == 'TRUE') {

        				$("input[name='"+name+"']").prop("disabled", true);
        				$this.prop("disabled", false);
        				$row.addClass('class-selected');

                        $row = $("input[name='"+name+"']").closest("tr");
                        $row.addClass("row-disabled");

                        $row = $this.closest("tr");
                        $row.removeClass("row-disabled");
        				
        				Swal.fire({
        					type: 'success',
        					title: 'Materia inscrita satisfactoriamente',
        					showConfirmButton: false,
        					timer: 1500
        				});
        				
        				socket.emit('message', { 
        					name: data[0]['CantidadInscritos'], 
        					message: $tds.attr('id') 
        				});
        			}
        			else{
        				if (data[0].DescripcionChoque) {
        					Swal.fire({
        						type: 'warning',
        						title: data[0].Mensaje,
        						html: data[0].DescripcionChoque,
        						showConfirmButton: true,
        						timer: 5000
        					});
        				}
        				else{
        					Swal.fire({
        						type: 'error',
        						title: data[0].Mensaje,
        						showConfirmButton: false,
        						timer: 1500
        					});
        				}
                        $this.prop('checked',false);
        			}
        		}
        	});
        }
    } 
    else {
        // the checkbox was unchecked
        if (correquisito) {
        	$.ajax({
        		url: "./Main/inscripcionCorrequisito",
        		type: "POST",
        		dataType: "json",
        		data: {IDgrupo: IDgrupo},
        		success: function(data) {
        			if (data['data'][0]['Insertado'] == 'TRUE') {
        				
        				ids = data['data'][0]['IDgrupos'].split(",");
        				inscritos = data['data'][0]['CantidadUsuarios'].split(",");

        				Swal.fire({
        					type: 'success',
        					title: 'Materias con co-requisitos eliminadas satisfactoriamente',
        					showConfirmButton: false,
        					timer: 1500
        				});

        				$.each(ids, function(i,id){
        					$("#"+id).prop( "checked", false );
        					
                            $("input[name='"+$("#"+id).attr('name')+"']").prop("disabled", false);
                            
                            $("input[name='"+$("#"+id).attr('name')+"']").closest("tr").removeClass("row-disabled");
        					
                            var $row = $("#"+id).closest("tr");
        					var $tds = $row.find("span.inscritos"); 
        					$row.removeClass('class-selected');

        					socket.emit('message', { 
        						name: inscritos[i], 
        						message:  $tds.attr('id')
        					});
        				});

        				$('.seleccion:checkbox').change(function(){
        					var creditos = 0;
        					$('.seleccion:checkbox:checked').each(function() {
        						creditos += parseInt(this.value);
        					});

        					$("#creditos").html(creditos);
        				}).trigger('change');
        			}
        			else{
        				Swal.fire({
        					type: 'error',
        					title: data['data'][0].Mensaje,
        					showConfirmButton: false,
        					timer: 1500
        				});

        				$("input[name='"+$this.attr('name')+"']").prop("disabled", true);
                        $( "#"+$this.attr('id')).prop( "checked", true );
                        $( "#"+$this.attr('id')).prop( "disabled", false );
        			}
        		}
        	});
        }
        else{
        	$.ajax({
        		url: "./inscripcion",
        		type: "POST",
        		dataType: "json",
        		data: {IDgrupo: IDgrupo},
        		success: function(data) {
        			if (data[0]['Insertado'] == 'TRUE') {
        				$("input[name='"+$this.attr('name')+"']").prop("disabled", false);

                        $("input[name='"+$this.attr('name')+"']").closest("tr").removeClass("row-disabled");

                        $row.removeClass("class-selected");

        				socket.emit('message', { 
        					name: data[0]['CantidadInscritos'], 
        					message: $tds.attr('id') 
        				});

        				Swal.fire({
        					type: 'success',
        					title: 'Materia eliminada satisfactoriamente',
        					showConfirmButton: false,
        					timer: 1500
        				});
        			}

        			else{
        				Swal.fire({
        					type: 'error',
        					title: data[0].Mensaje,
        					showConfirmButton: false,
        					timer: 1500
        				});

        				$this.prop('checked',true);
        				$("input[name='"+$this.attr('name')+"']").prop("disabled", false);
        			}
        		}
        	});
        }
    }
});

$(document).on('click', '#formCo :checkbox', function(){
	var $this = $(this);
	var name = $this.attr('nombre');

    var code = [];
    var count = [];
    $("#formCo :checkbox").each(function(){
        var c = $(this).attr("nombre");    
        if(code.indexOf(c) >= 0){
            count[code.indexOf(c)] += 1;
        }
        else{
            code.push(c);
            count.push(1);
        }
    });

	if ($this.is(':checked')) {
		$("input[nombre='"+name+"']").prop("disabled", true);
        $("input[nombre='"+name+"']").closest("tr").addClass("row-disabled");
		
        $this.prop("disabled", false);
        $this.closest("tr").removeClass("row-disabled");
	}
	else{
		$("input[nombre='"+name+"']").prop("disabled", false);
        $("input[nombre='"+name+"']").closest("tr").removeClass("row-disabled");
	}

    if($("#formCo input[type='checkbox']:checked").length == code.length){
        $('#btnCo').prop('disabled', false);
    }
    else{
        $('#btnCo').prop('disabled', true);
    }  
});

$("#btnCo").on('click',function(){
	$.ajax({
		url: "./Main/inscripcionCorrequisito",
		type: "POST",
		dataType: "json",
		data: $("#formCo").serialize(),
		success:function(data){ 
			if (data['data'][0]['Insertado'] == 'TRUE'){

				$.each(data['data'], function(i,v){
					$("input[name='"+$( "#"+data['idCorrequisitos'][i]).attr('name')+"']").prop("disabled", true);

                    $("input[name='"+$( "#"+data['idCorrequisitos'][i]).attr('name')+"']").closest("tr").addClass("row-disabled");

                    $( "#"+data['idCorrequisitos'][i]).prop( "checked", true );
					$( "#"+data['idCorrequisitos'][i]).prop( "disabled", false );

					$row = $("#"+data['idCorrequisitos'][i]).closest("tr");
					$tds = $row.find("span.inscritos"); 
					$row.addClass('class-selected');
                    $row.removeClass('row-disabled');

					socket.emit('message', { 
						name: v.CantidadInscritos, 
						message:  $tds.attr('id')
					});
				});

				Swal.fire({
					type: 'success',
					title: 'Materias con co-requisitos inscritas satisfactoriamente',
					showConfirmButton: false,
					timer: 1500
				});

				$('#modalCo').modal('toggle');

				$('.seleccion:checkbox').change(function(){
					var creditos = 0;

					$('.seleccion:checkbox:checked').each(function() {
						creditos += parseInt(this.value);
					});

					$("#creditos").html(creditos);

				}).trigger('change');
			}
			else{
				if (data['data'][0].DescripcionChoque) {
					Swal.fire({
						type: 'warning',
						title: data['data'][0].Mensaje,
						html: data['data'][0].DescripcionChoque,
						showConfirmButton: true,
						timer: 5000
					});

					$.each(data['idCorrequisitos'], function(i,v){
						$( "#"+v).prop( "checked", false );
					});
				}else if(data['data'][0]['Insertado'] == 'FALSE'){
                    Swal.fire({
                        type: 'warning',
                        title: data['data'][0].Mensaje,
                       // html: data['data'][0].DescripcionChoque,
                        showConfirmButton: true,
                        timer: 5000
                    });
                }
			}
		}
	});
});


jQuery.ajaxSetup({
	beforeSend: function() {
		$('#logo').css('display', 'block');
        $(".overlay").css({
            "position": "absolute", 
            "width": $(document).width(), 
            "height": $(document).height(),
            "z-index": 99999, 
        }).fadeTo(0, 0.8);
	},
	complete: function(){
		$('#logo').css('display', 'none');
        $('.overlay').css('display', 'none');
	},
	success: function() {}
});