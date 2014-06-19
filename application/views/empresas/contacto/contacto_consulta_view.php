<div>
	<div class="consulta">
		<form method ="post" action="<?php echo base_url()?>contacto/consultar_contacto">

			<div class="data_error">
				<?php echo validation_errors();?>
			</div>
			<button type="button" data-link="<?php echo base_url()?>contacto/registro_contacto_evento"><span></span>Volver</button>
			<h2>Consulta de contacto</h2>
			<label for="txt_Nombre">Nombre *</label>
			<input type="search" name="txt_Nombre" id="txt_Nombre">

			<div class="groupButton">
				<button type="submit"><span></span>Buscar</button>
			</div>

		</form>

		<table>
			<thead>
				<tr>
					<th>Nombre evento</th>
					<th>Identificacion</th>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Celular</th>
					<th>Email</th>
					<th>Estado</th>
				</tr>
			</thead>
			<tbody>
					<?php if(!isset($date)){$date = array();}?>
					<?php if($date): ?>
					
					<?php foreach($date as $value):?>
							<tr>
								<td><?php echo $value->nombre?></td>
								<td><?php echo $value->identificacion?></td>
								<td><?php echo $value->nombres?></td>
								<td><?php echo $value->apellidos?></td>
								<td><?php echo $value->celular?></td>
								<td><?php echo $value->email?></td>
								<td><?php echo ($value->estado) ? "Activo":"Inactivo" ?></td>
								<td><a href="<?php base_url()?>buscar_contacto/<?php echo $value->codigo?>" class="update"><span></span></a></td>
						
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

	</div>
</div>