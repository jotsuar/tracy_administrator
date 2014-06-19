<div>
	<div class="consulta">
		<form method ="post" action="<?php echo base_url()?>transporte/consultar_tipo_vehiculo">

			<div class="data_error">
				<?php echo validation_errors();?>
			</div>
			<button type="button" data-link="<?php echo base_url()?>transporte/tipo_vehiculo"><span></span>Volver</button>
			<h2>Consulta de tipo de vehiculo</h2>
			<label for="nombre">Nombre *</label>
			<input type="search" name="nombre" id="nombre"/>

			<div class="groupButton">
				<button type="submit"><span></span>Buscar</button>
			</div>

		</form>

		<table>
			<thead>
				<tr>
					<th>nombre</th>
					<th>Modificar</th>

				</tr>
			</thead>
			<tbody>
					<?php if(!isset($datos)){$datos = array();}?>
					<?php if($datos): ?>
					<?php foreach($datos as $value):?>
							<tr>
								<td><?php echo $value->nombre?></td>
								<td><a href="<?php base_url()?>buscar_tipo_vehiculo/<?php echo $value->id?>" class="update"><span></span></a></td>
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

	</div>
</div>