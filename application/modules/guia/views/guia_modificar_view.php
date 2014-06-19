<?php


/*	echo "<pre>";
	print_r($datos);
	print_r($idiomas);
	print_r($idiomas_guia);
	exit();*/
?>

<div>
<div>
	
	<form method ="post" action="<?php echo base_url()?>guia/registrar_guia">
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
		<h2>Actualizar Guia Turistico</h2>
		<?php foreach ($datos as $value):?>
		<input type="hidden" name="codigo" value="<?php echo $value->id?>"/>
		<label for="identificacion">Identificación *</label>
		<input type="text" name="identificacion" id="identificacion" value="<?php echo $value->identificacion?>">
		<label for="Nombre">Nombre(s) *</label>
		<input type="text" name="nombre" id="nombre" value="<?php echo $value->nombre?>">
		<label for="Apellidos">Apellidos *</label>
		<input type="text" name="apellidos" id="apellidos" value="<?php echo $value->apellido?>">
		<label for="Telefono">Telefono *</label>
		<input type="text" name="telefono" id="telefono" value="<?php echo $value->telefono?>">
		<label for="Celular">Celular *</label>
		<input type="text" name="celular" id="celular" value="<?php echo $value->celular?>">
		<label for="Correo">Correo *</label>
		<input type="text" name="correo" id="correo" value="<?php echo $value->email?>">	
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
		<?php if(isset($idiomas)):?>
		<fieldset>
			<legend>Idiomas que habla</legend>
			<?php $k = 0; $l=0;?>
			<?php for($i = 0; $i < count($idiomas); $i++):?>
				<?php if($k < count($idiomas_guia) && $idiomas[$i]['id'] == $idiomas_guia[$k]['id']):?>

				 				
					<label for="<?php echo str_replace(" ","_", strtolower( "check_".$idiomas[$i]['nombre']) )?>">
						<input type = "checkbox" 
							name="<?php echo str_replace(" ","_", strtolower( "check_".$idiomas[$i]['nombre']) ) ?>" 
							id="<?php echo str_replace(" ","_", strtolower( "check_".$idiomas[$i]['nombre']) )?>" 
							value="<?php echo $idiomas[$i]['id']?>" checked = "checked"
						/>
						<?php echo ucwords(strtolower($idiomas[$i]['nombre'])); $k++;?>


					</label>

				<?php else:?>
					<label for="<?php echo str_replace(" ","_", strtolower( "check_".$idiomas[$i]['nombre']) )?>">
						<input type = "checkbox" 
							name = "<?php echo str_replace(" ","_", strtolower( "check_".$idiomas[$i]['nombre']) )?>"
							id = "<?php echo str_replace(" ","_", strtolower( "check_".$idiomas[$i]['nombre']) )?>" 
							value = "<?php echo $idiomas[$i]['id']?>"
						/>
						<?php echo ucwords(strtolower($idiomas[$i]['nombre']) )?>
					</label>
				<?php endif;?>
			<?php endfor;?>
		</fieldset>
	<?php endif;?>

		<?php endforeach;?>
		
		<div class="groupButton">
			<button type="button" class="consultar" data-link="<?php echo base_url()?>guia/consultar_guia/0"><span></span>Consultar</button>
			<button type="submit" name="btn_modificar" value="btn_modificar"><span></span>Modificar</button>
		</div>
	</form>

</div>
