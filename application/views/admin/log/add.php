<p id="ruta"><span class="invisible">Está en</span> <?php echo anchor( site_url('admin/dashboard'), 'Gestor de UGT' ) ?> &gt; <?php echo anchor( site_url('admin/tareas'), 'Tareas' ) ?> &gt; <strong>A&ntilde;adir noticia</strong></p>
<!-- contenidos -->
<div class="con">

  <h2 class="invisible">Gestión</h2>
  <h3></h3>
  <form id="noticia" name="noticia" action="<?php echo site_url( $this->uri->uri_string ) ?>" method="post" enctype="multipart/form-data">
  <!-- -->
    <fieldset>
      <legend>Añada una tarea</legend>
      <p>Los campos marcados con asterisco (*) son obligatorios.</p>
      <dl>
        <dt><label for="nombre">(*) Nombre del Proyecto:</label></dt>
        <dd><input type="text" id="proyecto" maxlength="255" name="proyecto" value="<?php echo set_value('proyecto'); ?>" title="Escriba el nombre del proyecto" class="text validate[required]" /></dd>
      </dl>
      <dl>
        <dt><label for="entradilla">(*) Descripción breve:</label></dt>
        <dd><input type="text" id="entradilla" maxlength="255" placeholder="" name="entradilla" value="<?php echo set_value('entradilla'); ?>" title="Escriba una descripción breve" class="text validate[required]"/></dd>
      </dl>
      <dl>
        <dt><label for="tipo">(*) Tipo de tarea</label></dt>
        <dd><select name="tipo" id="tipo" class="text validate[required]" >
          <option value=""></option>
          <option value="Programación">Programación</option>
          <option value="Diseño">Diseño</option>
          <option value="Otros">Otros</option>
        </select></dd>
      </dl>
      <dl>
        <dt><label for="estado">(*) Estado de la tarea</label></dt>
        <dd><select name="estado" id="estado" class="text validate[required]">
          <option value=""></option>
          <option value="Pendiente">Pendiente</option>
          <option value="En Progreso">En Progreso</option>
          <option value="Solucionado">Solucionado</option> 
        </select></dd>
      </dl>
      <dl>
        <dt><label for="prioridad">(*) Prioridad de la tarea</label></dt>
        <dd><select name="prioridad" id="prioridad" class="text validate[required]">
          <option value=""></option>
          <option value="Baja">Baja</option>
          <option value="Media">Media</option>
          <option value="Alta">Alta</option> 
        </select></dd>
      </dl>
      <dl>
        <dt><label for="descripcion">(*) Descripción:</label></dt>
        <dd><textarea id="content" name="descripcion" rows="15" cols="70" title="Escriba la descripción de la tarea" class="text validate[required]"><?php echo set_value('descripcion'); ?></textarea></dd>
      </dl>
      <dl>
        <dt><label for="solucion">(*) Solución:</label></dt>
        <dd><textarea id="content-2" name="solucion" rows="15" cols="70" title="Escriba la solución de la tarea" class=""><?php echo set_value('solucion'); ?></textarea></dd>
      </dl>
      <dl>
        <dt><label for="destinatarios">(*) Destinatarios (Correos separados por comas)</label></dt>
        <dd><input type="text" id="destinatarios" name="destinatarios" value="<?php echo set_value('destinatarios'); ?>" title="Introduzca los destinatarios separados por comas" class="" /></dd>
      </dl>
      <!-- Galeria -->
      <div class="espacio"></div>
    </fieldset>
    <fieldset class="botones">
      <input name="input" type="submit" class="boton" value="Guardar" title="Pulse para guardar la noticia" />
      <input type="button" class="boton" value="Cancelar" title="Pulse para cancelar esta tarea y volver atrás" onclick="location.href='http://www.it7.info/admin/tareas'" />
    </fieldset>
  </form>
</div>
<!-- interaccion -->
<div class="rel">
  
</div>