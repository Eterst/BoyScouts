<?php
include_once 'public/headerPrincipal.php';
?>

<a  class="badge badge-primary"  href="?controlador=Item&accion=home" title="Ir la página anterior">Regresar</a>

<title> Modificar Vista</title>
<form action="?controlador=Item&accion=metodoActualizarMiembro" method="post">
    <?php
    foreach ($vars['listado'] as $item) {
        ?>
        <center> 
            <label   style="color: #000000; font-size: 20px;">Modificar Información </label> 
        </center>



        <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="inputEmail4">ID Grupo:</label>
                    <input type="number" class="form-control" id="idgrupo" name="idgrupo" readonly="" placeholder="id" value="<?php echo $item[0] ?>">
                </div>
                <div class="form-group">
                    <label for="miembro">ID Miembro:</label>
                    <input type="number" class="form-control" id="idmiembro" name="idmiembro" readonly="" placeholder="id" value="<?php echo $item[1] ?>">
                </div>
                <div class="form-group">
                    <label for="monitor">Monitor:</label>
                    <input type="number" class="form-control" id="monitor" name="monitor" placeholder="BOOL" value="<?php echo $item[2] ?>">
                </div>
                <div class="form-group">
                    <label for="jefe">Jefe:</label>
                    <input type="number" class="form-control" id="jefe" name="jefe" placeholder="BOOL" value="<?php echo $item[3] ?>">
                </div>
                <center>
                <button type="submit" class="btn btn-warning">Modificar
                   <img src="public/img/update.svg"  width="20" height="20"> </img>
                </button>
                    </center>
                <br><br><br>
            </div>
            <div class="col-md-4">

            </div>
        </div>

    </div>
    <?php
}
?>

</form>


<?php
include_once 'public/footerPrincipal.php';
?>

