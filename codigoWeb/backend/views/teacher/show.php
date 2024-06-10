<?php
require_once "controllers/teachersController.php";

if (!isset($_REQUEST['id'])) {
    header("location:backend.php");
    exit();
    // si no ponemos exit despues de header redirecciona al finalizar la pagina 
    // ejecutando el código que viene a continuación, aunque no llegues a verlo
    // No poner exit puede provocar acciones no esperadas dificiles de depurar
}

$id = $_REQUEST['id'];
$controlador = new TeachersController();
$teacher = $controlador->ver($id);

?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="text-align: center;">
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Profesor Creado Correctamente:</h1>
    </div>
    <div id="contenido" style="display: flex; justify-content: center;">
        <div class="card" style="width: 15rem; padding: 2rem; text-align: center;">
            <div>
                <h5 class="card-title">ID: <?= $teacher->id ?></h5>
                <p class="card-text">
                    Nombre: <?= $teacher->name ?><br>
                    Email: <?= $teacher->email ?><br>
                    Contraseña: <?= $teacher->password ?><br>
                    Teléfono: <?= $teacher->phone ?><br>
                    Nacionalidad: <?= $teacher->nationality ?><br>
                    ID Rol: <?= $teacher->rol_id ?><br>
                </p>
                <a href="backend.php" class="btn btn-primary">Volver a Inicio</a>
            </div>
        </div>
</main>