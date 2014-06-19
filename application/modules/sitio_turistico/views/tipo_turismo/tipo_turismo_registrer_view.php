<form method ="post" id ="form" action="<?php echo base_url()?>sitio_turistico/tipo_turismo/registro">
	<?php if(isset($success) && $success):?>
		<div class = "message success">
			<p>Registro realizado correctamente</p>
		</div>
	<?php else :?>
		<div class="message error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>

	<h2>Registro de Tipo de Turismo</h2>

	<label for="nombre">Nombre *</label>
	<input type="text" name="nombre" id="nombre" 
	value="<?php echo (isset($success) && $success) ? '' : set_value('nombre')?>"/>

	<label for="descripcion">Descripción</label>
	<textarea rows="7" cols="30" name="descripcion" id="descripcion" 
	value="<?php echo (isset($success) && $success) ? '':set_value('descripcion')?>"></textarea>
	
	<div class="group_button">

		<button type="button" class="data btn" data-link="<?php echo base_url()?>sitio_turistico/tipo_turismo/listar">
			<span class = "glyphicon glyphicon-list-alt"></span> Consultar
		</button>

		<button type="submit" class = "btn">
			<span class = "glyphicon glyphicon-floppy-disk"></span> Guardar
		</button>
	</div>
</form>