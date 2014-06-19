<button type="button" class="data btn volver" data-link="<?php echo base_url()."convenio/registrar/".$tipo_convenio?>">
	<span class = "glyphicon glyphicon-chevron-left"></span> Volver
</button>
<form method ="post" id="form" action="<?php echo base_url()."convenio/buscar/".$tipo_convenio?> ">

	<div class="message error">
		<?php echo validation_errors();?>
	</div>
	<h2>Consultar convenios</h2>

	<label for="Fecha Inicio">Fecha Inicio *</label>
	<input type="date" name="fecha_inicio" value="<?php echo set_value('fecha_inicio') ?>">
	<label for="Fecha Fin">Fecha Fin</label>			
	<input type="date" name="fecha_fin" value="<?php echo set_value('fecha_fin') ?>">
	<div class="group_button">
		<button type="submit" class="btn"><span class="glyphicon glyphicon-search"></span> Buscar</button>
	</div>
</form>

<table>
	<thead>
		<tr>
			<th>Numero Convenio</th>
			<th>Nombre Empresa</th>
			<th>Fecha convenio</th>
			<th>Fecha Inicio</th>
			<th>Fecha Fin</th>
			<th>Costo</th>
			<?php if ($tipo_convenio != 4):?>
			<th>Venta</th>
			<?php endif;?>
			<th>Estado</th>
			<th>Cambiar Estado</th>
		</tr>
	</thead>
	<tbody>
			<?php if(!isset($datos)){$datos = array();}?>
			<?php if($datos): ?>
			<?php foreach($datos as $value):?>
					<tr>
						<td><?php echo $value->numero_convenio?></td>
						<td><?php echo $value->nombre?>			</td>
						<td><?php echo $value->fecha?>			</td>
						<td><?php echo $value->fecha_inicio?>	</td>
						<td><?php echo $value->fecha_fin?>		</td>
						<td><?php echo $value->costo?>			</td>
						<?php if ($tipo_convenio != 4):?>
						<td><?php echo $value->venta?>			</td>
						<?php endif;?>
						<td><?php echo ($value->estado) ? "Activo":"Inactivo" ?></td>
						<td><a href="<?php echo base_url()?>convenio/cambiar_estado/<?php echo $value->id."/".$value->estado."/".$value->tipo_convenio?>" class="update"><span class="glyphicon glyphicon-edit"></span></a></td>
					</tr>
				<?php endforeach;?>
				<?php else:?>
				<tr>
					<td colspan="9">
						<h1>No hay datos</h1>
					</td>
				</tr>
		<?php endif;?>
	</tbody>
</table>