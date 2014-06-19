<div>
	
	<form method ="post" action="<?php echo base_url()?>contacto/actualizar_contacto">
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
		<h2>Modificar contacto</h2>
		<?php foreach ($datos as $value):?>
		
		<input type="hidden" name="codigo" value="<?php echo $value->codigo?>"/>

		<label for="nombre_evento">Nombre *</label>
		<select name="nombre_evento" id="nombre_evento">
		 	<?php if(isset($combo) && $combo):?>
				<?php foreach ($combo as $data):?>
				<option value="<?php echo $data->id?>"> <?php echo $data->nombre?></option>
				<?php endforeach;?>
			<?php endif;?>
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
		<select name="estado_contacto" id="estado_contacto">

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
			<button type="button" class="consultar" data-link="<?php echo base_url()?>contacto/consultar_contacto"><span></span>Consultar</button>
			<button type="submit"><span></span>Modificar</button>
		</div>
	</form>

</div>