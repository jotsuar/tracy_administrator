<div>
	
	<form method ="post" action="<?php echo base_url()?>transporte/actualizar">
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
		<h2>Modificar de transporte</h2>
		<?php foreach ($datos as $value):?>
		<input type="hidden" name="id" value="<?php echo $value->id?>"/>

		<label for="nit_empresa">Nit *</label>
		<input type="text" name="nit_empresa" id="nit_empresa" value="<?php echo $value->nit?>">

		<label for="nombre_empresa">Nombre *</label>
		<input type="text" name="nombre_empresa" id="nombre_empresa" value="<?php echo $value->nombre?>">

		<label for="direccion_empresa">Dirección *</label>
		<input type="text" name="direccion_empresa" id="direccion_empresa" value="<?php echo $value->direccion?>">

		<label for="telefono_empresa">Teléfono *</label>
		<input type="text" name="telefono_empresa" id="telefono_empresa" value="<?php echo $value->telefono?>">

		<label for="correo_empresa">Correo *</label>
		<input type="text" name="correo_empresa" id="correo_empresa" value="<?php echo $value->correo?>">

		<label for="seguro">Seguro transporte</label>
		<select name="seguro" id="seguro">
			<?php if($value->seguro_transporte):?>
				<option value="1" selected="selected">SI</option>
			<?php else:?>
				<option value="1">SI</option>
			<?php endif;?>

			<?php if(!$value->seguro_transporte):?>
				<option value="0" selected="selected">NO</option>
			<?php else:?>
				<option value="0">NO</option>
			<?php endif;?>
		</select>

		<label for="txtCuenta">Estado</label>
		<select name="estado" id="estado">

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
			<button type="button" class="consultar" data-link="<?php echo base_url()?>transporte/consultar"><span></span>Consultar</button>
			<button type="submit"><span></span>Modificar</button>
		</div>
	</form>

</div>
