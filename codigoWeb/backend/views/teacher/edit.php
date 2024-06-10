<?php
require_once "controllers/teachersController.php";
require_once "controllers/rolesController.php";

$controladorRoles = new RolesController();
$controlador = new TeachersController();
$roles = $controladorRoles->listar();

if (!isset($_REQUEST["id"])) {
    header('location:backend.php?accion=listar');
    exit();
}

$id = $_REQUEST["id"];
$teacher = $controlador->ver($id);

$visibilidad = "hidden";
$mensaje = "";
$clase = "alert alert-success";
$mostrarForm = true;

try {
    if ($teacher == null) {
        $visibilidad = "visible";
        $clase = "alert alert-danger";
        $mostrarForm = false;
        throw new Exception("El profesor con id: {$id} no existe. Por favor vuelva a la pagina anterior");

    } else if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "modificar") {
        $visibilidad = "visible";
        $mensaje = "profesor con id: {$id} y nombre {$teacher->name}. Modificado con éxito";
        if (isset($_REQUEST["error"])) {
            $clase = "alert alert-danger";
            throw new Exception("No se ha podido modificar el profesor con id {$id}");
        }
    }

} catch(Exception $editError) {
    $mensaje = $editError->getMessage();
}
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Editar profesor con Id: <?= $id ?></h1>
    </div>
    <div id="contenido">
        <div id="msg" name="msg" class="<?= $clase ?>" <?= $visibilidad ?>> <?= $mensaje ?> </div>
        <?php if ($mostrarForm) { ?>
            <form action="backend.php?tabla=teacher&accion=guardar&evento=modificar" method="POST">
                <input type="hidden" id="id" name="id" value="<?= $teacher->id ?>">
                <div class="form-group">
                    <label for="name">Nombre </label>
                    <input type="text" required class="form-control" id="name" name="name" value="<?= $teacher->name ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email </label>
                    <input type="text" required pattern="^[^@\s]+@[^@\s]+\.[^@\s]+$" class="form-control" id="email" name="email" value="<?= $teacher->email ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{1,10}$" class="form-control" id="password" name="password" value="<?= $teacher->password ?>">
                    <small id="password" class="form-text text-muted">Requisitos: (Máximo 10 carácteres) - (Al menos una letra minúscula) - (Al menos una letra mayúscula) - (Al menos un carácter especial)</small>
                </div>
                <div class="form-group">
                    <label for="phone">Teléfono</label>
                    <input type="number" required class="form-control" id="phone" name="phone" value="<?= $teacher->phone ?>" placeholder="Introduce su teléfono" required>
                </div>
                <div class="form-group">
                    <label for="nationality">Nacionalidad </label>
                    <input type="text" required class="form-control" id="nationality" name="nationality" value="<?= $teacher->nationality ?>">
                </div>
                <input type="hidden" id="user_id" name="user_id" value="<?= $teacher->user_id ?>">
                <div class="form-group">
                    <label for="rol_id">Roles</label>
                    <select class="form-control" id="rol_id" name="rol_id" required>
                        <option value="">Seleccione un rol</option>
                        <?php foreach ($roles as $rol): ?>
                        <option value="<?= $rol->id ?>" <?= $teacher->rol_id == $rol->id ? 'selected' : '' ?>><?= $rol->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a class="btn btn-danger" href="backend.php?tabla=teacher&accion=listar">Cancelar</a>
            </form>
        <?php } else { ?>
            <a href="backend.php" class="btn btn-primary">Volver a Inicio</a>
        <?php } ?>
    </div>
</main>
