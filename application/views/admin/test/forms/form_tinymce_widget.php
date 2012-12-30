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
                <h3>Validación de formularios con Tiny MCE (JavaScript)</h3>
            </div>
            <div class="widget-content nopadding">
                <form id="prueba" name="prueba" class="form-horizontal myform" action="" method="post" enctype="multipart/form-data">
                    <?php if(validation_errors()){ ?>
                        <div class="alert alert-block alert-error fade in">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <?php echo validation_errors(); ?>
                        </div>
                    <?php } ?>
                    <div class="control-group">
                        <label class="control-label" for="proyecto">(*) Nombre del Proyecto:</label>
                        <div class="controls">
                            <input type="text" id="proyecto" maxlength="255" name="proyecto" value="<?php echo set_value('proyecto'); ?>" title="Escriba el nombre del proyecto" class="text validate[required]" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="entradilla">(*) Descripción breve:</label>
                        <div class="controls">
                            <input type="text" id="entradilla" maxlength="255" placeholder="" name="entradilla" value="<?php echo set_value('entradilla'); ?>" title="Escriba una descripción breve" class="text validate[required]"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="descripcion">(*) Descripción:</label>
                        <div class="controls">
                          <textarea id="content" name="descripcion" rows="15" cols="70" title="Escriba la descripción de la tarea" class="text validate[required]"><?php echo set_value('descripcion'); ?></textarea>
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