<div>
	<div class="consulta">
		<form method ="post" action="<?php echo base_url()?>convenio/consultar_convenio_hospedaje">

			<div class="data_error">
				<?php echo validation_errors();?>
			</div>
			<button type="button" data-link="<?php echo base_url()?>convenio"><span></span>Volver</button>
			<h2>Consultar convenios</h2>
			<label for="txtNombre_convenio">Convenio *</label>
			<input type="search" name="txtNombre_convenio" id="txtNombre_convenio">

			<div class="groupButton">
				<button type="submit"><span></span>Buscar</button>
			</div>

		</form>

		<table>
			<thead>
				<tr>
					<th>Fecha del convenio</th>
					<th>Costo</th>
					<th>Venta</th>
				</tr>
			</thead>
			<tbody>
					<?php if(!isset($datos)){$datos = array();}?>
					<?php if($datos): ?>
					<?php foreach($datos as $value):?>
							<tr>
								<td><?php echo $value->fecha?></td>
								<td><?php echo $value->costo?></td>
								<td><?php echo $value->venta?></td>
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