<form method ="post" action="<?php echo base_url()?>contacto/registro_contacto_evento">
	<?php if(isset($ok) && $ok):?>
		<div class="ok">
			<p>Registro realizado corrrectamente</p>
		</div>
	<?php else:?>
		<div class="data_error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>
	<h2>Registro de contacto</h2>
	
	<label for="evento">Nombre eventos *</label>

	<select name="evento" id="evento">
	<?php foreach ($combo as $value):?>
	<option value="<?php echo $value->id ?>"> <?php echo $value->nombre ?> </option>
	<?php endforeach;?>
	</select>

	<label for="identificacion_contacto">Identificación *</label>
	<input type="text" name="identificacion_contacto" id ="identificacion_contacto">

	<label for="nombre_contacto">Nombre *</label>
	<input type="text" name="nombre_contacto" id="nombre_contacto">

	<label for="apellido_contacto">Apellido *</label>
	<input type="text" name="apellido_contacto" id="apellido_contacto">

	<label for="cel_contacto">Celular *</label>
	<input type="text" name="cel_contacto" id="cel_contacto">

	<label for="email_contacto">Email *</label>
	<input type="text" name="email_contacto" id="email_contacto">		

	<div class="groupButton">
		<button type="button" class="consultar" data-link="<?php echo base_url()?>contacto/consultar_contacto"><span></span>Consultar</button>
		<button type="submit"><span></span>Guardar</button>
	</div>

</form>