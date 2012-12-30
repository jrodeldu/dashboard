<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin/graficas/barra.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin/graficas/barras.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin/graficas/tarta.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin/graficas/lineas.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin/graficas/tab.js"></script>
<div class="span9">
    <div class="row-fluid">
        <h1 class="page-title">
            <i class="icon-tasks icon-white"></i>
            Gráficas
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

                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"><a href="#barra" data-toggle="tab">Barra</a></li>
                            <li><a href="#prueba" data-toggle="tab">Barras</a></li>
                            <li><a href="#tarta" data-toggle="tab">Tarta</a></li>
                            <li><a href="#lineas" data-toggle="tab">Líneas</a></li>
                        </ul>
 
                        <div class="tab-content">
                        <div class="tab-pane active" id="barra" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <div class="tab-pane" id="prueba" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <div class="tab-pane" id="tarta" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        <div class="tab-pane" id="lineas" style="width: 900px; height: 400px; margin: 0 auto"></div>
                        </div> 

                    </div>
                <div class="form-actions">
                    <input type="button" class="btn" value="Cancelar" title="Pulse para cancelar esta tarea y volver atrás" onclick="location.href='http://www.it7.info/admin'" />
                </div>
            </div>
        </div>
    </div>
</div> <!-- span end widget -->
 
<!-- Js de las Gráficas -->

<script src="<?php echo base_url(); ?>assets/js/admin/graficas/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/admin/graficas/modules/exporting.js"></script>