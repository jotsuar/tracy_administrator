<div>
	
	<form method ="post" action="<?php echo base_url()?>evento/actualizar">
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
		<h2>Modificar evento</h2>
		<?php foreach ($datos as $value):?>
		<input type="hidden" name="id" value="<?php echo $value->id?>"/>

		<label for="nombre_evento">Nombre *</label>
		<input type="text" name="nombre_evento" id="nombre_evento" value="<?php echo $value->nombre?>">

		<label for="descripcion_evento">Descripcion *</label>
		<input type="text" name="descripcion_evento" id="descripcion_evento" value="<?php echo $value->descripcion?>">

		<label for="valor_compra_evento">Valor compra *</label>
		<input type="text" name="valor_compra_evento" id="valor_compra_evento" value="<?php echo $value->valor_compra?>">

		<label for="valor_venta_evento">Hora del evento *</label>
		<input type="text" name="valor_venta_evento" id="valor_venta_evento" value="<?php echo $value->valor_venta?>">

		<label for="direccion">Direccion *</label>
		<input type="text" name="direccion" id="direccion" value="<?php echo $value->direccion?>">

		<label for="cupos_evento">Eventos *</label>
		<input type="text" name="cupos_evento" id="cupos_evento" value="<?php echo $value->cupos?>">

		<label for="lugar_evento">Lugar del evento *</label>
		<input type="text" name="lugar_evento" id="lugar_evento" value="<?php echo $value->lugar?>">

		<label for="fecha_inicio_evento">Fecha inicio *</label>
		<input type="date" name="fecha_inicio_evento" id="fecha_inicio_evento" value="<?php echo $value->fecha_inicio?>">

		<label for="fecha_fin_evento">Fecha de teminacion *</label>
		<input type="date" name="fecha_fin_evento" id="fecha_fin_evento" value="<?php echo $value->fecha_fin?>">

		<label for="hora_inicio_evento">Hora de inicio *</label>
		<input type="time" name="hora_inicio_evento" id="hora_inicio_evento" value="<?php echo $value->hora_inicio?>">

		<label for="hora_fin_evento">Hora de terminacion *</label>
		<input type="time" name="hora_fin_evento" id="hora_fin_evento" value="<?php echo $value->hora_salida?>">

		<?php endforeach;?>
		
		<div class="groupButton">
			<button type="button" class="consultar" data-link="<?php echo base_url()?>evento/consultar"><span></span>Consultar</button>
			<button type="submit"><span></span>Modificar</button>
		</div>
	</form>

</div>
