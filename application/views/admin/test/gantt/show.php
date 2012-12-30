<div class="span9">
    <div class="row-fluid">
        <h1 class="page-title">
            <i class="icon-tasks icon-white"></i>
            Diagrama de Gantt
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
                        <div class="gantt"></div>
                    </div>
                <div class="form-actions">
                    <input type="button" class="btn" value="Cancelar" title="Pulse para cancelar esta tarea y volver atrás" onclick="location.href='http://www.it7.info/admin'" />
                </div>
            </div>
        </div>
    </div>
</div><!-- span end widget -->

<!-- Js Diagrama de Gantt -->

    <!-- <script src="<?php echo base_url(); ?>assets/gantt/js/jquery-1.7.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/js/admin/gantt/jquery.fn.gantt.js"></script>
    <script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-tooltip.js"></script>
    <script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-popover.js"></script>
    <script src="http://taitems.github.com/UX-Lab/core/js/prettify.js"></script>
    <script>

        $(function() {

            "use strict";

            $(".gantt").gantt({
                source: [


<?php foreach($gantt as $row) { ?>

                {
                    name: "<?php echo $row->proyecto; ?>",
                    desc: "<?php echo $row->tipo; ?>",
                    values: [{
                        from: "/Date(<?php echo strtotime($row->f_inicio); ?>000)/",
                        to: "/Date(<?php echo strtotime($row->f_fin); ?>000)/",
                        /*from: "/Date(1320192000000)/",
                        to: "/Date(1322401600000)/",*/
                        label: "<a href='<?php echo base_url(); ?>admin/tareas/show/<?php echo $row->id; ?>'><?php echo $row->entradilla; ?></a>", 
                        //
                        <?php if($row->tipo == 'Programación'){
                            $color = 'GanttBlue';  
                        }elseif($row->tipo == 'Diseño'){
                            $color = 'ganttGreen';
                        }else{
                            $color = 'ganttRed';
                        }?>
                        customClass: "<?php echo $color; ?>"
                    }]
                },

<?php } ?>

                ],
                navigate: "scroll",
                //scale: "weeks",
                scale: "days",
                maxScale: "months",
                minScale: "days",
                itemsPerPage: 10,
                /*onItemClick: function(data) {
                    alert("Item clicked - show some details");
                },
                onAddClick: function(dt, rowId) {
                    alert("Empty space clicked - add an item!");
                },*/
                onRender: function() {
                    if (window.console && typeof console.log === "function") {
                        console.log("chart rendered");
                    }
                }
            });
            /*
            $(".gantt").popover({
                selector: ".bar",
                title: "I'm a popover",
                content: "And I'm the content of said popover.",
                trigger: "hover"
            });
            
            prettyPrint();
            */
        });

</script>