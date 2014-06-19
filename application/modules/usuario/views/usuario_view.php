<form method="post" id="form" action="<?php echo base_url().$action?>">
	
	<?php if(isset($ok) && $ok):?>
		<div class="message success">
			<p>Registro realizado correctamente</p>
		</div>
		<?php else:?>
		<div class="message error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>
		
	
	<h2><?php echo $title ?></h2>
	<label for="txtTipo">Tipo Identificacion *</label>

	<select name="tipo" id="tipo">
		<option value="CC">Cedula Ciudadania</option>
		<option value="CE">Cedula Extranjeria</option>
	</select>		

	<label for="identificacion">Identificación *</label>
	<input type="text" name="identificacion" id="identificacion" value="<?php echo (isset($ok) && $ok) ? '':set_value('identificacion')?>">

	<label for="Nombre">Nombre(s) *</label>
	<input type="text" name="nombre" id="nombre" value="<?php echo (isset($ok) && $ok) ? '':set_value('nombre')?>">

	<label for="Apellidos">Apellidos *</label>
	<input type="text" name="apellidos" id="apellidos" value="<?php echo (isset($ok) && $ok) ? '':set_value('apellidos')?>">

	<label for="Telefono">Telefono *</label>
	<input type="text" name="telefono" id="telefono" value="<?php echo (isset($ok) && $ok) ? '':set_value('telefono')?>">

	<label for="Celular">Celular *</label>
	<input type="text" name="celular" id="celular" value="<?php echo (isset($ok) && $ok) ? '':set_value('celular')?>">

	<label for="Correo">Correo *</label>
	<input type="text" name="correo" id="correo" value="<?php echo (isset($ok) && $ok) ? '':set_value('correo')?>">
	
	<?php  if ($fecha):?>
		<label for="Fecha">Fecha Nacimiento *</label>
		<input type="date" name="fecha" value="<?php echo (isset($ok) && $ok) ? '':set_value('fecha')?>" >
	<?php endif?>

	<div class="group_button">
		<button type="button" class="btn data" data-link="<?php echo base_url().$action2?>">
			<span class = "glyphicon glyphicon-list-alt"></span> Consultar
		</button>

		<button type="submit" class="btn">
			<span class = "glyphicon glyphicon-floppy-disk"></span> Guardar
		</button>
	</div>
</form>