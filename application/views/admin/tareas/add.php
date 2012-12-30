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
                <h3>Añada una tarea</h3>
            </div>
            <div class="widget-content nopadding">
                <form id="tarea" name="tarea" class="form-horizontal myform" action="<?php echo base_url( $this->uri->uri_string ) ?>" method="post" enctype="multipart/form-data">
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
                        <label class="control-label" for="tipo">(*) Tipo de tarea</label>
                        <div class="controls">
                            <select name="tipo" id="tipo" class="text validate[required]" >
                              <option value=""></option>
                              <option value="Programación">Programación</option>
                              <option value="Diseño">Diseño</option>
                              <option value="Otros">Otros</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="estado">(*) Estado de la tarea</label>
                        <div class="controls">
                          <select name="estado" id="estado" class="text validate[required]">
                            <option value=""></option>
                            <option value="Pendiente">Pendiente</option>
                            <option value="En Progreso">En Proceso</option>
                            <option value="Solucionado">Solucionado</option>
                          </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="prioridad">(*) Prioridad de la tarea</label>
                        <div class="controls">
                            <select name="prioridad" id="prioridad" class="text validate[required]">
                              <option value=""></option>
                              <option value="Baja">Baja</option>
                              <option value="Media">Media</option>
                              <option value="Alta">Alta</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="nombre">Horas:</label>
                        <div class="controls">
                            <input type="text" id="horas" maxlength="4" name="horas" value="<?php echo set_value('horas'); ?>" title="Escriba las horas dedicadas al proyecto" class="" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="descripcion">(*) Descripción:</label>
                        <div class="controls">
                          <textarea id="content" name="descripcion" rows="15" cols="70" title="Escriba la descripción de la tarea" class="text validate[required]"><?php echo set_value('descripcion'); ?></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="solucion">Solución:</label>
                        <div class="controls">
                          <textarea id="content-2" name="solucion" rows="15" cols="70" title="Escriba la solución de la tarea" class=""><?php echo set_value('solucion'); ?></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="destinatarios">Destinatarios:</label>
                        <div class="controls">
                            <select name="destinatarios[]" id="destinatarios" multiple="multiple" class="valid span5">
                                <option value="jrodeldu@gmail.com">jrodeldu@gmail.com</option>
                                <option value="miranda.hidalgo.carlos@gmail.com">miranda.hidalgo.carlos@gmail.com</option>
                                <option value="it7.marta@gmail.com">it7.marta@gmail.com</option>
                                <option value="micheljorgemillares@gmail.com">micheljorgemillares@gmail.com</option>
                            </select><span for="multiSelection" generated="true" class="help-inline" style=""></span>
                        </div>
                    </div>
                    <!-- <div class="control-group">
                        <label class="control-label" for="destinatarios">Destinatarios (Correos separados por comas)</label>
                        <div class="controls">
                          <input type="text" id="destinatarios" name="destinatarios" value="<?php //echo set_value('destinatarios'); ?>" title="Introduzca los destinatarios separados por comas"/>
                        </div>
                    </div> -->

                    <div class="form-actions">
                        <input type="submit" value="Guardar" class="btn btn-primary" value="Guardar" title="Pulse para guardar los cambios" />
                        <input type="button" class="btn" value="Cancelar" title="Pulse para cancelar esta tarea y volver atrás" onclick="location.href='http://www.it7.info/admin/tareas'" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>