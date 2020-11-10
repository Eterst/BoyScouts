<?php
include_once 'public/headerPrincipal.php';
?>
<a  class="badge badge-primary" href="?controlador=Item&accion=home" title="Ir la página anterior">Regresar al Menú Principal</a>
<form action="?controlador=Item&accion=insertarMiembroSinGrupo" method="post">
    <center> 
        <label   style="color: #000000; font-size: 20px;">Registrar Persona Sin Grupo</label> 
    </center>
        <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                            <div2 class="form-group">
                                <label>
                                    Cedula
                                </label>
                                <input type="number" class="form-control" id="cedula" name="cedula" />
                            </div2>
                            <div2 class="form-group">
                                 
                                <label>
                                    Nombre
                                </label>
                                <input type="text" class="form-control" id="nombre"  name="nombre" />
                            </div2>
                            <div2 class="form-group">
                                 
                                <label>
                                    Apellido
                                </label>
                                <input type="text" class="form-control" id="apellidos"  name="apellidos" />
                            </div2>
                            <div2 class="form-group">
                                 
                                <label>
                                    Correo
                                </label>
                                <input type="email" class="form-control" id="correo"  name="correo" />
                            </div2>
                            <div2 class="form-group">
                                 
                                <label>
                                    Telefono
                                </label>
                                <input type="number" class="form-control" id="telefono"  name="telefono" />
                            </div2>
                            <div2 class="form-group">
                                 
                                <label>
                                    Pais
                                </label>
                                <input type="text" class="form-control" id="pais"  name="pais" />
                            </div2>
                            <div2 class="form-group">
                                 
                                <label>
                                    Provincia
                                </label>
                                <input type="text" class="form-control" id="provincia"  name="provincia" />
                            </div2>
                            <div2 class="form-group">
                                 
                                <label>
                                    Canton
                                </label>
                                <input type="text" class="form-control" id="canton"  name="canton" />
                            </div2>
                            <div2 class="form-group">
                                 
                                <label>
                                    Distrito
                                </label>
                                <input type="text" class="form-control" id="distrito"  name="distrito" />
                            </div2>
                            <div2 class="form-group">
                                 
                                <label>
                                    Detalle
                                </label>
                                <input type="text" class="form-control" id="detalle" name="detalle" />
                            </div2>
                            <button type="submit" class="btn btn-primary" id="crear"  name="crear">
                                Crear
                            </button>
                </div>
            <div class="col-md-4">
                <!-- Algo xd -->
            </div>
            <div class="col-md-4">
                <!-- Algo xd -->
            </div>
            </div>
            </div>
              <div class="col-md-4"></div>
    </div>
</form>


<?php
include_once 'public/footerPrincipal.php';
?>