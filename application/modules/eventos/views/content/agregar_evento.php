<div class="admin-box" xmlns="http://www.w3.org/1999/html">

	<?php echo form_open(current_url(), 'class="form-horizontal"'); ?>

	<div class="control-group <?php if (form_error('nombre_evento')) echo 'error'; ?>">
		<label for="title">Nombre</label>
		<div class="controls">
			<input type="text" name="nombre_evento" class="input-xlarge" value="<?php echo isset($post) ? $post->nombre_evento : set_value('nombre_evento'); ?>" />
			<?php if (form_error('nombre_evento')) echo '<span class="help-inline">'. form_error('nombre_evento') .'</span>'; ?>
		</div>
	</div>

	<div class="control-group <?php if (form_error('fecha')) echo 'error'; ?>">
		<label for="fecha">Fecha</label>
		<div class="controls">
			<input type="text" name="fecha" class="input-xlarge" value="<?php echo isset($post) ? $post->fecha : set_value('fecha'); ?>" />
			<?php if (form_error('fecha')) echo '<span class="help-inline">'. form_error('fecha') .'</span>'; ?>
		</div>
	</div>


	<div class="control-group <?php if (form_error('img_thumb')) echo 'error'; ?>">
		<label for="img_thumb">Imagen miniatura</label>
		<div class="controls">
			<input type="text" name="img_thumb" class="input-xlarge" value="<?php echo isset($post) ? $post->img_thumb : set_value('img_thumb'); ?>" />
			<?php if (form_error('img_thumb')) echo '<span class="help-inline">'. form_error('img_thumb') .'</span>'; ?>
		</div>
	</div>

	<div class="control-group <?php if (form_error('img_destacada')) echo 'error'; ?>">
		<label for="img_destacada">Imagen destacada</label>
		<div class="controls">
			<input type="text" name="img_destacada" class="input-xlarge" value="<?php echo isset($post) ? $post->img_destacada : set_value('img_destacada'); ?>" />
			<?php if (form_error('img_destacada')) echo '<span class="help-inline">'. form_error('img_destacada') .'</span>'; ?>
		</div>
	</div>

	<div class="control-group <?php if (form_error('descripcion')) echo 'error'; ?>">
		<label for="descripcion">Descripcion</label>
		<div class="controls">

				<input type="text" name="descripcion" class="input-xlarge" value="<?php echo isset($post) ? $post->descripcion : set_value('descripcion'); ?>" />

			<?php if (form_error('descripcion')) echo '<span class="help-inline">'. form_error('descripcion') .'</span>'; ?>
			<p class="help-block">Una breve descripcion del evento, no confundir con convocatoria</p>
		</div>
	</div>


	<div id="main-slider" >

		<?php

		foreach ($convocatorias['data'] as $key):
			$titulo    = strtolower ($key->titulo);

		?>


		<label for="<?php echo $key->slug; ?>" class="title" ></label>
			<div>
				<label for="<?php echo $key->slug; ?>" class="title" ><?php echo ucfirst($titulo); ?></label>

			<textarea name="<?php echo $key->slug; ?>" class="input-xxlarge" rows="15"><?php echo isset($key->contenido) ? $key->contenido : '' ?></textarea>
			<input type="hidden" name="id-<?php echo $key->slug; ?>" value="<?php echo $key->id; ?>">


			</div>
<?php endforeach; ?>


