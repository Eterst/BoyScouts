<?php
include_once 'public/headerPrincipal.php';
?>
  

<a  class="badge badge-primary"  href="?controlador=Item&accion=home" title="Ir la página anterior">
    <img src="public/img/regresar.svg"  width="30" height="30"> </img>
    Regresar 
</a>

<center> <label   style="background-color: #00000; font-size: 20px;"> Ramas </label> </center>
<br><br>
<!--
<center>
    <a class="badge badge-primary" href="#" >Nueva Zona

        <img src="public/img/register.svg"  width="30" height="30"> </img>
    </a>
</center>
<br><br>
-->

<div class="container-fluid">
    <table class="datatable table table-hover table-bordered">
        <th>Nombre Rama</th>
        <th>Nombre Zona</th>
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
