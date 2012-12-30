<div class="span9">
    <div class="row-fluid">
        <h1 class="page-title">
            <i class="icon-tasks icon-white"></i>
            Saneamiento y marca de agua
        </h1>
    </div>
    <div class="row-fluid">
        <div class="widget">
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
            <div class="widget-header">
                <i class="icon-comment"></i>
                <h3><?php echo $titulo; ?></h3>
            </div>
            <form name="imagenes" id="imagenes" action="<?php echo base_url(); ?>admin/saneamiento/upload" method="post" enctype="multipart/form-data">
            <div class="widget-content nopadding">
                    <div class="ganttpadding">        
                        <p><label for="userfile">Imagen Noticia:</label></p>
                        <p><input type="file" id="userfile" name="userfile" onchange="validar();" /></d>
                        <input name="txtNombre" type="hidden" value="" />
                    </div>
                <div class="form-actions">
                    <input type="submit" value="Enviar" class="btn btn-primary"/>
                    <input type="button" class="btn" value="Cancelar" title="Pulse para cancelar esta tarea y volver atrás" onclick="location.href='http://www.it7.info/admin'" />
                </div>
            </div>
            </form>
        </div>
    </div>
</div><!-- span end widget -->