<form class="frm" method ="post" id = "form" action="<?php echo base_url()?>hospedaje/registrar">
	<?php if(isset($ok) && $ok):?>
		<div class = "message success">
			<p>Registro realizado correctamente</p>
		</div>
	<?php else:?>
		<div class="message error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>
	<h2>Registro de hospedaje</h2>
		<label for="nit">Nit *</label>
		<input type="text" name="nit" id="nit" value="<?php echo (isset($ok) && $ok) ? '' : set_value('nit')?>"/>
	<label for="nombre">Nombre *</label>
	<input type="text" name="nombre" id="nombre" value="<?php echo (isset($ok) && $ok) ? '':set_value('nombre')?>"/>


	<label for="direccion">Dirección *</label>
	<input type="text" name="direccion" id="direccion" value="<?php echo (isset($ok) && $ok) ? '':set_value('direccion')?>"/>

	<label for="telefono">Teléfono *</label>
	<input type="text" name="telefono" id="telefono" value="<?php echo (isset($ok) && $ok) ? '':set_value('telefono')?>"/>

	<label for="descripcion">Descripción</label>
	<textarea name="descripcion" id="descripcion" rows="5" cols="30" value="<?php echo (isset($ok) && $ok) ? '':set_value('descripcion')?>"></textarea>

	<label for="categoria">Categoría *</label>
	<select name="categoria" id="categoria">
		<?php if(isset($categorias)):?>
			<?php foreach ($categorias as $value):?>
				<option value="<?php echo $value->id?>"><?php echo $value->categoria?></option>
			<?php endforeach;?>
		<?php endif;?>
	</select>

	<?php if(isset($comodidades) && $comodidades):?>
		<fieldset>
			<legend>Comodidades</legend>
			<?php foreach($comodidades as $value):?>
				<label for="<?=strtolower($value->nombre)?>">
					<input type="checkbox" name="<?=strtolower("check_".$value->nombre)?>" id="<?=strtolower($value->nombre)?>" 
					value="<?=$value->id?>" id ="restaurante"><?=ucwords(strtolower($value->nombre))?></label>
			<?php endforeach;?>
		</fieldset>
	<?php endif;?>

	<div class = "group_button">
		<button type="button" class="data btn" data-link="<?=base_url()?>hospedaje/consultar">
			<span class = "glyphicon glyphicon-list-alt"></span> Consultar
		</button>
		<button class = "btn" type = "submit" name = "btn_save">
			<span class = "glyphicon glyphicon-floppy-disk"></span> Guardar
		</button>
	</div>
</form>