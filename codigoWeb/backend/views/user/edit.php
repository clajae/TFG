<?php

require_once "controllers/usersController.php";

//recoger datos
if (!isset($_REQUEST["id"])) {
    header('location:backend.php?accion=listar');
    exit();
}

$id = $_REQUEST["id"];
$controlador = new UsersController();
$user = $controlador->ver($id);

$visibilidad = "hidden";
$mensaje = "";
$clase = "alert alert-success";
$mostrarForm = true;

try {
    if ($user == null) {
        $visibilidad = "visbility";
        $clase = "alert alert-danger";
        $mostrarForm = false;
        throw new Exception("El usuario con id: {$id} no existe. Por favor vuelva a la pagina anterior");

    } else if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "modificar") {
        $visibilidad = "vibility";

        $mensaje = "Usuario con id: {$id} y nombre {$user->name}. Modificado con éxito";
        if (isset($_REQUEST["error"])) {
            $clase = "alert alert-danger";
            throw new Exception("No se ha podido modificar cliente con id {$id}");
        }
    }

} catch(Exception $editError) {
    $mensaje = $editError->getMessage();
}

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Editar Usuario con Id: <?= $id ?></h1>
    </div>
    <div id="contenido">
        <div id="msg" name="msg" class="<?= $clase ?>" <?= $visibilidad ?>> <?= $mensaje ?> </div>
        <?php
        if ($mostrarForm) {
        ?>
            <form action="index.php?tabla=user&accion=guardar&evento=modificar" method="POST">
                <input type="hidden" id="id" name="id" value="<?= $user->id ?>">
                <div class="form-group">
                    <label for="usuario">Usuario </label>
                    <input type="text" required class="form-control" id="usuario" name="usuario" aria-describedby="usuario" value="<?= $user->usuario ?>">
                    <small id="usuario" class="form-text text-muted">Compartir tu usuario lo hace menos seguro.</small>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{1,10}$" class="form-control" id="password" name="password" value="<?= $user->password ?>">
                    <small id="password" class="form-text text-muted">Requisitos: (Máximo 10 carácteres) - (Al menos una letra minúscula) - (Al menos una letra mayúscula) - (Al menos un carácter especial)</small>

                </div>
                <div class="form-group">
                    <label for="name">Nombre </label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $user->name ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email </label>
                    <input type="text" required pattern="^[^@\s]+@[^@\s]+\.[^@\s]+$" class="form-control" id="email" name="email" value="<?= $user->email ?>">
                </div>

                <button type="submit" class="btn btn-primary">Guardar</button>
                <a class="btn btn-danger" href="backend.php?tabla=user&accion=listar">Cancelar</a>
            </form>
        <?php
        } else {
        ?>
            <a href="backend.php" class="btn btn-primary">Volver a Inicio</a>
        <?php
        }
        ?>
    </div>
</main>
