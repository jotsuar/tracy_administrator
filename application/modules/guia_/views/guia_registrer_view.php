<div>

	<form method="post" action="<?php echo base_url()?>guia/registrar_guia">
		
		<?php if(isset($ok) && $ok):?>
		<div class="ok">
			<p>Registro realizado corrrectamente</p>
		</div>
	<?php else:?>
		<div class="data_error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>
			
		
		<h2>Guia Turistico</h2>		
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
			<?php if(isset($idiomas) && $idiomas):?>
		<fieldset>
			<legend>Posibles Idiomas</legend>

			<?php foreach($idiomas as $value):?>
				<label for="<?=strtolower($value->nombre)?>">
					<input type="checkbox" name="<?=strtolower("check_".$value->nombre)?>" id="<?=strtolower($value->nombre)?>" 
					value="<?=$value->id?>" id ="restaurante"><?=ucwords(strtolower($value->nombre))?></label>
			<?php endforeach;?>
		</fieldset>
	<?php endif;?>

	<div class = "group_button">
		<button type="button" class="data btn" data-link="">
			<span class = "glyphicon glyphicon-list-alt"></span> Consultar
		</button>
		<button class = "btn" type = "submit" name = "btn_save">
			<span class = "glyphicon glyphicon-floppy-disk"></span> Guardar
		</button>
	</div>
	

	</form>


<div>