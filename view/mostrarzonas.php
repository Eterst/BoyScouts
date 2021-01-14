<?php
include_once 'public/headerZonas.php';
?>
  

<a  class="badge badge-primary"  href="?controlador=Item&accion=home" title="Ir la página anterior">
    <img src="public/img/regresar.svg"  width="30" height="30"> </img>
    Regresar 
</a>

<center> <label   style="background-color: #00000; font-size: 20px;">Zonas </label> </center>

<center>
    <a class="badge badge-primary" href="#" data-toggle="modal" data-target="#largeModal">Nueva Zona

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
        <th>Nombre</th>
        <th>Coordinacion</th>
        </tr>

        <?php
        foreach ($vars['listado'] as $key => $item) {
            ?>
            <tr>
                <td><?php echo $item[2] ?></td>
                <td><?php echo $vars['parent'][$key][1] ?></td>
                
                <td>  <a  class="btn btn-warning" href='?controlador=Item&accion=listarMiembrosGrupo&id=<?php echo $item[0] ?>'> 
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
