<?php
setlocale(LC_ALL,"es_ES@euro","es_ES.utf8","esp");
?>

<div class="span9">
    <div class="row-fluid">
        <div class="span12">
            <h1 class="page-title">
                <i class="icon-tasks icon-white"></i>
                Tarea
            </h1>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <div class="widget-header">
                    <i class="icon-comment"></i>
                    <h3>Descripción de la Tarea: <?php echo $result->entradilla ?></h3>
                </div>
                <div class="widget-content nopadding">
                    <input id="id_tarea" type="hidden" value="<?php echo $result->id; ?>">
                    <dl class="dl-horizontal ficha">
                        <dt>Nombre del Proyecto:</dt>
                        <dd><?php echo $result->proyecto ?></dd>
                        <dt>Descripción breve:</dt>
                        <dd><?php echo $result->entradilla ?></dd>
                        <dt>Tipo de tarea</dt>
                        <dd><?php echo $result->tipo ?></dd>
                        <dt>Estado de la tarea</dt>
                        <dd><?php echo $result->estado ?></dd>
                        <dt>Prioridad de la tarea</dt>
                        <dd><?php echo $result->prioridad ?></dd>
                        <dt>Horas:</dt>
                        <dd><p><?php echo $result->horas ?></p></dd>
                        <dt>Descripción:</dt>
                        <dd><p><?php echo $result->descripcion ?></p></dd>
                        <dt>Solución:</dt>
                        <dd><p><?php echo $result->solucion ?></p></dd>
                    </dl>
                    <div class="form-actions">
                        <a class="btn btn-primary" href="<?php echo base_url(); ?>admin/tareas/edit/<?php echo $result->id ?>">Editar</a>
                        <input type="button" class="btn" value="Cancelar" title="Pulse para cancelar esta tarea y volver atrás" onclick="location.href='http://www.it7.info/admin/tareas'" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <div class="widget-header">
                    <i class="icon-comment"></i>
                    <h3>Comentarios</h3>
                </div>
                <div class="widget-content nopadding">
                    <?php
                      if ($this->session->flashdata('success') != '' || $this->session->flashdata('success') != NULL ){
                    ?>
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Bien hecho!</strong> <?php echo $this->session->flashdata('success'); ?>
                      </div>
                    <?php
                      }
                    ?>

                    <?php
                      if ($this->session->flashdata('error') != '' || $this->session->flashdata('error') != NULL ){
                    ?>
                      <div class="alert alert-error">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Algo ha salido mal!</strong> <?php echo $this->session->flashdata('error'); ?>
                      </div>
                    <?php
                      }
                    ?>
                    <div id="msg"></div>
                    <form id="add_comentario" action="<?php echo base_url(); ?>admin/tarea_comentario/add/<?php echo $this->uri->segment(4); ?>" method="post" class="AdvancedForm form-horizontal">
                        <div class="control-group">
                            <label class="control-label" for="campo">Nuevo comentario: </label>
                            <div class="controls">
                                <input id='comentario_tarea' class="span9" name="comentario_tarea" maxlength="255" type="text" placeholder="Comentario..." title="Escriba un comentario" >
                                <!--<textarea id="content" name="comentario" rows="1" title="Escriba un comentario" class="text validate[required]"><?php echo set_value('comentario'); ?></textarea>-->
                           </div>
                        </div>
                    </form>
                    <div id="comments"><?php $this->load->view('admin/tareas/comments'); ?></div>
                </div>
            </div>
        </div> <!-- span -->
    </div> <!-- row -->
</div><!-- span end widget -->

<script type="text/javascript" src="<?php echo base_url();?>assets/js/admin/comentarios_wall/comentarios_wall.js"></script>