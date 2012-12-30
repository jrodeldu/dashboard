      <div class="span9">
        <div class="row-fluid">
          <h1 class="page-title">
            <i class="icon-tasks icon-white"></i>
            Tareas
          </h1>
          <div class="hero-unit">
            <h1>Tareas e Incidencias</h1>
            <p>Creación, seguimiento de incidencias en los proyectos. Se puede establecer prioridad, mandar por -Email y guardar un registro con la solución aplicada a cada incidencia.</p>
            </div>
          </div>
        <div class="row-fluid">
          <div class="spa12">
            <div id="no-more-tables" class="widget">
              <div class="widget-header">
                <i class="icon-th"></i>
                <h3>Listado de tareas</h3>
                <a class="btn btn-primary pull-right" href="<?php echo base_url(); ?>admin/tareas/add">Nueva tarea</a>
              </div>
              <div class="widget-content">
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
                <table id="mytable" class="table table-bordered table-striped table-condensed cf table-hover">
                <!--<table id="mytable" width="100%" class="table">-->
                  <thead class="cf">
                    <tr>
                      <th>ID</th>
                      <th>Proyecto</th>
                      <th>Descripcion</th>
                      <th>Tipo</th>
                      <th>Estado</th>
                      <th>Fecha inicio</th>
                      <th>Fecha fin</th>
                      <th>Editar</th>
                      <th>Borrar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($tareasList as $tareas) { ?>
                    <tr class="gradeA">
                      <td data-title="ID"><?php echo $tareas->id ?></td>
                      <td data-title="Proyecto"><a href="<?php echo base_url(); ?>admin/tareas/show/<?php  echo $tareas->id ?>"><?php echo $tareas->proyecto ?></a></td>
                      <td data-title="Descripcion"><?php echo $tareas->entradilla ?></td>
                      <td data-title="Tipo"><?php echo $tareas->tipo ?></td>
                      <td data-title="Estado"><?php echo $tareas->estado ?></td>
                      <td data-title="Fecha inicio"><?php echo date("d-m-Y",strtotime($tareas->f_inicio)) ?></td>
                      <?php if( ! $tareas->f_fin ){ ?>
                      <td></td>
                      <?php }else { ?>
                      <td data-title="Fecha fin"><?php echo date("d-m-Y",strtotime($tareas->f_fin)); ?> </td>
                      <?php } ?>
                      <td data-title="Editar"><?php echo anchor( base_url('admin/tareas/edit/'.$tareas->id), '<img src="../assets/images/admin/ico/mod.gif" alt="Modificar" width="15" />', array('titulo' => 'Modifique esta tarea') ) ?></td>
                      <?php if($tareas->estado == 'Solucionado') { ?>
                      <td></td>
                      <?php }else { ?>
                      <td data-title="Eliminar"><?php echo anchor( base_url('admin/tareas/drop/'.$tareas->id), '<img src="../assets/images/admin/ico/del.gif" alt="Borrar" width="14" />', array('onclick' => 'return confirm(\'¿Quieres borrar esta tarea?\')')) ?></td>
                      <?php } ?>
                    </tr>
                    <?php } ?>
                  </tbody>

                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Proyecto</th>
                      <th>Descripcion</th>
                      <th>Tipo</th>
                      <th>Estado</th>
                      <th>Fecha inicio</th>
                      <th>Fecha fin</th>
                      <th>Editar</th>
                      <th>Borrar</th>
                    </tr>
                  </tfoot>

                </table>

              </div>
            </div>
          </div><!--/span-->
        </div><!-- /row -->
      </div> <!-- End Widget -->