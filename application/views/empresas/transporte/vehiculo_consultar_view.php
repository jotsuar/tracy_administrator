<div>
	<div class="consulta">
		<form method ="post" action="<?php echo base_url()?>transporte/consultar_vehiculo">

			<div class="data_error">
				<?php echo validation_errors();?>
			</div>
			<button type="button" data-link="<?php echo base_url()?>transporte/vehiculo"><span></span>Volver</button>
			<h2>Consulta de vehiculo</h2>
			<label for="txt_Nombre">matricula *</label>
			<input type="search" name="txt_Nombre" id="txtNombre">

			<div class="groupButton">
				<button type="submit"><span></span>Buscar</button>
			</div>

		</form>

		<table>
			<thead>
				<tr>
					<th>Empresa</th>
					<th>Matricula</th>
					<th>tipo vehiculo</th>
					<th>Descripcion</th>
					<th>Cupos</th>
					<th>Estado</th>
					<th>Modificar</th>

				</tr>
			</thead>
			<tbody>
					<?php if(!isset($datos)){$datos = array();}?>
					<?php if($datos): ?>
					<?php foreach($datos as $value):?>
							<tr>
								
								<td><?php echo $value->nombre?></td>
								<td><?php echo $value->matricula?></td>
								<td><?php echo $value->nombres?></td>
								<td><?php echo $value->descripcion?></td>
								<td><?php echo $value->cupo_maximo?></td>
								<td><?php echo ($value->estado) ? "Activo":"Inactivo" ?></td>
								<td><a href="<?php base_url()?>buscar_vehiculo/<?php echo $value->id?>" class="update"><span></span></a></td>
						
							</tr>
						<?php endforeach;?>
						<?php else:?>
						<tr>
							<td colspan="7">
								<h1>No hay datos</h1>
							</td>
						</tr>
				<?php endif;?>
			</tbody>
		</table>

	</div>
</div>