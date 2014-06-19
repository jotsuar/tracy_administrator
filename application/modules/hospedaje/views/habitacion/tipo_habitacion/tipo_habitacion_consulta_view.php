<button type="button" class = "data btn volver" data-link="<?php echo base_url()?>hospedaje/tipo_habitacion">
	<span class = "glyphicon glyphicon-chevron-left"></span> Volver
</button>
<form method ="post" id = "form" action="">
	<h2>Lista tipo de habitaciones</h2>
</form>

<table>

	<thead>
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>Cupo Maximo</th>
			<th>Descripción</th>			
			<th>Actualizar</th>
		</tr>
	</thead>

	<tbody>
		<?php if(!isset($datos)){$datos = array();}?>
		<?php if($datos): ?>
				<?php foreach($datos as $value):?>
					<tr>
						<td><?php echo $value->id?></td>
						<td><?php echo $value->nombre?></td>
						<td><?php echo $value->cupo_maximo?></td>
						<td class="texto"><?php echo $value->descripcion?></td>
						<td>
							<a href="<?php base_url()?>buscar/<?php echo $value->id?>" class="update">
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