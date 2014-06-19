<div>
	
	<form method ="post" action="<?php echo base_url()?>banco/registrar">
		<?php if($ok):?>
			<div class="ok">
				<p>Registro realizado corrrectamente</p>
			</div>
		<?php else:?>
			<div class="data_error">
				<?php echo validation_errors();?>
			</div>
		<?php endif;?>
		<h2>Registro de banco</h2>
		<label for="txtNit">Nit *</label>
		<input type="text" name="txtNit" id="txtNit" value="<?php echo set_value('txtNit')?>">

		<label for="txtNombre">Nombre *</label>
		<input type="text" name="txtNombre" id="txtNombre" value="<?php echo set_value('txtNombre')?>">

		<label for="txtDireccion">Dirección *</label>
		<input type="text" name="txtDireccion" id="txtDireccion" value="<?php echo set_value('txtDireccion')?>">

		<label for="txtTelefono">Teléfono *</label>
		<input type="text" name="txtTelefono" id="txtTelefono" value="<?php echo set_value('txtTelefono')?>">

		<label for="txtCuenta">Número cuenta *</label>
		<input type="text" name="txtCuenta" id="txtCuenta" value="<?php echo set_value('txtCuenta')?>">

		<div class="groupButton">
			<button type="submit"><span></span>Guardar</button>
			<button type="button" class="consultar" data-link="<?php echo base_url()?>banco/consultar"><span></span>Consultar</button>
		</div>
	</form>

</div>
