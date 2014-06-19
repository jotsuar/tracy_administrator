<button type="button" class = "data btn volver" data-link="<?php echo base_url()?>additional_service">
	<span class = "glyphicon glyphicon-chevron-left"></span> Volver
</button>
<form method ="post" id="form" class="form_consult" action="<?php echo base_url()?>servicio/servicio_add/consultar">
	<div class="message error">
		<?php echo validation_errors();?>
	</div>

	<h2>Consulta de Servicios adicionales</h2>

	<label for="txtNombre">Nombre *</label>
	<input type="search" name="nombre" id="nombre">
	
	<div class="group_button">
		<button type="submit" class="btn_search btn"><span class="glyphicon glyphicon-search"></span></button>
	</div>	  
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
					<td><?php echo $value->tipo?></td>
					<td>
						<a href="<?php echo base_url()?>additional_service/buscar/<?php echo $value->id?>">
							<span class="glyphicon glyphicon-edit"></span>
						</a>
					</td>
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
