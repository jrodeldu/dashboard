<div class="span9">
    <div class="row-fluid">
        <h1 class="page-title">
            <i class="icon-tasks icon-white"></i>
            Barcode
        </h1>
    </div>
    <div class="row-fluid">
        <div class="widget">
            <div class="widget-header">
                <i class="icon-comment"></i>
                <h3><?php echo $titulo; ?></h3>
            </div>
            <div class="widget-content nopadding">
                        
                    <div class="ganttpadding">
                        <p>Tenemos que copiar el archivo zend.php y la carpeta Zend al directorio de las librerias.</p>
                        <p>Para cargar la imagen ponemos en el src la ruta de la función del barcode donde le podemos
                        pasar lo que queramos que ponga en el código de barras</p>
                        <p>Examples de la librería y código qr 
                            <a href="http://ellislab.com/forums/viewthread/166294/#795935" target= "_blank"> aquí</a></p>                
                    </div>

                    <pre><img src="<?php echo base_url(); ?>admin/barcode/codigo" alt=""></pre>

                <div class="form-actions">
                    <input type="button" class="btn" value="Cancelar" title="Pulse para cancelar esta tarea y volver atrás" onclick="location.href='http://www.it7.info/admin'" />
                </div>
            </div>
        </div>
    </div>
</div><!-- span end widget -->