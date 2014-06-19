<button type="button" class = "data btn volver" data-link="<?php echo base_url()?>hospedaje/categoria">
	
	<span class = "glyphicon glyphicon-chevron-left"></span> Volver
</button>
<h2>Lista categorías</h2>
<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Categoría</th>
			<th>Descripción</th>
			<th>Actualizar</th>
		</tr>
	</thead>
	<tbody>
		<?php if($categories): ?>
			<?php foreach($categories as $value):?>
				<tr>
					<td><?php echo $value->id?></td>
					<td><?php echo $value->categoria?></td>
					<td><?php echo $value->descripcion?></td>
					<td>
						<a href="<?php base_url()?>buscar_categoria/<?php echo $value->id?>" class="update">
							<span class="glyphicon glyphicon-edit"></span>
						</a>
					</td>
				</tr>
			<?php endforeach;?>
			<?php else:?>
			<tr>
				<td colspan="4">
					<h1>No hay datos</h1>
				</td>
			</tr>
		<?php endif;?>
	</tbody>
</table>
