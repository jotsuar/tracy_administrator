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
	<h2>Registro Sitios Turisticos</h2>
	<label for="Nombre">Nombre Sitio Turistico</label>
	<input type="text" name="nombre" value="">
	<label for="ubicacion">Ubicacion</label>
	<input type="text" name="ubicacion" value="">
</form>