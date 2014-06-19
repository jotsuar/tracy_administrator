<form method = "post" id = "form" action="<?php echo base_url()?>transport_company/modificar">
	<?php if(isset($ok) && $ok):?>
		<div class = "message success">
			<p>Modificación realizada correctamente</p>
		</div>
	<?php else:?>
		<div class = "message error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>
	<h2>Modificar transporte</h2>

	<input type = "hidden" name = "id" value = "<?php echo $transporte->id?>"/>

	<label for = "nit">Nit *</label>
	<input type="text" name = "nit" id = "nit" value = "<?php echo $transporte->nit?>">

	<label for = "nombre">Nombre *</label>
	<input type = "text" name = "nombre" id = "nombre" value = "<?php echo $transporte->nombre?>">

	<label for = "direccion">Dirección *</label>
	<input type = "text" name="direccion" id="direccion" value = "<?php echo $transporte->direccion?>">

	<label for = "telefono">Teléfono *</label>
	<input type = "text" name = "telefono" id = "telefono" value = "<?php echo $transporte->telefono?>">

	<label for="correo">Correo *</label>
	<input type="text" name="correo" id="correo" value="<?php echo $transporte->correo?>">

	<label for="seguro">Seguro transporte</label>
	<select name="seguro" id="seguro">
		<?php if($transporte->seguro_transporte):?>
			<option value="1" selected="selected">SI</option>
			<option value="0">NO</option>
		<?php else:?>
			<option value="1">SI</option>
			<option value="0" selected="selected">NO</option>
		<?php endif;?>
	</select>

	<label for="estado">Estado</label>
	<select name="estado" id="estado">

		<?php if($transporte->estado):?>
			<option value="1" selected="selected">Activo</option>
			<option value="0">Inactivo</option>
		<?php else:?>
			<option value="0" selected="selected">Inactivo</option>
			<option value="1">Activo</option>
		<?php endif;?>
	</select>
	
	<div class="group_button">
		<button type="button" class = "data btn" data-link="<?php echo base_url()?>transport_company/consultar">
			<span class="glyphicon glyphicon-remove-circle"></span> Cancelar
		</button>
		<button type="submit" class = "btn" name="btn_modificar">
			<span class = "glyphicon glyphicon-edit"></span> Modificar
		</button>
	</div>
</form>