<form method ="post" id="form" action="<?php echo base_url()."contacto/registro_contacto/".$tipo_empresa?>">
	<?php if(isset($ok) && $ok):?>
		<div class = "message success">
			<p>Registro realizado correctamente</p>
		</div>
	<?php else:?>
		<div class="message error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>
	<h2>Registro de contacto</h2>
	
	<label for="evento">Nombre <?php echo $empresa ?> *</label>

	<select name="id_empresa" id="evento">
	<?php foreach ($combo as $value):?>
		<option value="<?php echo $value->id ?>">
	 		<?php echo $value->nombre ?> 
		</option>
	<?php endforeach;?>
	</select>

	<label for="identificacion">Identificación *</label>
	<input type="text" name="identificacion" id ="identificacion_contacto">

	<label for="nombres">Nombre *</label>
	<input type="text" name="nombres" id="nombre_contacto">

	<label for="apellidos">Apellido *</label>
	<input type="text" name="apellidos" id="apellido_contacto">

	<label for="celular">Celular *</label>
	<input type="text" name="celular" id="cel_contacto">

	<label for="email">Email *</label>
	<input type="text" name="email" id="email_contacto">		

	<div class="group_button">
		<button type="button" class="data btn" data-link="<?php echo base_url()."contacto/consultar_contacto/" . $tipo_empresa?>">
			<span class = "glyphicon glyphicon-list-alt"></span> Consultar
		</button>
		<button class = "btn" type = "submit" name = "btn_save">
			<span class = "glyphicon glyphicon-floppy-disk"></span> Guardar
		</button>
	</div>

</form>