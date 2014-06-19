<form method = "post" id = "form" action = "<?php echo base_url()?>transporte/modificar_tipo_vehiculo">
	<?php if(isset($ok) && $ok):?>
		<div class = "message success">
			<p>Modificación realizada correctamente</p>
		</div>
		<?php else:?>
		<div class="message error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>
	<h2>Modificar de tipo vehículo</h2>
	<input type = "hidden" name = "id" value = "<?php echo $tipo->id?>"/>	

	<label for = "tipo">Tipo *</label>
	<input type = "text" name = "tipo" id = "tipo" value="<?php echo $tipo->nombre?>"/>

	<label for = "descripcion">Descripción</label>
	<textarea rows = "7" cols = "30" name = "descripcion" id = "descripcion">
		<?php echo $tipo->descripcion?>
	</textarea>	

	<div class = "group_button">
		<button type = "button" class = "data btn" data-link = "<?php echo base_url()?>transporte/consultar_tipo_vehiculo">
			<span class="glyphicon glyphicon-remove-circle"></span> Cancelar
		</button>
		<button type = "submit" class = "btn">
			<span class = "glyphicon glyphicon-edit"></span> Modificar
		</button>
	</div>
</form>
