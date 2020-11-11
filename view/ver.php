<?php
include_once 'public/HeaderDataTable.php';
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
            </div>
        </div>
    </div>
</div>  


<div class="container-fluid">
    <table class="datatable table table-hover table-bordered">
        <th>ID</th>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Correo</th>
        <th>Telefono</th>
        <th>Pais</th>
        <th>Provincia</th>
        <th>Canton</th>
        <th>Distrito</th>
        <th>Detalle</th>
        <th>Monitor</th>
        <th>Jefe</th>
        </tr>

        <?php
        foreach ($vars['listado'] as $item) {
            ?>
            <tr>
                <td><?php echo $item[0] ?></td>
                <td><?php echo $item[1] ?></td>
                <td><?php echo $item[2] ?></td>
                <td><?php echo $item[3] ?></td>
                <td><?php echo $item[4] ?></td>
                <td><?php echo $item[5] ?></td>
                <td><?php echo $item[6] ?></td>
                <td><?php echo $item[7] ?></td>
                <td><?php echo $item[8] ?></td>
                <td><?php echo $item[9] ?></td>
                <td><?php echo $item[10] ?></td>
                <td><?php echo $item[11] ?></td>
                <td>  <a  class="btn btn-warning" href='?controlador=Item&accion=modificarVistaMiembro&id=<?php echo $item[0] ?>'> 
                        <img src="public/img/register.svg"  width="20" height="20"> </img>
                    </a>
                    <a  class="btn btn-danger" href='?controlador=Item&accion=metodoEliminarMiembro&id=<?php echo $item[0] ?>'> 
                        <img src="public/img/elimina1.svg"  width="20" height="20"> </img>
                    </a>
                    <a  class="btn btn-danger" href='?controlador=Item&accion=metodoEliminarMiembroGrupo&id=<?php echo $item[0] ?>'> 
                        <img src="public/img/enter.png"  width="20" height="20"> </img>
                    </a>
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
