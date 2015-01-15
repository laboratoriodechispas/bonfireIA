/**
 * Created by Spark on 06/01/2015.
 */

$(document).ready(function() {
	var max_fields      = 20; //maximum input boxes allowed
	var wrapper         = $(".fields_content"); //Fields wrapper
	var add_button      = $("#add_field_btn"); //Add button ID
	var type_answer     = $(".type_answer");
	var x               = 0; //initlal text box count
	var max_answers     = 10;
	var y               = 1;
	var respuesta_tipo;
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		$(this).attr('disabled','disabled');
		if(x < max_fields){ //max input box allowed
			x++; //text box increment


			var type = type_question();
			$(wrapper).append('<div>Pregunta <input type="text" name="pregunta[]"/><a href="#" class="remove_field">Remove</a>'+type+'</div>'); //add input box
			$('.limit').remove();
		}else{
			$(wrapper).append('<div class="limit">No se pueden poner mas de 20 preguntas</div>'); //add input box
		}

	});
	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		$('.limit').remove();
		e.preventDefault(); $(this).parent('div').remove(); x--;
		$(add_button).removeAttr("disabled");
		$(".add_answer").parent().remove();
	});
	$(wrapper).on("click",".remove_respuesta", function(e){ //user click on remove text
		y--;
		$('.limit').remove();
		e.preventDefault();
		$(this).parent('div').remove();
		$(add_button).removeAttr("disabled");
	});


	var radio   = 1;
	var select  = 1;
	var check   = 1;

	$(wrapper).on("change",".type_answer",function(){ //on add input button click

		var val = $(this).val();

		switch (val){

			case "radio":
				$(this).parent('div').append('<div>Respuesta <input type="text" name="respuesta-radio-'+radio+'[]"/><input type="text" name="tipo[]" value="'+val+'"/></div>'); //add input box
				$(wrapper).append('<div><input type="button" class="add_answer" value="Añadir respuesta"/><a href="#" class="end_answers">Terminar respuestas</a></div></div>'); //add input box
				respuesta_tipo = 'respuesta-radio-'+radio+'[]';

				radio++;
				break;
			case "select":
				$(this).parent('div').append('<div>Respuesta <input type="text" name="respuesta-select-'+select+'[]"/><input type="text" name="tipo[]" value="'+val+'"/></div>'); //add input box
				$(wrapper).append('<div><input type="button" class="add_answer" value="Añadir respuesta"/><a href="#" class="end_answers">Terminar respuestas</a></div></div>'); //add input box
				respuesta_tipo = 'respuesta-select-'+select+'[]';

				select++;
				break;
			case "check":
				$(this).parent('div').append('<div>Respuesta <input type="text" name="respuesta-check-'+check+'[]"/><input type="text" name="tipo[]" value="'+val+'"/></div>'); //add input box
				$(wrapper).append('<div><input type="button" class="add_answer" value="Añadir respuesta"/><a href="#" class="end_answers">Terminar respuestas</a></div></div>'); //add input box
				respuesta_tipo = 'respuesta-check-'+check+'[]';

				check++;
				break;
			case "open":
				$(add_button).removeAttr("disabled");
				$(this).parent('div').append('<div><input type="text" name="tipo[]" value="'+val+'"/></div>'); //add input box
				$(wrapper).append('<div class="limit">Añade otra pregunta</div>'); //add input box

				break;
		}
		$(this).remove();
	});


	$(wrapper).on("click",".end_answers", function(e){ //user click on remove text
		$('.limit').remove();
		$(add_button).removeAttr("disabled");
		e.preventDefault(); $(this).parent('div').remove();
	});

	$(wrapper).on("click",".add_answer", function(e){ //user click on remove text
		e.preventDefault();

		if(y < max_answers){ //max input box allowed
			y++; //text box increment
			 $(this).parent('div').remove();
			$(wrapper).append('<div>Respuesta <input type="text" name="'+respuesta_tipo+'"/><a href="#" class="remove_respuesta">Remove</a></div>'); //add input box
			$(wrapper).append('<div><input type="button" class="add_answer" value="Añadir respuesta"/><a href="#" class="end_answers">Terminar respuestas</a></div>'); //add input box
		}else{
			$(wrapper).append('<div class="limit">No se pueden poner mas de 10 respuestas</div>'); //add input box
		}
	});
});



function type_question(){
	var options = '<option value="-" selected>--selecciona el tipo de respuesta--</option>';
	options += '<option value="radio">Radio</option>';
	options += '<option value="select">Lista desplegable</option>';
	options += '<option value="check">Multiple</option>';
	options += '<option value="open">Abierta</option>';
	var str = '<select name="tipo[]" class="type_answer">'+options+' </select>';
	return str;
}


/// ==== ===== ===== ====  Para las reglas del evento
function add_rule()
{
	var reglas = {};
		reglas["rama"]= 			$("#rama");
		reglas["edad_min"]= 	$("#edad_min");
		reglas["edad_max"]= 	$("#edad_max");
		reglas["categoria"]= 	$("#categoria");
		reglas["distancia"]= 	$("#distancia");
		reglas["costo"]= 			$("#costo");
		var validacion = true;
		$.each(reglas, function(a, b){
			if(b.val() == '' || b.val() == undefined)
			{
				alert("Proporcione las reglas para " + a.toUpperCase());
				validacion = false;
			}
		});
		if(validacion == false) return false;
		var id = Math.floor( Math.random() * ( 1 + 10000 - 1 ) ) + 1;
		var $html="<tr class='regla_aplicada' id='"+id+"'>";
		var cont = 0;

		$.each(reglas, function(a, b){
			$html += '<td><input type="text" id="'+a+'-'+id+'" name="'+a+'[]" style="width: 90px" value="'+b.val()+'"></td>';
			cont++;
		});
		$html += '<td><input type="button" id="btnRemove" name="btnRemove" value="Quitar" onClick="javascript:remove_rule(this, '+id+');"></td>';
		$html += "</tr>";
		// console.log($html);
		$("#reglas").append($html);

		$("#rama").val('');
		$("#edad_min").val('');
		$("#edad_max").val('');
		$("#categoria").val('');
		$("#distancia").val('');
		$("#costo").val('');

}

function remove_rule(btn, id)
{
	$('#'+id).remove();
}

function fake_save()
{
	console.log($(".form-horizontal").serialize());
	return false;
}
