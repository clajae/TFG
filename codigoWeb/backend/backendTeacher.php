<?php
ob_start();
require_once("config/sesionControl.php");
require_once("router/router.php");
require_once("views/layout/head.php");

$vista = router();
?>
<div class="container-fluid" style=" width: 65vw; display: flex;">
    <div class="row">
        <?php
        require_once "views/layout/navbarTeacher.php";
        // if (!file_exists($vista)) echo "Error, REVISA TUS RUTAS";
        // else require_once($vista);
        ?>
        <div class="align-items-center pt-3 pb-2 mb-3 border-bottom" style="text-align: center;">
            <h3>Acceso a los listados de datos</h3>
        </div>
        <div id="contenido" style=" width: 80.5vw; display: flex; gap: 25px; flex-wrap: wrap; justify-content: center; align-items: center;">
            <a href="backendTeacher.php?tabla=course&accion=listar"><button type="button" class="btn btn-secondary" style="height:70px; width:200px; font-size: 12pt;">Mis Cursos</button></a>
            <a href="backendTeacher.php?tabla=teacher&accion=listar"><button type="button" class="btn btn-secondary" style="height:70px; width:200px; font-size: 12pt;">Mis Profesores</button></a>
            <a href="backendTeacher.php?tabla=workgroup&accion=listar"><button type="button" class="btn btn-secondary" style="height:70px;  width:200px; font-size: 12pt;">Mis Grupos de trabajo</button></a>
            </div>
        </div> 
    </div>
</div>
<?php
require_once("views/layout/footer.php");
?>