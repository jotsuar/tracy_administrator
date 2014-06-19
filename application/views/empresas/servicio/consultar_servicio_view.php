<div>
	<div class="consulta">
		<form method ="post" action="<?php echo base_url()?>servicio_add/consultar">
			<div class="data_error">
			<?php echo validation_errors();?>
			</div>
			<button type="button" data-link="<?php echo base_url()?>servicio_add"><span></span>Volver</button>
			<h2>Consulta de Servicios adicionales</h2>
			<label for="txtNombre">Nombre *</label>
			<input type="search" name="nombre" id="nombre">
			
			<div class="groupButton">
				<button type="submit"><span></span>Buscar</button>
			</div><br><br><br>
			
					<button type="button" data-link="<?php echo base_url()?>servicio_add/listar/1"><span></span>Listar por hospedaje</button>
					<button type="button" data-link="<?php echo base_url()?>servicio_add/listar/2"><span></span>Listar por Sitio Turistico</button>
			  
		</form>

		<table>
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Descripcion</th>
					<th>Tipo servicio</th>
					<th>Actualizar</th>
				</tr>
			</thead>
			<tbody>
					<?php if(!isset($datos)){$datos = array();}?>
					<?php if($datos): ?>
						<?php foreach($datos as $value):?>
							<tr>
								<td><?php echo $value->nombre?></td>
								<td><?php echo $value->descripcion?></td>
								<td><?php echo $value->nombres?></td>
								<td><a href="<?php echo base_url()?>servicio_add/buscar/<?php echo $value->id?>" class="update"><span></span></a></td>
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