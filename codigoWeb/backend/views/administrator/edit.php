<?php
require_once "controllers/administratorsController.php";
require_once "controllers/rolesController.php";

$controladorRoles = new RolesController();
$controlador = new AdministratorsController();
$roles = $controladorRoles->listar();

if (!isset($_REQUEST["id"])) {
    header('location:backend.php?accion=listar');
    exit();
}

$id = $_REQUEST["id"];
$administrator = $controlador->ver($id);

$visibilidad = "hidden";
$mensaje = "";
$clase = "alert alert-success";
$mostrarForm = true;

try {
    if ($administrator == null) {
        $visibilidad = "visible";
        $clase = "alert alert-danger";
        $mostrarForm = false;
        throw new Exception("El administrador con id: {$id} no existe. Por favor vuelva a la pagina anterior");

    } else if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "modificar") {
        $visibilidad = "visible";
        $mensaje = "Administrador con id: {$id} y nombre {$administrator->name}. Modificado con éxito";
        if (isset($_REQUEST["error"])) {
            $clase = "alert alert-danger";
            throw new Exception("No se ha podido modificar el administrador con id {$id}");
        }
    }

} catch(Exception $editError) {
    $mensaje = $editError->getMessage();
}
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Editar Administrador con Id: <?= $id ?></h1>
    </div>
    <div id="contenido">
        <div id="msg" name="msg" class="<?= $clase ?>" <?= $visibilidad ?>> <?= $mensaje ?> </div>
        <?php if ($mostrarForm) { ?>
            <form action="backend.php?tabla=administrator&accion=guardar&evento=modificar" method="POST">
                <input type="hidden" id="id" name="id" value="<?= $administrator->id ?>">
                <div class="form-group">
                    <label for="name">Nombre </label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $administrator->name ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email </label>
                    <input type="text" required pattern="^[^@\s]+@[^@\s]+\.[^@\s]+$" class="form-control" id="email" name="email" value="<?= $administrator->email ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{1,10}$" class="form-control" id="password" name="password" value="<?= $administrator->password ?>">
                    <small id="password" class="form-text text-muted">Requisitos: (Máximo 10 carácteres) - (Al menos una letra minúscula) - (Al menos una letra mayúscula) - (Al menos un carácter especial)</small>
                </div>
                <div class="form-group">
                    <label for="phone">Teléfono</label>
                    <input type="number" class="form-control" id="phone" name="phone" value="<?= $administrator->phone ?>" placeholder="Introduce su teléfono" required>
                </div>
                <input type="hidden" id="user_id" name="user_id" value="<?= $administrator->user_id ?>">
                <div class="form-group">
                    <label for="rol_id">Roles</label>
                    <select class="form-control" id="rol_id" name="rol_id" required>
                        <option value="">Seleccione un rol</option>
                        <?php foreach ($roles as $rol): ?>
                        <option value="<?= $rol->id ?>" <?= $administrator->rol_id == $rol->id ? 'selected' : '' ?>><?= $rol->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a class="btn btn-danger" href="backend.php?tabla=administrator&accion=listar">Cancelar</a>
            </form>
        <?php } else { ?>
            <a href="backend.php" class="btn btn-primary">Volver a Inicio</a>
        <?php } ?>
    </div>
</main>
