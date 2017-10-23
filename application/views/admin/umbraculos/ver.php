<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>


            <div class="content-wrapper">
                <section class="content-header">
                    <?php echo $pagetitle; ?>
                    <?php echo $breadcrumb; ?>
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-md-6">
                             <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Detalles umbráculo</h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th>Nombre</th>
                                                <td><?php echo $info_umbraculo['nombreUmbraculo']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Sustrato</th>
                                                <td><textarea style="width:100%" disabled><?php echo $info_umbraculo['descripcionSustrato']; ?></textarea></td>
                                            </tr>
                                            <tr>
                                                <th>Descripción</th>
                                                <td><textarea style="width:100%" disabled><?php echo $info_umbraculo['descripcionUmbraculo']; ?></textarea></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                    <!--CAJA CONDICIONES-->
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Condiciones</h3>
                                </div>
                            <div class="box-body">
                                    <div class="col-lg-6">
                                                <table>
                                                <tr><td>Temperatura <strong><?php echo $info_umbraculo['temperaturaUmbraculo']; ?>°C</strong></td></tr>
                                                </table><br>
                                             <div class="progress-group">
                                                <span class="progress-text">Húmedad (%)</span>
                                                <span class="progress-number"><strong><?php echo $info_umbraculo['humedadUmbraculo']; ?></strong>/100</span>
            
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-aqua" role="progressbar" style="width: <?php echo $info_umbraculo['humedadUmbraculo']; ?>%" ></div>
                                                </div>
                                            </div>
                                            <div class="progress-group">
                                                <span class="progress-text">Espacio disponible</span>
                                                <span class="progress-number"><strong><?php echo $info_umbraculo['unidadEspacioTotal_m2']+($info_umbraculo['unidadEspacioDisponible_m2']-$info_umbraculo['unidadEspacioTotal_m2']); ?>m<sup>2</sup></strong>/<?php echo $info_umbraculo['unidadEspacioTotal_m2']; ?>m<sup>2</sup></span>
            
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-aqua" role="progressbar" aria-valuenow="<?php echo $info_umbraculo['unidadEspacioTotal_m2']+($info_umbraculo['unidadEspacioDisponible_m2']-$info_umbraculo['unidadEspacioTotal_m2']); ?>" aria-valuemin="0" aria-valuemax="<?php echo $info_umbraculo['unidadEspacioTotal_m2']; ?>" style="width: <?php echo ($info_umbraculo['unidadEspacioTotal_m2']+($info_umbraculo['unidadEspacioDisponible_m2']-$info_umbraculo['unidadEspacioTotal_m2'])*-100)/$info_umbraculo['unidadEspacioTotal_m2']; ?>%" ></div>
                                                </div>
                                            </div>
                                    </div>
                            </div>
                            </div>
                                <div class="box-footer">
                                    <a href="<?php echo site_url('common/umbraculos'); ?>" class="btn btn-default btn-flat">Volver</a>
                                </div> 
                         </div>
                    <!--FIN CAJA CONDICIONES-->     
                    <!-- CAJA PLANTAS-->     
                        <div class="col-md-6">
                             <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Plantas</h3>
                                </div>
                                <div class="box-body">
                                    <div class="col-lg-6">
                                           <table class="table table-striped">
                                            <tr>
                                                <th>IdPlanta</th>
                                                <th>Cantidad</th>
                                            </tr>
<!--                                                 <?php foreach($umbraculo_plantas as $u){ ?> -->
                                                <tr>
                                                    <td><?php echo $u['idPlanta']; ?></td>
                                                    <td><?php echo $u['cantidad']; ?></td>
                                                </tr>
<!--                                                 <?php } ?> -->
                                        </table>

                                            <div>
                                                <table>
                                                    <td><h3 class="box-title"><?php echo anchor('URL', '<i class="fa fa-eye"></i> '.'Ver plantas', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3></td
                                                    >
                                                    <td><h3 class="box-title"><?php echo anchor('URL', '<i class="fa fa-plus"></i> '.'Agregar planta a umbraculo', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3></td>
                                                </table>
                                            </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <!--FIN CAJA PLANTAS-->

                    <!--CAJA TAREAS-->

                    <div class="col-md-6">
                             <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Tareas</h3>
                                </div>
                                <div class="box-body">
                                    <div class="col-lg-6">

                                            <div>
                                                <table>
                                                    <td><h3 class="box-title"><?php echo anchor('URL','<i class="fa fa-eye"></i> '.'Ver tareas', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3></td
                                                    >
                                                    <td><h3 class="box-title"><?php echo anchor('URL', '<i class="fa fa-plus"></i> '.'Agregar tarea', array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3></td>
                                                </table>
                                            </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <!--FIN CAJA TAREAS-->
                </section>
            </div>


