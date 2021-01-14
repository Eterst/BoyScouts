<?php
include_once 'public/HeaderPrincipal.php';
?>
  

<a  class="badge badge-primary"  href="?controlador=Item&accion=home" title="Ir la página anterior">
    <img src="public/img/regresar.svg"  width="30" height="30"> </img>
    Regresar 
</a>

<center> <label   style="background-color: #00000; font-size: 20px;">Miembros </label> </center>

<!-- $data['idgrupo'] -->
<center>
    <a class="badge badge-primary" href="?controlador=Item&accion=insertarMiembroGrupo&idgrupo=<?php echo $vars['idgrupo']?>" >Insertar Miembro
    <img src="public/img/register.svg"  width="30" height="30"> </img>
    </a>
</center>
<br><br> 

<div class="container-fluid">
    <table class="datatable table table-hover table-bordered">
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Correo</th>
        <th>Telefono</th>
        <th>Pais</th>
        <th>Provincia</th>
        <th>Canton</th>
        <th>Distrito</th>
        <th>Detalle</th>
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
                <td>  <a  class="btn btn-warning" href='?controlador=Item&accion=modificarVistaMiembro&id=<?php echo $item[0] ?>'> 
                        <img src="public/img/register.svg"  width="20" height="20"> </img>
                    </a>
                    <a  class="btn btn-danger" href='?controlador=Item&accion=metodoEliminarMiembro&id=<?php echo $item[0] ?>'> 
                        <img src="public/img/elimina1.svg"  width="20" height="20"> </img>
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
