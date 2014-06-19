
		<form method ="post" action="<?php echo base_url()?>novedad/index" class="form_consult">

			<div class="data_error">
				<?php echo validation_errors();?>
			</div>

			<h2>Consulta de novedades</h2>
			<label for="parametro">Parametro de consulta *</label>
			<input type="search" name="parametro" id="nombre" placeholder="Identificacion, Nombres o Apellidos">

			<div class="group_button">
				<button type="submit" class="btn_search btn"><span class="glyphicon glyphicon-search"></span></button>
			</div>
		</form>
		<br>
		<br>
		<br>

		<table>
			<thead>
				<tr>
					<th>Numero Reserva</th>
					<th>Identificación</th>
					<th>Nombre</th>
					<th>Descripción Novedad</th>
					<th>Fecha </th>
					<th>Actualizar</th>
				
				</tr>
			</thead>
			<tbody>

					<?php if(!isset($datos)){$datos = array();}?>
					<?php if($datos): ?>
						<?php foreach($datos as $value):?>
							<tr>
								<td><?php echo $value->reservas?></td>
								<td><?php echo $value->identificacion?></td>
								<td><?php echo $value->nombres." ".$value->apellidos ?></td>
								<td><?php echo $value->descripcion?></td>
								<td><?php echo $value->fecha?></td>
								<td><a href="<?php echo base_url()?>novedad/buscar/<?php echo $value->id?>" ><span class="glyphicon glyphicon-edit"></span></a></td>
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

