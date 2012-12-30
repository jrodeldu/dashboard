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
            <h3>Moficiar datos de acceso</h3>
        </div>
        <div class="widget-content nopadding">

            <?php echo form_open($this->uri->uri_string, array('id' => 'editpass_form', 'class' => 'form-horizontal')); ?>
                    <?php if(validation_errors()){ ?>
                        <div class="alert alert-block alert-error">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <?php echo validation_errors(); ?>
                        </div>
                    <?php } ?>

                  <div class="control-group">
                    <label class="control-label" for="old">(*) Contraseña antigua:</label>
                    <div class="controls">
                      <input type="password" id="old" maxlength="30" name="old" placeholder="contraseña" title="Introduzca su contraseña" class="validate[required]" />
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label" for="new">(*) Contraseña nueva:</label>
                    <div class="controls">
                      <input type="password" id="new" maxlength="30" name="new" placeholder="contraseña" title="Introduzca su contraseña" class="validate[required]" />
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label" for="new_confirm">(*) Confirmar contraseña nueva:</label>
                    <div class="controls">
                      <input type="password" id="new_confirm" maxlength="30" name="new_confirm" placeholder="contraseña" title="Confirme su contraseña" class="validate[required]" />
                    </div>
                  </div>

                  <div class="form-actions">
                      <input type="submit" value="Guardar" class="btn btn-primary" value="Cambiar contraseña" title="Pulse para cambiar datos" />
                      <input type="button" class="btn" value="Cancelar" title="Pulse para cancelar esta tarea y volver atrás" onclick="location.href='http://www.it7.info/admin'" />
                  </div>

            <?php echo form_close(); ?>
        </div>
      </div>
      <!-- editar avatar -->
      <div class="widget">
        <div class="widget-header">
            <i class="icon-th-list"></i>
            <h3>Editar Avatar</h3>
        </div>
        <div class="widget-content nopadding">
          <?php if(validation_errors()){ ?>
                  <div class="alert alert-block alert-error">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <?php echo validation_errors(); ?>
                  </div>
              <?php } ?>

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
            <form name="imagenes" id="imagenes" class="form-horizontal" action="<?php echo base_url(); ?>admin/users/edit_avatar" method="post" enctype="multipart/form-data">
                    
                  <div class="control-group">
                    <img src="<?php echo base_url(); ?>assets/img/avatars/<?php echo $this->session->userdata('avatar'); ?>" alt="avatar">
                  </div>

                  <div class="control-group">
                    <p><input type="file" id="userfile" name="userfile" onchange="validar();" /></p>
                        <input name="txtNombre" type="hidden" value="" />
                  </div>

                  <div class="form-actions">
                      <input type="submit" value="Guardar" class="btn btn-primary" value="Cambiar contraseña" title="Pulse para cambiar datos" />
                      <input type="button" class="btn" value="Cancelar" title="Pulse para cancelar esta tarea y volver atrás" onclick="location.href='http://www.it7.info/admin'" />
                  </div>

            </form>
        </div>
      </div><!-- fin de la edicion del avatar -->
  </div>
</div>