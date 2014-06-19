<div>
	<div class="consulta">
		<form method ="post" action="<?php echo base_url().$action?>">

			<div class="data_error">
				<?php echo validation_errors();?>
			</div>
			<button type="button" data-link="<?php echo base_url()?>empleado"><span></span>Volver</button>
			<h2><?php echo $title ?></h2>
			<label for="parametro">Parametro de consulta *</label>
			<input type="search" name="parametro" id="parametro" placeholder="Identificacion, Nombres o Apellidos">

			<div class="groupButton">
				<button type="submit"><span></span>Buscar</button>
			</div>

		</form>

		<table>
			<thead>
				<tr>
					<th>Tipo Identificacion</th>
					<th>Identificación</th>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>Teléfono</th>
					<th>Celular</th>
					<th>Email</th>
						<?php  if ($fecha):?>
					<th>Fecha Nacimiento</th>
				<?php endif?>
					<th>Actualizar</th>
				
				</tr>
			</thead>
			<tbody>

					<?php if(!isset($datos)){$datos = array();}?>
					<?php if($datos): ?>
						<?php foreach($datos as $value):?>
							<tr>
								<td><?php echo $value->tipo_documento?></td>
								<td><?php echo $value->identificacion?></td>
								<td><?php echo $value->nombres?></td>
								<td><?php echo $value->apellidos?></td>
								<td><?php echo $value->telefono?></td>
								<td><?php echo $value->celular?></td>
								<td><?php echo $value->email?></td>
								<?php  if ($fecha):?>
								<th><?php echo $value->fecha_nacimiento?></th>
								<?php endif?>
								<td><a href="<?php base_url()?>buscar/<?php echo $value->id?>" class="update"><span></span></a></td>
							</tr>
						<?php endforeach;?>
						<?php else:?>
						<tr>
							<?php  if ($fecha):?>
								<<td colspan="9">
								<h1>No hay datos</h1>
							</td>
							<?php else:?>
							<td colspan="8">
								<h1>No hay datos</h1>
							</td>
						<?php endif?>
						</tr>
					<?php endif;?>
			</tbody>
		</table>

	</div>
</div>