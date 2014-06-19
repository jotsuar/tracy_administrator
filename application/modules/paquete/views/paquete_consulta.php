<button type="button" class = "data btn volver" data-link="<?php echo base_url()?>paquete/principal">
	<span class = "glyphicon glyphicon-chevron-left"></span> Volver
</button>

<form method ="post" id = "form" class="form_consult" action="<?php echo base_url()?>hospedaje/consultar">

	<h2>Consulta de Paquetes</h2>
</form>

<table>
	<thead>
		<tr>
			<th>Tipo Paquete</th>
			<th>Fecha Inicio</th>
			<th>Fecha Fin</th>
			<th>Evento</th>
			<th>Citytour</th>
			<th>Transporte</th>
			<th>Creador</th>
			<th>Cupos</th>
			<th>Estado</th>
			<th>Modificar</th>
			<th>Detalle</th>
		</tr>
	</thead>
	
	<tbody>

		<?php if(!isset($paquete)){$paquete = array();}?>
		<?php if($paquete): ?>
				<?php foreach($paquete as $value):?>
					<tr>
						<td><?php echo $value->descripcion?></td>
						<td><?php echo $value->fecha_inicio?></td>
						<td><?php echo $value->fecha_fin?></td>
						<td><?php echo $value->Evento?></td>
						<td><?php echo $value->Citytour?></td>
						<td><?php echo $value->Transporte?></td>
						<td><?php echo $value->Creador?></td>
						<td><?php echo $value->cupos?></td>
						<td><?php echo ($value->estado) ?"Activo":"Inactivo" ?></td>
						<td>
							<a href="<?php echo site_url('paquete/modificar/'.$value->id)?>" class="update">
								<span class="glyphicon glyphicon-edit"></span>
							</a>
						</td>
						<td>
							<a href="<?php echo site_url('paquete/consultar/'.$value->id)?>" class="consultar">
								<span class="glyphicon glyphicon-list-alt"></span>
							</a>
						</td>
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

<?php if(isset($detalle)):?>
	<?php if($detalle):?>
		<h1>Habitaciones</h1>
		<table>
			<thead>
				<tr>
					<th>Habitacion</th>
					<th>Hospedaje</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($detalle as $value):?>
					<tr>
						<td><?php echo $value->nombre?></td>
						<td><?php echo $value->hospedaje?></td>
					</tr>
				<?php endforeach;?>					
			</tbody>
		</table>
	<?php else:?>
		<h1>No tiene habitaciones</h1>
	<?php endif;?>
<?php endif;?>
