<?php
	// echo "<pre>";
	// print_r($sitio);
	// print_r($additional_services);
	// print_r($detalle_sitio);
	// exit();
?>
<form method ="post" id = "form" action="<?php echo base_url()?>sitio_turistico/modificar">
	<?php if(isset($ok) && $ok):?>
		<div class = "message success">
			<p>Registro realizado correctamente</p>
		</div>
	<?php else:?>
		<div class="message error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>
	<h2>Modificación de sitios turísticos</h2>

	<input type="hidden" name ="id" value="<?php echo $sitio->id?>" />

	<label for="nombre">Nombre *</label>
	<input type="text" name="nombre" id="nombre" value = "<?php echo $sitio->nombre?>"/>

	<label for="ubicacion">Ubicación *</label>
	<input type="text" name="ubicacion" id="ubicacion" value="<?php echo $sitio->ubicacion?>"/>

	<label for="descripcion">Descripción</label>
	<textarea name="descripcion" id="descripcion" rows="5" cols="30" value="">
		<?php echo $sitio->descripcion?>
	</textarea>

	<label for="tipo_turismo">Tipo de turismo *</label>
	<select name="tipo_turismo" id ="tipo_turismo">
		<?php foreach($turismos as $turismo):?>
			<?php if($turismo->id == $sitio->id_tipo_turismo):?>
			<option selected="selected" value="<?php echo $turismo->id?>">
				<?php echo $turismo->nombre?>
			</option>
			<?php else:?>
			<option value="<?php echo $turismo->id?>">
				<?php echo $turismo->nombre?>
			</option>
			<?php endif;?>
		<?php endforeach;?>
	</select>

	<fieldset>
		<legend>Servicios adicionales</legend>
		<?php $k = 0;?>
		<?php for($i = 0; $i < count($additional_services); $i++):?>
				<?php if(!empty($detalle_sitio) && $k < count($detalle_sitio) && $additional_services[$i]['id'] == $detalle_sitio[$k]['id_servicio_adicional']):?>
					<label for="<?php echo str_replace(' ', '_', strtolower($additional_services[$i]['nombre']))?>">
						<input type="checkbox" checked = "checked"
						name="<?php echo strtolower("check_".str_replace(' ', '_', $additional_services[$i]['nombre']))?>" 
						id="<?php echo str_replace(' ', '_', strtolower($additional_services[$i]['nombre']))?>" value="<?php echo $additional_services[$i]['id']?>"/>
						<?php echo ucwords(strtolower($additional_services[$i]['nombre'])); $k++?>
					</label>
				<?php else:?>
					<label for="<?php echo str_replace(' ', '_', strtolower($additional_services[$i]['nombre']))?>">
						<input type="checkbox" 
						name="<?php echo strtolower("check_".str_replace(' ', '_', $additional_services[$i]['nombre']))?>" 
						id="<?php echo str_replace(' ', '_', strtolower($additional_services[$i]['nombre']))?>" value="<?php echo $additional_services[$i]['id']?>"/>
						<?php echo ucwords(strtolower($additional_services[$i]['nombre']))?>
					</label>
				<?php endif;?>
		<?php endfor;?>
	</fieldset>

	<div class = "group_button">
		<button type="button" class = "data btn" data-link="<?php echo base_url()?>sitio_turistico/lista">
			<span class="glyphicon glyphicon-remove-circle"></span> Cancelar
		</button>
		<button class = "btn" type = "submit" name = "btn_save">
			<span class = "glyphicon glyphicon-floppy-disk"></span> Guardar
		</button>
	</div>
</form>