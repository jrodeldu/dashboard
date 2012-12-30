<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'line',
                marginRight: 130,
                marginBottom: 25
            },
            title: {
                text: 'Comparación de temperatura',
                x: -20 //center
            },
            subtitle: {
                text: 'UVM XXII',
                x: -20
            },
            xAxis: {
                categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
            },
            yAxis: {
                title: {
                    text: 'Temperatura'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y +' Cº';
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
            },
            series: [{
                name: 'Tokyo',
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name: 'Canarias',
                data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
            }, {
                name: 'Berlin',
                data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
            }, {
                name: 'London',
                data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
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
