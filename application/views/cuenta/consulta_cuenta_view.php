<div>
	<div class="consulta">
		<form method ="post" action="<?php echo base_url().$action?>">

			<div class="data_error">
				<?php echo validation_errors();?>
			</div>
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
					<th>Identificación</th>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>Usuario</th>
					<th>Contraseña</th>
					<th>Actualizar</th>
				</tr>
			</thead>
			<tbody>

					<?php if(!isset($datos)){$datos = array();}?>
					<?php if($datos): ?>
						<?php foreach($datos as $value):?>
							<tr>
							
								<td><?php echo $value->identificacion?></td>
								<td><?php echo $value->nombres?></td>
								<td><?php echo $value->apellidos?></td>
								<td><?php echo $value->email?></td>
								<td><?php echo $value->identificacion?></td>
								<td><a href="<?php base_url()?>buscar/<?php echo $value->id?>" class="update"><span></span></a></td>
							</tr>
						<?php endforeach;?>
					<?php else:?>
						<tr>
							<td colspan="6"> 

								<h1>No hay datos</h1>
							</td>
						
						</tr>
					<?php endif;?>
			</tbody>
		</table>

	</div>
</div>