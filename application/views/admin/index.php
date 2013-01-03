            <div class="span9">
                <div class="row-fluid">
                    <div class="span12">
                        <h1 class="page-title">
                            <i class="icon-home icon-white"></i>
                            Dashboard
                        </h1>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="hero-unit">
                        <h1>Gestión</h1>
                        <p>Este gestor está diseñado para modificar, eliminar y añadir información de cada sección presente en su web. Cada pestaña colocada en la parte izquierda le llevará a la gestión de la sección que necesite gestionar.</p>
                        <p>Para la elaboración de este gestor, se han tenido en cuenta sus criterios de accesibilidad y usabilidad. Sin embargo, cada usuario tiene unas necesidades y unos usos diferentes,  por lo que si quiere comunicar sus impresiones sobre el gestor, utilice el <a href="gestion/contacto">formulario de contacto</a>.</p>
                        <p>Agradeceremos que nos comunique qué defectos aprecia y qué mejoras podía tener. Haremos lo posible por solucionar esas deficiencias cuanto antes.</p>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget">
                            <div class="widget-header">
                                <i class="icon-comment"></i>
                                <h3>Tareas</h3>
                                <span class="badge badge-info pull-right"><?php echo $tareas_t; ?></span>
                                <span class="pull-right"><h3>Tareas no finalizadas</h3></span>
                            </div>
                            <div class="widget-content nopadding">
                                <table class="table table-striped table-bordered task">
                                    <thead>
                                        <tr>
                                            <th>Descripción</th>
                                            <th>Estado</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach($tareas as $row){ ?>
                                        <?php
                                        if($row->tipo == 'Programación'){
                                            $tipo = 'icon-wrench';
                                        }elseif($row->tipo == 'Diseño'){
                                            $tipo = 'icon-pencil';
                                        }else{
                                            $tipo = 'icon-plus-sign';
                                        }

                                        if($row->estado == 'Pendiente'){
                                            $estado = 'pending';
                                        }elseif($row->estado == 'Solucionado'){
                                            $estado = 'done';
                                        }else{
                                            $estado = 'in-progress';
                                        }

                                        ?>
                                        <tr>
                                            <td><a class="tooltip-top" data-original-title="Actualizar"
                                                href="<?php echo base_url(); ?>admin/tareas/show/<?php echo $row->id; ?>">
                                                <i class="<?php echo $tipo; ?> "></i> <?php echo $row->entradilla; ?></a></td>
                                            <td class="centrado"><span class="<?php echo $estado; ?>"><?php echo $row->estado; ?></span></td>
                                            <td class="centrado"><?php echo date("d-m-Y",strtotime($row->f_inicio)); ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!--/span-->
                </div><!-- row -->
            </div><!--/span-->
