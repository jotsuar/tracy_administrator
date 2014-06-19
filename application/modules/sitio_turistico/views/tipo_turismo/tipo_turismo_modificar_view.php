<form method ="post" id = "form" action="<?php echo base_url()?>sitio_turistico/tipo_turismo/modificar">
	<?php if($success == FALSE):?>
		<div class="message error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>

	<h2>Modificar Tipo Turismo</h2>
	
		<input type="hidden" name="id" value="<?php echo $data->id?>"/>

		<label for="categoria">Nombre *</label>
		<input type="text" name="nombre" id="nombre" value="<?php echo $data->nombre?>">

		<label for="descripcion">Descripción</label>
		<textarea rows="7" cols="5" name="descripcion" id="descripcion" ><?php echo $data->descripcion?></textarea>	

	<div class = "group_button">
		<button type="button" class = "data btn" data-link="<?php echo base_url()?>sitio_turistico/tipo_turismo/listar">
			<span class="glyphicon glyphicon-remove-circle"></span> Cancelar
		</button>
		<button type="submit" class = "btn">
			<span class = "glyphicon glyphicon-floppy-disk"></span> Modificar
		</button>
	</div>
</form>