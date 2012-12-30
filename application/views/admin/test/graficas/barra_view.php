<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'column',
                margin: [ 50, 50, 100, 80]
            },
            title: {
                text: 'World\'s largest cities per 2008'
            },
            xAxis: {
                categories: [
                    'Tokyo',
                    'Jakarta',
                    'New York',
                    'Seoul',
                    'Manila',
                    'Mumbai',
                    'Sao Paulo',
                    'Mexico City',
                    'Dehli',
                    'Osaka',
                    'Cairo',
                    'Kolkata',
                    'Los Angeles',
                    'Shanghai',
                    'Moscow',
                    'Beijing',
                    'Buenos Aires',
                    'Guangzhou',
                    'Shenzhen',
                    'Istanbul'
                ],
                labels: {
                    rotation: -45,
                    align: 'right',
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Population (millions)'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +'</b><br/>'+
                        'Population in 2008: '+ Highcharts.numberFormat(this.y, 1) +
                        ' millions';
                }
            },
            series: [{
                name: 'Population',
                data: [34.4, 21.8, 20.1, 20, 19.6, 19.5, 19.1, 18.4, 18,
                    17.3, 16.8, 15, 14.7, 14.5, 13.3, 12.8, 12.4, 11.8,
                    11.7, 11.2],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    x: 4,
                    y: 10,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
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