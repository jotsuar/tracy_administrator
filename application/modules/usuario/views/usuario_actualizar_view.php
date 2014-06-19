<div>
<div>
	
	<form method ="post" action="<?php echo base_url().$action ?>">
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
		<h2><?php echo $title ?></h2>
		<?php foreach ($datos as $value):?>
		<input type="hidden" name="id" value="<?php echo $value->id?>"/>

		<label for="estado">Estado</label>
		<select name="tipo" id="tipo">

			<?php if($value->tipo_documento=="CC"):?>
				<option value="CC" selected="selected">Cedula de Ciudadania</option>
			<?php else:?>
				<option value="CC">Cedula de Ciudadania</option>
			<?php endif;?>

			<?php if($value->tipo_documento=="CE"):?>
				<option value="CE" selected="selected">Cedula de Extrangeria</option>
			<?php else:?>
				<option value="CE">Cedula de extrangeria</option>
			<?php endif;?>

		</select>
		<label for="identificacion">Identificación *</label>
		<input type="text" name="identificacion" id="identificacion" value="<?php echo $value->identificacion?>">
		<label for="Nombre">Nombre(s) *</label>
		<input type="text" name="nombres" id="nombre" value="<?php echo $value->nombres?>">
		<label for="Apellidos">Apellidos *</label>
		<input type="text" name="apellidos" id="apellidos" value="<?php echo $value->apellidos?>">
		<label for="Telefono">Telefono *</label>
		<input type="text" name="telefono" id="telefono" value="<?php echo $value->telefono?>">
		<label for="Celular">Celular *</label>
		<input type="text" name="celular" id="celular" value="<?php echo $value->celular?>">
		<label for="Correo">Correo *</label>
		<input type="text" name="correo" id="correo" value="<?php echo $value->email?>">		
		<?php  if ($fecha):?>
		<label for="Fecha">Fecha Nacimiento *</label>
		<input type="date" name="fecha" value="<?php echo $value->fecha_nacimiento?>" placeholder="">
	<?php endif?>

		<?php endforeach;?>
		
		<div class="groupButton">
			<button type="button" class="consultar" data-link="<?php echo base_url()?>empleado/consultar"><span></span>Consultar</button>
			<button type="submit"><span></span>Modificar</button>
		</div>
	</form>

</div>
