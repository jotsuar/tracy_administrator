<form method = "post" id = "form" action = "<?php echo base_url()?>transport_company/registrar">
	<?php if(isset($ok) && $ok):?>
		<div class = "message success">
			<p>Registro realizado correctamente</p>
		</div>
	<?php else:?>
		<div class = "message error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>
	<h2>Registro de transporte</h2>

	<label for = "nit">NIT *</label>
	<input type = "text" name = "nit" id = "nit" 
	value = "<?php echo (isset($ok) && $ok) ? '' : set_value('nit')?>"/>

	<label for = "nombre">Nombre *</label>
	<input type = "text" name = "nombre" id = "nombre" 
	value = "<?php echo (isset($ok) && $ok) ? '' : set_value('nombre')?>"/>

	<label for = "direccion">Dirección *</label>
	<input type = "text" name = "direccion" id = "direccion" 
	value = "<?php echo (isset($ok) && $ok) ? '' : set_value('direccion')?>"/>

	<label for = "telefono">Teléfono *</label>
	<input type = "text" name = "telefono" id = "telefono" 
	value = "<?php echo (isset($ok) && $ok) ? '' : set_value('telefono')?>"/>

	<label for = "correo">Correo *</label>
	<input type = "text" name = "correo" id = "correo"
	value = "<?php echo (isset($ok) && $ok) ? '' : set_value('correo')?>"/>

	<label for = "seguro_transporte">Seguro transporte *</label>
	<select name = "seguro_transporte" id = "seguro_transporte">
		<option value = "1">SI</option>
		<option value = "0">NO</option>
	</select>

	<div class = "group_button">
		<button type = "button" class = "data btn" data-link = "<?php echo base_url()?>transport_company/consultar">
			<span class = "glyphicon glyphicon-list-alt"></span> Consultar
		</button>
		<button type = "submit" class = "btn">
			<span class = "glyphicon glyphicon-floppy-disk"></span> Guardar
		</button>
	</div>
</form>