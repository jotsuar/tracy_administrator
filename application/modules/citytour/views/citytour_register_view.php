<form method ="post" id = "form" class="form" action="<?php echo base_url()?>citytour/registro">
    <?php if(isset($success) && $success):?>
        <div class = "message success">
            <p>Registro realizado correctamente</p>
        </div>
    <?php else:?>
        <div class="message error">
            <?php echo validation_errors();?>
        </div>
    <?php endif;?>
    <h2>Registro de City tour</h2>

    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" 
    value="<?php echo (isset($success) && $success) ? '' : set_value('nombre')?>" />

    <label for="fecha">Fecha *</label>
    <input type="date" name="fecha" id="fecha" 
    value = "<?php echo (isset($success) && $success) ? '' : set_value('fecha')?>" />

    <label for="hora_inicio">Hora inicio *</label>
    <input type="time" name="hora_inicio" id="hora_inicio" 
    value="<?php echo (isset($success) && $success) ? '' : set_value('hora_inicio')?>"/>

    <label for="hora_final">Hora final *</label>
    <input type="time" name="hora_final" id="hora_final" 
    value="<?php echo (isset($success) && $success) ? '' : set_value('hora_final')?>"/>

    <label for="direccion">Dirección de salida*</label>
    <input type="text" name="direccion" id="direccion" 
    value="<?php echo (isset($success) && $success) ? '' : set_value('direccion')?>"/>

    <label for="cupos">Cupos*</label>
    <input type="number" name="cupos" id="cupos" 
    value="<?php echo (isset($success) && $success) ? '' : set_value('cupos')?>"/>

    <label for="precio">Precio*</label>
    <input type="text" class="money" name="precio" id="precio" placeholder="$$$$$$$" 
    value="<?php echo (isset($success) && $success) ? '' : set_value('precio')?>"/>

    <?php if(isset($sitios_turisticos) && $sitios_turisticos):?>
        <fieldset>
            <legend>Sitios turísticos</legend>
            <?php foreach($sitios_turisticos as $sitio_turistico):?>
                <label for="<?php echo strtolower("check_" . str_replace(' ', '_', $sitio_turistico->nombre))?>">
                    <input type="checkbox" name ="check_sitios_turisticos[]" 
                    id="<?php echo strtolower("check_" . strtr($sitio_turistico->nombre, ' ', '_'))?>" 
                    value="<?php echo $sitio_turistico->id?>" id ="restaurante"/>
                    <?php echo ucwords(strtolower($sitio_turistico->nombre))?>
                </label>
            <?php endforeach;?>
        </fieldset>
    <?php else:?>
        <p>No hay sitios turísticos</p>
    <?php endif;?>

    <div class = "group_button">
        <button type="button" class="data btn" data-link= "<?php echo base_url()?>citytour/consulta">
            <span class = "glyphicon glyphicon-list-alt"></span> Consultar
        </button>
        <button class = "btn" type = "submit" name = "btn_save">
            <span class = "glyphicon glyphicon-floppy-disk"></span> Guardar
        </button>
    </div>
</form>