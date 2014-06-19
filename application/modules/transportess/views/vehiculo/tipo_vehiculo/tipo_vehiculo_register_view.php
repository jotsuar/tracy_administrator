<form method ="post" id = "form" action="<?php echo base_url()?>transporte/tipo_vehiculo">
	<?php if(isset($ok) && $ok):?>
		<div class="message success">
			<p>Registro realizado correctamente</p>
		</div>
	<?php else:?>
		<div class="message error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>
	<h2>Registro de tipo vehículo</h2>

	<label for="tipo_vehiculo">Tipo vehículo *</label>
	<input type="text" name="tipo_vehiculo" id="tipo_vehiculo" 
	value="<?php echo (isset($ok) && $ok) ? '' : set_value('tipo_vehiculo')?>"/>

	<label for="descripcion">Descripción</label>
	<textarea rows="7" cols="30" name="descripcion" id="descripcion"></textarea>	

	<div class="group_button">
		<button type="button" class="data btn" data-link="<?php echo base_url()?>transporte/consultar_tipo_vehiculo">
			<span class = "glyphicon glyphicon-list-alt"></span> Consultar
		</button>
		<button type="submit" class = "btn">
			<span class = "glyphicon glyphicon-floppy-disk"></span> Guardar
		</button>
	</div>
</form>