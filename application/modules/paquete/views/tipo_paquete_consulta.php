<button type="button" class = "data btn volver" data-link="<?php echo base_url()?>additional_service">
	<span class = "glyphicon glyphicon-chevron-left"></span> Volver
</button>


<table>
	<thead>
		<tr>
			<th>Numero de Tipo</th>
			<th>Nombre</th>
			<th>Actualizar</th>
		</tr>
	</thead>
	<tbody>
		<?php if(!isset($datos)){$datos = array();}?>
		<?php if($datos): ?>
			<?php foreach($datos as $value):?>
				<tr>
					<td><?php echo $value->id?></td>
					<td><?php echo $value->descripcion?></td>
					<td>
						<a href="<?php echo base_url()?>paquete/consultar_tipo/<?php echo $value->id?>">
							<span class="glyphicon glyphicon-edit"></span>
						</a>
					</td>
				</tr>
			<?php endforeach;?>
			<?php else:?>
			<tr>
				<td colspan="2">
					<h1>No hay datos</h1>
				</td>
			</tr>
		<?php endif;?>
	</tbody>
</table>
