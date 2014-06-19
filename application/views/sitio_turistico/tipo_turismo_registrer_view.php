<form method ="post" action="<?php echo base_url()?>tipo_turismo/registrer">
	<?php if(isset($ok) && $ok):?>
		<div class="ok">
			<p>Registro realizado corrrectamente</p>
		</div>
	<?php else :?>
		<div class="data_error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>
	<h2>Registro de Tipo de Turismo</h2>
	<label for="nombre">Nombre *</label>
	<input type="text" name="nombre" id="nombre" value="<?php echo (isset($ok) && $ok) ? '':set_value('nombre')?>"/>

	<label for="descripcion">Descripción</label>
	<textarea rows="7" cols="30" name="descripcion" id="descripcion" value="<?php echo (isset($ok) && $ok) ? '':set_value('descripcion')?>"></textarea>
	
	<div class="groupButton">
		<button type="button" class="consultar" data-link="<?php echo base_url()?>tipo_turismo/listar"><span></span>Consultar</button>
		<button type="submit"><span></span>Guardar</button>
	</div>
</form>