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
		<input type="hidden" name="id" value="<?php echo $value->id_usuario?>"/>

		<label for="estado">Estado</label>
		<select name="estado" id="estado">

			<?php if($value->estado==1):?>
				<option value="1" selected="selected">Activo</option>
			<?php else:?>
				<option value="1">Activo</option>
			<?php endif;?>

			<?php if($value->estado==0):?>
				<option value="0" selected="selected">Inactivo</option>
			<?php else:?>
				<option value="0">Inactivo</option>
			<?php endif;?>

		</select>
		<label for="Usuario">Usuario *</label>
		<input type="text" name="usuario" id="usuario" value="<?php echo $value->usuario?>" readonly="readonly">

		<label for="Contraseña">Contraseña *</label>
		<input type="text" name="pass" id="pass" value="<?php echo $value->password?>">


		<?php endforeach;?>
		
		<div class="groupButton">
			<button type="button" class="consultar" data-link="<?php echo base_url()?>cuenta"><span></span>Consultar</button>
			<button type="submit"><span></span>Modificar</button>
		</div>
	</form>

</div>
