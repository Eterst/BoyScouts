<?php
include_once 'public/headerPrincipal.php';
?>
<a  class="badge badge-primary" href="?controlador=Item&accion=home" title="Ir la página anterior">Regresar al Menú Principal</a>
<form action="?controlador=Item&accion=insertarGrupo" method="post">
    <center> 
        <label   style="color: #000000; font-size: 20px;">Registrar Coordinacion </label> 
    </center>
        <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                            <div2 class="form-group">
                                <label>
                                    Nombre
                                </label>
                                <input type="text" class="form-control" id="nombre"  name="nombre" />
                            </div2>
                            <div2 class="form-group">
                                <label>
                                </label>
                                <input type="hidden" class="form-control" id="idrama"  name="idrama" value=-1 />
                            </div2>
                            <div class="form-group">
                                <label>
                                    Tipo
                                </label>
                                <input type="text" class="form-control" id="tipo" name="tipo" readonly="" placeholder="coordinacion" value="<?php echo "coordinacion" ?>">
                            </div>
                            <div2 class="form-group">
                                <label>
                                    Cedula Jefe
                                </label>
                                <input type="number" class="form-control" id="cedulamonitor"  name="cedulamonitor" />
                            </div2>
                            <button type="submit" class="btn btn-primary" id="crear"  name="crear">
                                Crear
                            </button>
                </div>
            <div class="col-md-4">
                
            </div>
            <div class="col-md-4">
                
            </div>
            </div>
            </div>
              <div class="col-md-4"></div>
    </div>
</form>


<?php
include_once 'public/footerPrincipal.php';
?>

