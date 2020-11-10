<?php
include_once 'public/headerZonas.php';
?>
  

<a  class="badge badge-primary"  href="?controlador=Item&accion=home" title="Ir la página anterior">
    <img src="public/img/regresar.svg"  width="30" height="30"> </img>
    Regresar 
</a>

<center> <label   style="background-color: #00000; font-size: 20px;">Consultar Persona </label> </center>

<center>
    <a class="badge badge-primary" href="#" data-toggle="modal" data-target="#largeModal">Nuevo Registro

        <img src="public/img/register.svg"  width="30" height="30"> </img>
    </a>
</center>
<br><br>

<div id="largeModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Formulario de Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <!--
                <form action="?controlador=Item&accion=insertarP" method="post">


                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="cedula">Cedula</label>
                                <input type="number" class="form-control" id="cedula" name="cedula" required="" placeholder="Cedula:">
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required="" placeholder="Nombre:">
                            </div>
                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos"  required="" placeholder="apellido:">
                            </div>
                            <div class="form-group">
                                <label for="correo">Correo</label>
                                <input type="email" class="form-control" id="correo" name="correo"  required="" placeholder="Correo:">
                            </div>
                            <div class="form-group">
                                <label for="telefono">Telefono</label>
                                <input type="number" class="form-control" id="telefono" name="telefono"  required="" placeholder="Telefono:">
                            </div>
                            <div class="form-group">
                                <label for="pais">Pais</label>
                                <input type="text" class="form-control" id="pais" name="pais"  required="" placeholder="Pais:">
                            </div>
                            <div class="form-group">
                                <label for="provincia">Provincia</label>
                                <input type="text" class="form-control" id="provincia" name="provincia"  required="" placeholder="Provincia:">
                            </div>
                            <div class="form-group">
                                <label for="canton">Canton</label>
                                <input type="text" class="form-control" id="canton" name="canton"  required="" placeholder="Canton:">
                            </div>
                            <div class="form-group">
                                <label for="distrito">Distrito</label>
                                <input type="text" class="form-control" id="distrito" name="distrito"  required="" placeholder="Distrito:">
                            </div>
                            <div class="form-group">
                                <label for="detalle">Detalle</label>
                                <input type="text" class="form-control" id="detalle" name="detalle"  required="" placeholder="Detalle:">
                            </div>
                            <center>
                                <button type="submit"  name="btnGuardar" id="btnGuardar" style="background-color: #57ABBB" class="btn btn-info">Registrar Persona
                                    <img src="public/img/register.svg"  width="20" height="20"> </img>
                                </button>
                            </center>


                        </div>

                    </div>
                </form>
                -->
            </div>
<!--            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Registrar</button>
            </div>-->
        </div>
    </div>
</div>  


<div class="container-fluid">
    <table class="datatable table table-hover table-bordered">
        <th>ID</th>
        <th>Nombre</th>
        <th>ID Coordinacion</th>
        </tr>

        <?php
        foreach ($vars['listado'] as $item) {
            ?>
            <tr>
                <td><?php echo $item[0] ?></td>
                <td><?php echo $item[2] ?></td>
                <td><?php echo $item[1] ?></td>
                
                <td>  <a  class="btn btn-warning" href='?controlador=Item&accion=listarMiembros&id=<?php echo $item[0] ?>'> 
                        <img src="public/img/enter.png"  width="20" height="20"> </img>
                    </a> 
                    <!--
                    <a  class="btn btn-warning" href='?controlador=Item&accion=modificarVista&id=<?php echo $item[0] ?>'> 
                        <img src="public/img/register.svg"  width="20" height="20"> </img>
                    </a>
                    -->
                </td>
                
            </tr>
            <?php
        }
        ?>
    </table>
</div>


<br><br><br><br><br><br><br><br>
<?php
include_once 'public/FooterDataTable.php';
?>
