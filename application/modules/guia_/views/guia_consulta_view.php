<div>
	<div class="consulta">
		<form method ="post" action="<?php echo base_url()?> ">
			<button type="button" data-link="<?php echo base_url()."guia/index/"?>"><span></span>Volver</button>	
			<div class="data_error">
				<?php echo validation_errors();?>
			</div>
		</form>
		
		<h1>Lista Guia Turisticos</h1>
		<table>
			<thead>
				<tr>
					<th>Identificacion</th>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>Telefono</th>
					<th>Celular</th>
					<th>email</th>
					<th>Estado</th>
					<th>Idiomas que habla</th>
					<th>Actualizar</th>
				</tr>
			</thead>
			<tbody>
				<?php if($datos): ?>
				
						<?php foreach($datos as $value):?>
							<tr>
								<td><?php echo $value->identificacion?></td>
								<td><?php echo $value->nombre?></td>
								<td><?php echo $value->apellido?></td>
								<td><?php echo $value->telefono?></td>
								<td><?php echo $value->celular?></td>
								<td><?php echo $value->email?></td>
								<td><?php echo ($value->estado) ? "Activo":"Inactivo" ?></td>
								<td>
									<?php foreach($idiomas as $values):?>
										<?php
												if($value->id==$values->id_guia_turistico)
												echo $values->nombre."\t";
										?>
									<?php endforeach;?>
								</td>
								
								<td><a href="<?php echo base_url()."guia/consultar_guia/".$value->id ?>" class="update"><span></span></a></td>
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