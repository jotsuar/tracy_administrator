<form method ="post" action="<?php echo base_url()?>hospedaje/registrar">
	<?php if(isset($ok) && $ok):?>
		<div class="ok">
			<p>Modificación realizada corrrectamente</p>
		</div>
	<?php else:?>
		<div class="data_error">
			<?php echo validation_errors();?>
		</div>
	<?php endif;?>

	<h2>Modificar de hospedaje</h2>
	<input type="hidden" name="id_hospedaje" 
		value="<?php echo (isset($hospedaje[0]->id)) ? $hospedaje[0]->id : set_value('nit')?>" 
	/>
	<label for="nit">Nit *</label>
	<input type="text" name = "nit" id = "nit" 
	value="<?php echo (isset($hospedaje[0]->nit)) ? $hospedaje[0]->nit : set_value('nit')?>"/>

	<label for="nombre">Nombre *</label>
	<input type="text" name="nombre" id="nombre" 
	value="<?php echo (isset($hospedaje[0]->nit)) ? $hospedaje[0]->nombre : set_value('nombre')?>"/>

	<label for="direccion">Dirección *</label>
	<input type="text" name="direccion" id="direccion" 
	value="<?php echo (isset($hospedaje[0]->direccion)) ? $hospedaje[0]->direccion : set_value('direccion')?>"/>

	<label for="telefono">Teléfono *</label>
	<input type="text" name="telefono" id="telefono" 
	value="<?php echo (isset($hospedaje[0]->telefono)) ? $hospedaje[0]->telefono : set_value('telefono')?>"/>

	<label for="descripcion">Descripción</label>
	<textarea name="descripcion" id="descripcion" rows="5" cols="30" 
	value="<?php	echo (isset($hospedaje[0]->descripcion)) ? $hospedaje[0]->descripcion : set_value('descripcion')?>">
	</textarea>
	<label for="categoria">Categoría *</label>
	<select name="categoria" id="categoria">
		<?php if(isset($categorias)):?>
			<?php foreach ($categorias as $value):?>
				<?php if($value->id == $hospedaje[0]->id_categoria):?>
					<option selected="selected" value="<?php echo $value->id?>"><?php echo $value->categoria?></option>
			<?php else:?>
				<option value="<?php echo $value->id?>"><?php echo $value->categoria?></option>
			<?php endif;?>
				
			<?php endforeach;?>
		<?php endif;?>
	</select>
	<?php if(isset($comodidades)):?>
		<fieldset>
			<legend>Comodidades</legend>
			<?php $k = 0;?>
			<?php for($i = 0; $i < count($comodidades); $i++):?>
				<?php if($k < count($comodidades_hospedaje) && $comodidades[$i]->id == $comodidades_hospedaje[$k]->id):?>
				<?php $k++;?>
					<label for="<?php echo str_replace(" ","_", strtolower( "check_".$comodidades[$i]->nombre) )?>">
						<input type = "checkbox" 
							name="<?php echo str_replace(" ","_", strtolower( "check_".$comodidades[$i]->nombre) ) ?>" 
							id="<?php echo str_replace(" ","_", strtolower( "check_".$comodidades[$i]->nombre) )?>" 
							value="<?php echo $comodidades[$i]->id?>" checked = "checked"
						/>
						<?php echo ucwords(strtolower($comodidades[$i]->nombre))?>
					</label>
				<?php else:?>
					<label for="<?php echo str_replace(" ","_", strtolower( "check_".$comodidades[$i]->nombre) )?>">
						<input type = "checkbox" 
							name = "<?php echo str_replace(" ","_", strtolower( "check_".$comodidades[$i]->nombre) )?>"
							id = "<?php echo str_replace(" ","_", strtolower( "check_".$comodidades[$i]->nombre) )?>" 
							value = "<?php echo $comodidades[$i]->id?>"
						/>
						<?php echo ucwords(strtolower( $comodidades[$i]->nombre) )?>
					</label>
				<?php endif;?>
			<?php endfor;?>
		</fieldset>
	<?php endif;?>

	<label>Estado</label>
	<select name="estado">
		<option value="1">Activo</option>
		<option value="0">Inactivo</option>
	</select>

	<div class="groupButton">

		<button type="button" class="consultar" data-link="<?=base_url()?>hospedaje/consultar">
			<span></span>Consultar
		</button>
		<button type="submit" name="btn_modificar" value="btn_modificar">
			<span></span>Modificar
		</button>

	</div>
</form>