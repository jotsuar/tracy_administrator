<button type="button" class="data btn volver" data-link="<?php echo base_url()?>hospedaje/habitacion">
	<span class = "glyphicon glyphicon-chevron-left"></span> Volver
</button>

<h2>Lista Habitaciones</h2>
<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Tipo</th>
			<th>Comodidades</th>
			<th>Hospedaje</th>
			<th>Cantidad</th>
			<th>Valor</th>
			<th>Actualizar</th>
		</tr>
	</thead>
	<tbody>
		<?php if($datos): ?>
			<?php foreach($datos as $value):?>
				<tr>
					<td><?php echo $value->id?></td>
					<td><?php echo $value->tipo?></td>
					<td><?php echo $value->comodidades?></td>
					<td><?php echo $value->hospedaje?></td>
					<td><?php echo $value->cantidad?></td>
					<td><?php echo $value->valor?></td>
					<td>
						<a href="buscar/<?php echo $value->id?>" class="update">
							<span class="glyphicon glyphicon-edit"></span>
						</a>
					</td>
				</tr>
			<?php endforeach;?>
			<?php else:?>
			<tr>
				<td colspan="6">
					<h1>No hay datos</h1>
				</td>
			</tr>
		<?php endif;?>
	</tbody>
</table>