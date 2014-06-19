<div>
	<div class="consulta">
		<form method ="post" action="<?php echo base_url()?>banco/consultar">

			<div class="data_error">
				<?php echo validation_errors();?>
			</div>
			<button type="button" data-link="<?php echo base_url()?>banco/registrar"><span></span>Volver</button>
			<h2>Consulta de banco</h2>
			<label for="txtNombre">Nombre *</label>
			<input type="search" name="txtNombre" id="txtNombre">

			<div class="groupButton">
				<button type="submit"><span></span>Buscar</button>
			</div>

		</form>

		<table>
			<thead>
				<tr>
					<th>Nit</th>
					<th>Nombre</th>
					<th>Dirección</th>
					<th>Teléfono</th>
					<th>Número cuenta</th>
					<th>Estado</th>
					<th>Actualizar</th>
				</tr>
			</thead>
			<tbody>

					<?php if(!isset($datos)){$datos = array();}?>
					<?php if($datos): ?>
						<?php foreach($datos as $value):?>
							<tr>
								<td><?php echo $value->nit?></td>
								<td><?php echo $value->nombre?></td>
								<td><?php echo $value->direccion?></td>
								<td><?php echo $value->telefono?></td>
								<td><?php echo $value->numero_cuenta?></td>
								<td><?php echo ($value->estado) ? "Activo":"Inactivo" ?></td>
								<td><a href="<?php base_url()?>buscar/<?php echo $value->id?>" class="update"><span></span></a></td>
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