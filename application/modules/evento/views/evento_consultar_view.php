<button type="button" class="data btn volver" data-link="<?php echo base_url()?>evento">
	<span class = "glyphicon glyphicon-chevron-left"></span> Volver
</button>

<form method ="post" id="form" class="form_consult" action="<?php echo base_url()?>evento/consultar">

	<div class="message error">
		<?php echo validation_errors();?>
	</div>
	<h2>Consultar eventos</h2>
	<label for="txtNombre_evento">Nombre del evento *</label>
	<input type="search" name="txtNombre_evento" id="txtNombre_evento">

	<div class="group_button">
		<button type="submit" class="btn_search btn"><span class="glyphicon glyphicon-search"></span></button>
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
			<th>Modificar</th>
		</tr>
	</thead>
	<tbody>
		<?php if(!isset($datos)){$datos = array();}?>
		<?php if($datos):?>
		<?php foreach($datos as $value):?>
				<tr>
					<td><?php echo $value->nombre?></td>
					<td><?php echo $value->lugar?></td>
					<td><?php echo $value->fecha_inicio?></td>
					<td><?php echo $value->fecha_fin?></td>
					<td><?php echo $value->hora_inicio?></td>
					<td><?php echo $value->hora_salida?></td>
					<td><?php echo $value->descripcion?></td>
					<td><?php echo $value->valor_compra . " $"?></td>
					<td><?php echo $value->valor_venta . " $"?></td>
					<td><?php echo $value->direccion?></td>
					<td><?php echo $value->cupos?></td>
					<td>
						<a href="<?php base_url()?>buscar/<?php echo $value->id?>" class="update">
							<span class="glyphicon glyphicon-list-alt"></span>
						</a>
					</td>
				</tr>
			<?php endforeach;?>
			<?php else:?>
			<tr>
				<td colspan="12">
					<h1>No hay datos</h1>
				</td>
			</tr>
		<?php endif;?>
	</tbody>
</table>