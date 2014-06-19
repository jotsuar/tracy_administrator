
<form method ="post" id="form" action="<?php echo base_url()."paquete/".$action?> ">

		<?php if(isset($ok) && $ok):?>
		<div class="message success">
			<p>Paquete creado correctamente</p>
		</div>
	<?php else :?>
		<div class="message error">
			<?php echo validation_errors();?>
			<?php echo $mensaje?>
		</div>
	<?php endif;?>
	<?php if($action=="principal"):?>
	<h2>Consulta de Servicios para paquetes</h2>

	<label for="Fecha Inicio">Fecha Inicio *</label>
	<input type="date" name="fecha_inicio" value="<?php echo set_value('fecha_inicio') ?>">
	<label for="Fecha Fin">Fecha Fin</label>			
	<input type="date" name="fecha_fin" value="<?php echo set_value('fecha_fin') ?>">
	
	
	<div class="group_button">
		<button type="submit" class="btn"><span class="glyphicon glyphicon-search"></span> Buscar</button>
		<button type="button" class="data btn" data-link="<?php echo base_url()?>paquete/consultar/0">
			<span class = "glyphicon glyphicon-list-alt"></span> Consultar
		</button>
	</div>
	<?php endif;?>

	<?php if($action=="crear"):?>
	<h2>Creacion paquetes</h2>
		<label for="categoria">Tipo Paquete *</label>
	<select name="tipo" id="tipo">
		<?php if(isset($tipo)):?>
			<?php foreach ($tipo as $valuet):?>
				<option value="<?php echo $valuet->id?>"><?php echo $valuet->descripcion?></option>
			<?php endforeach;?>
		<?php endif;?>
	</select>
	<label for="Fecha Inicio">Fecha Inicio *</label>
	<input type="date" name="fecha_inicio" value="<?php echo $fecha_inicio?>" readonly="">
	<label for="Fecha Fin">Fecha Fin</label>			
	<input type="date" name="fecha_fin" value="<?php echo $fecha_fin ?>" readonly="">
	

	<?php if(isset($evento) && $evento):?>
		<fieldset>
			<legend>Eventos</legend>

			<?php foreach($evento as $values):?>

			<input type="radio" name="evento" value="<?php echo $values->id_evento?>"> <?php echo $values->evento?><br>
		<?php endforeach;?>
		</fieldset>
	<?php endif;?>
		<?php if(isset($citytour) && $citytour):?>
		<fieldset>
			<legend>CityTours</legend>

			<?php foreach($citytour as $valuej):?>

			<input type="radio" name="city" value="<?php echo $valuej->city_id?>"> <?php echo $valuej->city?><br>
		<?php endforeach;?>
		</fieldset>
	<?php endif;?>
		<?php if(isset($habitaciones) && $habitaciones):?>
		<fieldset>
			<legend>Habitaciones Disponibles</legend>

			<?php foreach($habitaciones as $valueh):?>
				<label for="<?php echo $valueh->tipo.'_'.$valueh->id ?>">
					<input type="checkbox" name="<?=strtolower("check_".$valueh->id)?>" 
					value="<?=$valueh->id?>"><?=ucwords(strtolower($valueh->tipo)." (".$valueh->hospedaje.")")?></label>
			<?php endforeach;?>
		</fieldset>
	<?php endif;?>

	<label for = "transporte">Transporte *</label>
	<select name = "transporte" id = "transporte">
		<option value = "1">SI</option>
		<option value = "0">NO</option>
	</select>
	<label for = "transporte">Cupos *</label>
	<input type="number" name="cupo" value="" placeholder="">
		<div id="group_button">

		<button type="button" class="data btn" data-link="<?=base_url()?>paquete/principal" >
			<span class="glyphicon glyphicon-remove-circle"></span> Cancelar
		</button>
		<button type="submit" class="btn" name="btn_modificar" value="btn_modificar">
			<span class="glyphicon glyphicon-edit"></span> Crear
		</button>

	</div>

	<?php endif;?>


</form>