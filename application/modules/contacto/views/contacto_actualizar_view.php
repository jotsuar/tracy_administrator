<?php foreach ($datos as $value):?>
<form method ="post" id="form" action="<?php echo base_url()."contacto/actualizar_contacto/".$value->codigo."/".$empresa?>">
	<?php if($ok):?>
		<div class="message success">
			<p>Modificación realizada correctamente</p>
		</div>
	<?php endif;?>
	<?php if(!$ok):?>
		<div class="message error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>
	<h2>Modificar contacto</h2>
	
	
	<input type="hidden" name="codigo" value="<?php echo $value->codigo?>"/>
	<input type="hidden" name="empresa" value="<?php echo $empresa?>"/>

	<label for="nombre_evento">Nombre *</label>
	<select name="id_empresa" id="nombre_evento">

	 	<option value="<?php echo $value->id_ ?>" selected=""> <?php echo $value->nombre_empresa?></option>
			<?php foreach ($combo as $values):?>
				<?php if($value->id_!= $values->id):?>
					<option value="<?php echo $values->id?>"> <?php echo $values->nombre?></option>
				<?php endif;?>
			<?php endforeach;?>
	</select>

	<label for="identificacion">Identificacion *</label>
	<input type="text" name="identificacion" id="identificacion" value="<?php echo $value->identificacion?>">

	<label for="nombres">Nombres *</label>
	<input type="text" name="nombres" id="nombres" value="<?php echo $value->nombres?>">

	<label for="apellidos">Apellidos *</label>
	<input type="text" name="apellidos" id="apellidos" value="<?php echo $value->apellidos?>">

	<label for="celular">Celular *</label>
	<input type="text" name="celular" id="celular" value="<?php echo $value->celular?>">

	<label for="email">Email *</label>
	<input type="text" name="email" id="email" value="<?php echo $value->email?>">

	<label for="estado_contacto">Estado</label>
	<select name="estado" id="estado_contacto">

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
	
	<div class="group_button">
		<button type="button" class="data btn" data-link="<?php echo base_url()."contacto/consultar_contacto/".$empresa?>">
			<span class="glyphicon glyphicon-remove-circle"></span> Cancelar
		</button>
		<button type="submit" class="btn">
			<span class="glyphicon glyphicon-edit"></span> Modificar
		</button>
	</div>
</form>