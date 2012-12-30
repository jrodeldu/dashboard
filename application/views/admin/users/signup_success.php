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
					<?php if ( !empty($message) ) { ?>
					<div class="alert alert-success">
						<?php echo $message; ?>
					</div>
					<?php } ?>

					<?php if ( !empty($error) ){ ?>
					<div class="alert alert-error">
						<?php echo $error; ?>
					</div>
					<?php } ?>

					<p>Ahora será redirigido, si no es así puede acceder desde el link
				  	<?php echo anchor('admin', 'Acceso'); ?>
        	</div>
    	</div>
	</div>
</div>