</div>


	<div class="control-group <?php if (form_error('tipo_evento')) echo 'error'; ?>">
		<label for="tipo_evento">Tipo de evento</label>
		<div class="controls">
			<?php $select = isset($post) ? $post->tipo_evento : "null"; ?>

			<select name="tipo_evento" class="input-xlarge"  />

			<?php  foreach($tipo_evento['data'] as $key): ?>

				<?php   if($select == $key->id): ?>

					<option value="<?php echo $key->id; ?>" selected="selected">
					<?php else: ?>
					<option value="<?php echo $key->id; ?>">
				<?php endif; ?>

				  <?php echo $key->tipo; ?>
				</option>

			<?php endforeach; ?>
				</select>

			<?php if (form_error('tipo_evento')) echo '<span class="help-inline">'. form_error('tipo_evento') .'</span>'; ?>
		</div>
	</div>

	<div class="control-group">
		<label for="img_destacada">Preguntas a los deportistas</label>
		<p class="help-block">Preguntas que se haran en la convocatoria a la hora de que un usuario se registre ej. ¿que marca de tenis llevaras a la carrera?</p>
		<div class="controls">
			<input type="button" value="Agregar preguntas" id="add_field_btn" class="btn-warning"/>

			<div class="fields_content">

			</div>
		</div>
	</div>

	<div class="control-group">

		<div class="col-lg-12 well">

			<h2>Restricciones</h2>
			<table id="restricciones">
				<thead>
					<tr>
						<td>Rama</td>
						<td>Edad Mínima</td>
						<td>Edad Máxima</td>
						<td>Categoría</td>
						<td>Distancia</td>
						<td>Costo</td>
						<td>Opciones</td>
					</tr>
					<tr>
						<td><input type="text" id="rama" name="rama" style="width: 90px;"></td>
						<td><input type="text" id="edad_min" name="edad_min" style="width: 90px;"></td>
						<td><input type="text" id="edad_max" name="edad_max"  style="width: 90px;"></td>
						<td><input type="text" id="categoria" name="categoria"  style="width: 90px;"></td>
						<td><input type="text" id="distancia" name="distancia" style="width: 90px;"></td>
						<td><input type="text" id="costo" name="costo" style="width: 90px"></td>
						<td><input type="button" id="btnAdd" name="btnAdd" value="Agregar" onClick="javascript:add_rule();"></td>
					</tr>
				</thead>
				<tbody id="reglas">
				</tbody>
				<tfoot>
				</tfoot>
			</table>
		</div>
	</div>

<button onClick="javascript:fake_save();" value="aslkjaslkdjalskjd"> fake save</button>
	<div class="form-actions">
		<input type="submit"  class="btn btn-primary" value="Guardar Evento" />
		o <a href="<?php echo site_url('/eventos') ?>">Cancelar</a>
	</div>

	<?php echo form_close(); ?>
</div>
<script type="text/javascript" id="llenar_reglas">
// function add_rule()
// {
// 	var reglas = {};
// 		reglas["rama"]= 			$("#rama");
// 		reglas["edad_min"]= 	$("#edad_min");
// 		reglas["edad_max"]= 	$("#edad_max");
// 		reglas["categoria"]= 	$("#categoria");
// 		reglas["distancia"]= 	$("#distancia");
// 		reglas["costo"]= 			$("#costo");
// 		var validacion = true;
// 		$.each(reglas, function(a, b){
// 			if(b.val() == '' || b.val() == undefined)
// 			{
// 				alert("Proporcione las reglas para " + a.toUpperCase());
// 				validacion = false;
// 			}
// 		});
// 		if(validacion == false) return false;
// 		var id = Math.floor( Math.random() * ( 1 + 10000 - 1 ) ) + 1;
// 		var $html="<tr class='regla_aplicada' id='"+id+"'>";
// 		var cont = 0;

// 		$.each(reglas, function(a, b){
// 			$html += '<td><input type="text" id="'+a+'-'+id+'" name="'+a+'[]" style="width: 90px" value="'+b.val()+'"></td>';
// 			cont++;
// 		});
// 		$html += '<td><input type="button" id="btnRemove" name="btnRemove" value="Quitar" onClick="javascript:remove_rule(this, '+id+');"></td>';
// 		$html += "</tr>";
// 		// console.log($html);
// 		$("#reglas").append($html);

// 		$("#rama").val('');
// 		$("#edad_min").val('');
// 		$("#edad_max").val('');
// 		$("#categoria").val('');
// 		$("#distancia").val('');
// 		$("#costo").val('');

// }

// function remove_rule(btn, id)
// {
// 	$('#'+id).remove();
// }

// function fake_save()
// {
// 	console.log($(".form-horizontal").serialize());
// 	return false;
// }

</script>