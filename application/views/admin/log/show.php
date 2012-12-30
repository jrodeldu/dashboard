<p id="ruta"><span class="invisible">Está en</span> <?php echo anchor( site_url('admin/dashboard'), 'Gestor de UGT' ) ?> &gt; <?php echo anchor( site_url('admin/tareas'), 'Tareas' ) ?> &gt; <strong>Ver Tarea</strong></p>
<!-- contenidos -->
<div class="con">

  <h2 class="invisible">Gestión</h2>
  <h3></h3>
  <form id="noticia" name="noticia" action="<?php echo site_url( $this->uri->uri_string ) ?>" method="post" enctype="multipart/form-data">
  <!-- -->
    <fieldset>
      <legend>Ver una tarea</legend>
      <p>Los campos marcados con asterisco (*) son obligatorios.</p>
      <dl>
        <dt><label for="nombre">Nombre del Proyecto:</label></dt>
        <dd><?php echo $result[0]->proyecto ?></dd>
      </dl>
      <dl>
        <dt><label for="entradilla">Descripción breve:</label></dt>
        <dd><?php echo $result[0]->entradilla ?></dd>
      </dl>
      <dl>
        <dt><label for="tipo">Tipo de tarea</label></dt>
        <dd><?php echo $result[0]->tipo ?></dd>
      </dl>
      <dl>
        <dt><label for="estado">Estado de la tarea</label></dt>
        <dd><?php echo $result[0]->estado ?></dd>
      </dl>
      <dl>
        <dt><label for="prioridad">Prioridad de la tarea</label></dt>
        <dd><?php echo $result[0]->prioridad ?></dd>
      </dl>
      <dl>
        <dt><label for="descripcion">Descripción:</label></dt>
        <dd><p><?php echo $result[0]->descripcion ?></p></dd>
      </dl>
      <dl>
        <dt><label for="solucion">Solución:</label></dt>
        <dd><p><?php echo $result[0]->solucion ?></p></dd>
      </dl>
      <!-- Galeria -->
      <div class="espacio"></div>
    </fieldset>
    <fieldset class="botones">
      <input type="button" class="boton" value="Editar" title="Pulse para cancelar esta tarea y volver atrás" onclick="location.href='<?php echo base_url(); ?>admin/tareas/edit/<?php echo $result[0]->id ?>'" />
    </fieldset>
  </form>
</div>
<!-- interaccion -->
<div class="rel">
  
</div>