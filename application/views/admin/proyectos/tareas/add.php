<div class="span9">
    <div class="row-fluid">
        <h1 class="page-title">
            <i class="icon-th-list icon-white"></i>
            Formulario
        </h1>
    </div>
    <div class="row-fluid">
        <div class="widget">
            <div class="widget-header">
                <i class="icon-th-list"></i>
                <h3>Añada una Lista de Tareas</h3>
            </div>
            <div class="widget-content nopadding">
                <form id="list_tarea" name="list_tarea" class="form-horizontal" action="<?php echo base_url( $this->uri->uri_string ) ?>" method="post" enctype="multipart/form-data">
                    <?php if(validation_errors()){ ?>
                        <div class="alert alert-block alert-error fade in">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <?php echo validation_errors(); ?>
                        </div>
                    <?php } ?>
                    <div class="control-group">
                        <label class="control-label" for="nombre_lista">(*) Nombre de la lista:</label>
                        <div class="controls">
                            <input type="text" id="nombre_lista" maxlength="255" name="nombre_lista" value="<?php echo set_value('proyecto'); ?>" title="Escriba el nombre del proyecto" class="text validate[required]" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="descripcion">Descripción:</label>
                        <div class="controls">
                            <textarea id="content-2" name="descripcion" rows="15" cols="70" title="Escriba la solución de la tarea" class=""></textarea>
                        </div>
                    </div>
                    <div class="form-actions">
                        <input type="submit" value="Guardar" class="btn btn-primary" value="Guardar" title="Pulse para guardar los cambios" />
                        <input type="button" class="btn" value="Cancelar" title="Pulse para cancelar esta tarea y volver atrás" onclick="location.href='http://www.it7.info/admin/tareas'" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>