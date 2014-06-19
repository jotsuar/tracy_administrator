<div>
	<div class="consulta">
		<form method ="post" action="<?php echo base_url()?>hospedaje/consultar">

			<h2>Consulta de hospedaje</h2>
			<label for="nombre">Nombre *</label>
			<input type="search" name="nombre" id="nombre">

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
					<th>Categoría</th>
					<th>Estado</th>
					<th>Modificar</th>
					<th>Detalle</th>
				</tr>
			</thead>
			<tbody>

				<?php if(!isset($hospedaje)){$hospedaje = array();}?>
				<?php if($hospedaje): ?>
						<?php foreach($hospedaje as $value):?>
							<tr>
								<td><?php echo $value->nit?></td>
								<td><?php echo $value->nombre?></td>
								<td><?php echo $value->direccion?></td>
								<td><?php echo $value->telefono?></td>
								<td><?php echo $value->categoria?></td>
								<td><?php echo ($value->estado) ?"Activo":"Inactivo" ?></td>
								<td><a href="<?php echo site_url('hospedaje/detalle/'.$value->id)?>" class="update"><span></span></a></td>
								<td><a href="<?php echo site_url('hospedaje/detalle_servicios_add/'.$value->id)?>" class="consultar"><span></span></a></td>
							</tr>
						<?php endforeach;?>
					<?php else:?>
					<tr>
						<td colspan="8">
							<h1>No hay datos</h1>
						</td>
					</tr>
				<?php endif;?>
			</tbody>
		</table>

		<?php if(isset($detalle)):?>
			<?php if($detalle):?>
				<h1>Servicio adicional</h1>
				<table>
					<thead>
						<tr>
							<th>ID</th>
							<th>Nombre</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($detalle as $value):?>
							<tr>
								<td><?php echo $value->id?></td>
								<td><?php echo $value->nombre?></td>
							</tr>
						<?php endforeach;?>					
					</tbody>
				</table>
			<?php else:?>
				<h1>No tiene servicios adicionales</h1>
			<?php endif;?>
		<?php endif;?>
	</div>
</div>