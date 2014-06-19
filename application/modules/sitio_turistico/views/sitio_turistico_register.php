<form class="frm" method ="post" id = "form" action="<?php echo base_url()?>sitio_turistico/register">
	<?php if(isset($success) && $success):?>
		<div class = "message success">
			<p>Registro realizado correctamente</p>
		</div>
	<?php else:?>
		<div class="message error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>
	<h2>Registro de sitios turísticos</h2>

	<label for="nombre">Nombre *</label>
	<input type="text" name="nombre" id="nombre" 
	value = "<?php echo (isset($success) && $success) ? '' : set_value('nombre')?>" />

	<label for="ubicacion">Ubicación *</label>
	<input type="text" name="ubicacion" id="ubicacion" 
	value="<?php echo (isset($success) && $success) ? '' : set_value('ubicacion')?>" />

	<label for="descripcion">Descripción</label>
	<textarea name="descripcion" id="descripcion" rows="5" cols="30" value="">
		<?php echo (isset($success) && $success) ? '':set_value('descripcion')?>
	</textarea>

	<label for="tipo_turismo">Tipo de turismo *</label>
	<select name="tipo_turismo" id ="tipo_turismo">
		<?php foreach($tipos_turismos as $tipo_turismo):?>
			<option value="<?php echo $tipo_turismo->id?>">
				<?php echo $tipo_turismo->nombre?>
			</option>
		<?php endforeach;?>
	</select>

	<label for="convenio">Convenio *</label>
	<select name="convenio" id ="convenio">
		<option value="1">SI</option>
		<option value="0">NO</option>
	</select>

	<fieldset>
		<legend>Servicios adicionales</legend>
		<?php for($i = 0; $i < count($additional_services); $i++):?>
			<label for="<?php echo str_replace(' ', '_', strtolower($additional_services[$i]['nombre']))?>">
				<input type="checkbox" 
				name="<?php echo strtolower("check_".str_replace(' ', '_', $additional_services[$i]['nombre']))?>" 
				id="<?php echo str_replace(' ', '_', strtolower($additional_services[$i]['nombre']))?>" value="<?php echo $additional_services[$i]['id']?>"/>
				<?php echo ucwords(strtolower($additional_services[$i]['nombre']))?>
			</label>
		<?php endfor;?>
	</fieldset>

	<div class = "group_button">
		<button type="button" class="data btn" data-link="<?php echo base_url()?>sitio_turistico/lista">
			<span class = "glyphicon glyphicon-list-alt"></span> Consultar
		</button>
		<button class = "btn" type = "submit" name = "btn_save">
			<span class = "glyphicon glyphicon-floppy-disk"></span> Guardar
		</button>
	</div>
</form>