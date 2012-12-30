<script type="text/javascript">
jQuery(function() {
  jQuery('#finicio, #ffin').datepicker();
  
  jQuery('#finicio, #ffin').datepicker('option', {
    beforeShow: customRange
  });
});

function customRange(input) {
  if (input.id == 'ffin') {
    return {
      minDate: jQuery('#finicio').datepicker("getDate")
    };
  } else if (input.id == 'finicio') {
    return {
      maxDate: jQuery('#ffin').datepicker("getDate")
    };
  }
}
</script>
<div class="span9">
	<div class="row-fluid">
		<h1 class="page-title">
			<i class="icon-calendar icon-white"></i>
			Calendario
		</h1>
	</div>
	<div class="row-fluid">
		<div class="widget">
			<div class="widget-header">
				<i class="icon-calendar"></i>
				<h3>Calendario</h3>
				<a class="btn btn-primary pull-right" data-toggle="modal" href="#modal_event">Nuevo Evento</a>
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
	        	<!-- Modal para añadir un evento -->
				<div id="modal_event" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-header">
					    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					    <h3 id="myModalLabel">Añadir Evento</h3>
					  </div>
						<div class="modal-body">
						    <form id="add_event" action="<?php echo base_url(); ?>admin/calendario/add_event" method="post" class="add_event form-horizontal myform">
						        

						        <div class="control-group">
						            <label class="control-label" for="nombre">(*) Nombre del evento:</label>
						            <div class="controls">
						                <input type="text" id="nombre" maxlength="255" name="nombre" value="<?php echo set_value('nombre'); ?>" title="Escriba el nombre del evento" class="text" />
						            </div>
						        </div>
						        <div class="control-group">
						            <label class="control-label" for="finicio">(*) Fecha de inicio:</label>
						            <div class="controls">
						                <input id="finicio" class="fecha" type="text" maxlength="10" name="finicio" value="<?php echo set_value('finicio'); ?>" title="Escriba la fecha de inicio del evento" />
						            </div>
						        </div>
						        <div class="control-group">
						            <label class="control-label" for="ffin">(*) Fecha de finalización:</label>
						            <div class="controls">
						                <input id="ffin" class="fecha" type="text" maxlength="10" name="ffin" value="<?php echo set_value('ffin'); ?>" title="Escriba la fecha de finalización del evento" />
						            </div>
						        </div>
						        <div class="control-group">
						            <label class="control-label" for="url">(*) Url del evento:</label>
						            <div class="controls">
						                <input type="text" id="url" maxlength="225" name="url" value="<?php echo set_value('url'); ?>" title="Escriba la url del evento" class="text" />
						            </div>
						        </div>
						        <div class="modal-footer">
						            <a class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</a>
						            <input type="submit" value="Añadir" class="edit btn btn-primary" />
						        </div>
						    </form>
						</div> <!-- end Modal Body -->
					</div><!-- Fin del modal -->
				<div id="calendar" class="widget-content"></div>
			</div> <!-- widget content -->
		</div> <!-- widget -->
	</div> <!-- row -->
</div><!-- span9 -->
