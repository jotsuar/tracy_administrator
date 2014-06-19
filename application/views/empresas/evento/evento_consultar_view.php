<div>
	<div class="consulta">
		<form method ="post" action="<?php echo base_url()?>evento/consultar">

			<div class="data_error">
				<?php echo validation_errors();?>
			</div>
			<button type="button" data-link="<?php echo base_url()?>evento"><span></span>Volver</button>
			<h2>Consultar eventos</h2>
			<label for="txtNombre_evento">Nombre *</label>
			<input type="search" name="txtNombre_evento" id="txtNombre_evento">

			<div class="groupButton">
				<button type="submit"><span></span>Buscar</button>
			</div>

		</form>

		<table>
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Lugar</th>
					<th>Fecha del evento</th>
					<th>Fecha fin</th>
					<th>Hora del evento</th>
					<th>Hora de terminacion</th>
					<th>Descripcion</th>
					<th>Valor compra</th>
					<th>Valor venta</th>
					<th>Direccion</th>
					<th>Cupos</th>
				</tr>
			</thead>
			<tbody>
					<?php if(!isset($datos)){$datos = array();}?>
					<?php if($datos): ?>
					<?php foreach($datos as $value):?>
							<tr>
								<td><?php echo $value->nombre?></td>
								<td><?php echo $value->lugar?></td>
								<td><?php echo $value->fecha_inicio?></td>
								<td><?php echo $value->fecha_fin?></td>
								<td><?php echo $value->hora_inicio?></td>
								<td><?php echo $value->hora_salida?></td>
								<td><?php echo $value->descripcion?></td>
								<td><?php echo $value->valor_compra?></td>
								<td><?php echo $value->valor_venta?></td>
								<td><?php echo $value->direccion?></td>
								<td><?php echo $value->cupos?></td>
								<td><a href="<?php base_url()?>buscar/<?php echo $value->id?>" class="update"><span></span></a></td>
							</tr>
						<?php endforeach;?>
						<?php else:?>
						<tr>
							<td colspan="11">
								<h1>No hay datos</h1>
							</td>
						</tr>
				<?php endif;?>
			</tbody>
		</table>

	</div>
</div>