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
	            <h3>Registro de usuario</h3>
	        </div>
			<div class="widget-content">
				<div class="alert alert-success">
					<?php
						if($this->session->flashdata('message') != NULL || $this->session->flashdata('message') != ''){
					      echo $this->session->flashdata('message');
					    }
				  	?>
				  	<p>Ahora será redirigido nuevamente al Dashboard! Si no es así puede acceder desde el link
				  	<?php echo anchor('admin', 'Dashboard'); ?></p>
				</div>
			</div>
    	</div>
	</div>
</div>