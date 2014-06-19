<form method ="post" id = "form" action="<?php echo base_url()?>hospedaje/tipo_habitacion">
	<?php if(isset($ok) && $ok):?>
		<div class = "message success">
			<p>Registro realizado correctamente</p>
		</div>
	<?php else :?>
		<div class = "message error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>
	<h2>Registro de Tipo de Habitación</h2>
	<label for="nombre">Nombre *</label>
	<input type="text" name="nombre" id="nombre" value="<?php echo (isset($ok) && $ok) ? '':set_value('nombre')?>"/>

	<label for="descripcion">Descripción</label>
	<textarea rows="7" cols="30" name="descripcion" id="descripcion" value="<?php echo (isset($ok) && $ok) ? '':set_value('descripcion')?>"></textarea>
	<label for="nombre">Cupo maximo *</label>
	<input type="number" name="cupo_maximo" id="cupo" value="<?php echo (isset($ok) && $ok) ? '':set_value('cupo_maximo')?>" min="1" max="10"/>
	
	<div class="group_button">
		<button type="button" class="data btn" data-link="<?php echo base_url()?>hospedaje/tipo_habitacion/consultar">
			<span class = "glyphicon glyphicon-list-alt"></span> Consultar
		</button>

		<button type="submit" class = "btn">
			<span class = "glyphicon glyphicon-floppy-disk"></span> Guardar
		</button>
	</div>
</form>