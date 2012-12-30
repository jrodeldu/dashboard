<?php 
$turismo = array(130,120,100,59,35,34,);
$educacion = array(115,91,55,19,134,100,);
$ecologia = array(122,95,45,79,95,200,);
$economia = array(100,135,5,40,150,10,);
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'Alumnos por categoría'
            },
            subtitle: {
                text: 'UVM XXII'
            },
            xAxis: {
                /*categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ]*/
                categories: [
                    'Edición XVIII',
                    'Edición XIX',
                    'Edición XX',
                    'Edición XXI',
                    'Edición XXII',
                    'Edición XXIII',
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Alumnos'
                }
            },
            legend: {
                layout: 'vertical',
                backgroundColor: '#FFFFFF',
                align: 'left',
                verticalAlign: 'top',
                x: 100,
                y: 70,
                floating: true,
                shadow: true
            },
            tooltip: {
                formatter: function() {
                    return ''+
                        this.x +': '+ this.y +' alumnos';
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
                series: [{
                //name: 'Tokyo',
                //data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0,/* 135.6, 148.5, 216.4, 194.1, 95.6, 54.4*/]
                name: 'Turismo',
                data: [<?php foreach($turismo as $e){ echo $e . ', ';} ?>]
    
            }, {
                //name: 'New York',
                //data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5,/* 105.0, 104.3, 91.2, 83.5, 106.6, 92.3*/]
                name: 'Ecología',
                data: [<?php foreach($ecologia as $e){ echo $e . ', ';} ?>]
    
            }, {
                //name: 'London',
                //data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, /*59.0, 59.6, 52.4, 65.2, 59.3, 51.2*/]
                name: 'Economía',
                data: [<?php foreach($economia as $e){ echo $e . ', ';} ?>]
    
            }, {
                //name: 'Berlin',
                //data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, /*57.4, 60.4, 47.6, 39.1, 46.8, 51.1*/]
                name: 'Educación',
                data: [<?php foreach($educacion as $e){ echo $e . ', ';} ?>]
    
            }]
        });
    });
    
});
</script>

<div class="span9">
    <div class="row-fluid">
        <h1 class="page-title">
            <i class="icon-tasks icon-white"></i>
            Graficas
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

                        <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>

                    </div>
                <div class="form-actions">
                    <input type="button" class="btn" value="Cancelar" title="Pulse para cancelar esta tarea y volver atrás" onclick="location.href='http://www.it7.info/admin'" />
                </div>
            </div>
        </div>
    </div>
</div><!-- span end widget -->

<!-- Js de las Gráficas -->

<script src="<?php echo base_url(); ?>assets/js/admin/graficas/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/admin/graficas/modules/exporting.js"></script>
