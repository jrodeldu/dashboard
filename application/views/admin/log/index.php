    <?php
      if ($this->session->flashdata('success') != '' || $this->session->flashdata('success') != NULL ){
    ?>
      <div class="success-message">
          <?php echo $this->session->flashdata('success'); ?>
      </div>
    <?php
      }
    ?>

    <?php
      if ($this->session->flashdata('error') != '' || $this->session->flashdata('error') != NULL ){
    ?>
      <div class="error-message">
          <?php echo $this->session->flashdata('error'); ?>
      </div>
    <?php
      }
    ?>
      <div class="span9">
        <div class="row-fluid">
          <h1 class="page-title">
            <i class="icon-user icon-white"></i>
            Log
          </h1>
          <div class="hero-unit">
            <h1>Registro de actividad</h1>
            <p>Control de la actividad realizada por el usuario dentro del Dashboard. Podemos acceder a una ficha descriptiva del ID afectado si está disponible en la BBDD.</p>
            </div>
          </div>
        <div class="row-fluid">
          <div class="spa12">
            <div class="widget">
              <div class="widget-header">
                <i class="icon-th"></i>
                <h3>Listado de actividad</h3>
              </div>
              <div class="widget-content">
              <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover table-bordered" id="mytable">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>ID User</th>
                      <th>Accion</th>
                      <th>Tabla</th>
                      <th>ID Tabla</th>
                      <th>Fecha</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($logList as $row) { ?>
                    <tr class="gradeA">
                      <td><?php echo $row->id ?></td>
                      <td><?php echo $row->id_user ?></a></td>
                      <td><?php echo $row->accion ?></td>
                      <td><?php echo $row->tabla ?></td>
                      <?php if($row->id_tabla == NULL) { ?>
                        <td></td>
                      <?php }else{ ?>
                          <td><a href="<?php echo base_url(); ?>admin/<?php echo $row->tabla; ?>/show/<?php echo $row->id_tabla; ?>"><?php echo $row->id_tabla ?></a></td>
                      <?php } ?>
                      <td><?php echo date("d-m-Y, H:i",strtotime($row->created_at)) ?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>ID User</th>
                      <th>Accion</th>
                      <th>Tabla</th>
                      <th>ID Tabla</th>
                      <th>Fecha</th>
                    </tr>
                  </tfoot>
              </table>

              </div>
            </div>
          </div><!--/span-->
        </div><!-- /row -->
      </div> <!-- End Widget -->