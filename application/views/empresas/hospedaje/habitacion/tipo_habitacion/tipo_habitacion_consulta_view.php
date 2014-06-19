<div>		
	<div class="consulta">
				<form method ="post" action="">

			<button type="button" data-link="<?php echo base_url()?>tipo_habitacion"><span></span>Volver</button>

		</form>

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

				<?php if(!isset($datos)){$datos = array();}?>
				<?php if($datos): ?>
						<?php foreach($datos as $value):?>
							<tr>
								<td><?php echo $value->id?></td>
								<td><?php echo $value->nombre?></td>
								<td class="texto"><?php echo $value->descripcion?></td>
								<td><a href="<?php base_url()?>buscar/<?php echo $value->id?>" class="update"><span></span></a></td>
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

	</div>
</div>