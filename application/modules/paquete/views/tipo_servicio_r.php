<form method ="post" id="form" action="<?php echo base_url()?>paquete/registrar_tipo">
	<?php if(isset($ok) && $ok):?>
		<div class="message success">
			<p>Registro realizado correctamente</p>
		</div>
	<?php else :?>
		<div class="message error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>
	<h2>Registro de tipo de paquete</h2>
	<label for="nombre">Nombre *</label>
	<input type="text" name="nombre" id="nombre" value="<?php echo (isset($ok) && $ok) ? '':set_value('nombre')?>"/>
	<div class = "group_button">
		<button type="button" class="data btn" data-link="<?php echo base_url()?>paquete/consultar_tipo/0">
			<span class = "glyphicon glyphicon-list-alt"></span> Consultar
		</button>
		<button type="submit" class="btn">
			<span class = "glyphicon glyphicon-floppy-disk"></span> Guardar
		</button>
	</div>
</form>