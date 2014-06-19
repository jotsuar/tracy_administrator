<button type="button" class = "data btn volver" data-link="<?php echo base_url()?>sitio_turistico/tipo_turismo">
	<span class = "glyphicon glyphicon-chevron-left"></span> Volver
</button>

<table>
<thead>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th>Descripción</th>
		<th>Actualizar</th>
	</tr>
</thead>
<tbody>
	<?php if($data): ?>
		<?php foreach($data as $value):?>
			<tr>
				<td><?php echo $value->id?></td>
				<td><?php echo $value->nombre?></td>
				<td><?php echo $value->descripcion?></td>
				<td>
				<a href="<?php base_url()?>modificar/<?php echo $value->id?>" class="update">
					<span class="glyphicon glyphicon-edit"></span>
				</a>
				</td>
			</tr>
		<?php endforeach;?>
	<?php else:?>
			<tr>
				<td colspan="4"><h1>No hay datos</h1></td>
			</tr>
	<?php endif;?>
</tbody>
</table>