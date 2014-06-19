<div>
	
	<form method ="post" action="<?php echo base_url()?>banco/actualizar">
		<?php if($ok):?>
			<div class="ok">
				<p>Modificación realizada corrrectamente</p>
			</div>
		<?php endif;?>
		<?php if(!$ok):?>
			<div class="data_error">
				<?php echo validation_errors();?>
			</div>
		<?php endif;?>
		<h2>Modificar de banco</h2>
		<?php foreach ($datos as $value):?>
		<input type="hidden" name="txtId" value="<?php echo $value->id?>"/>

		<label for="txtNit">Nit *</label>
		<input type="text" name="txtNit" id="txtNit" value="<?php echo $value->nit?>">

		<label for="txtNombre">Nombre *</label>
		<input type="text" name="txtNombre" id="txtNombre" value="<?php echo $value->nombre?>">

		<label for="txtDireccion">Dirección *</label>
		<input type="text" name="txtDireccion" id="txtDireccion" value="<?php echo $value->direccion?>">

		<label for="txtTelefono">Teléfono *</label>
		<input type="text" name="txtTelefono" id="txtTelefono" value="<?php echo $value->telefono?>">

		<label for="txtCuenta">Número cuenta *</label>
		<input type="text" name="txtCuenta" id="txtCuenta" value="<?php echo $value->numero_cuenta?>">
		
		<label for="estado">Estado</label>
		<select name="estado" id="estado">

			<?php if($value->estado):?>
				<option value="1" selected="selected">Activo</option>
			<?php else:?>
				<option value="1">Activo</option>
			<?php endif;?>

			<?php if(!$value->estado):?>
				<option value="0" selected="selected">Inactivo</option>
			<?php else:?>
				<option value="0">Inactivo</option>
			<?php endif;?>

		</select>

		<?php endforeach;?>
		
		<div class="groupButton">
			<button type="button" class="consultar" data-link="<?php echo base_url()?>banco/consultar"><span></span>Consultar</button>
			<button type="submit"><span></span>Modificar</button>
		</div>
	</form>

</div>
