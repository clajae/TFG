<?php
require_once "assets/php/funciones.php";
require_once "controllers/teachersController.php";

$controladorTeachers = new TeachersController();
$teachers = $controladorTeachers->listar();

$cadenaErrores = "";
$cadena = "";
$errores = [];
$datos = [];
$visibilidad = "invisible";

if (isset($_REQUEST["error"])) {
  $errores = ($_SESSION["errores"]) ?? [];
  $datos = ($_SESSION["datos"]) ?? [];
  $cadena = "Atención Se han producido Errores";
  $visibilidad = "visible";
}

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

 <div class="d-flex justify-content-between flex-wrap flex-md-nowrap alignitems-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">Añadir nuevo grupo de trabajo</h1>
 </div>

 <div id="contenido">
    <div class="alert alert-danger <?= $visibilidad ?>"><?= $cadena ?></div>
    <form action="backend.php?tabla=workgroup&accion=guardar&evento=crear" method="POST">

        <div class="form-group">
          <label for="name">Nombre del grupo de trabajo</label>
          <input type="text" required class="form-control" id="name" name="name" value="<?= $_SESSION["datos"]["name"] ?? "" ?>" ariadescribedby="name" placeholder="Introduce el nombre" required>
          <?= isset($errores["name"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "name") . '</div>' : ""; ?>
        </div>
        <br>

        <div class="form-group">
          <label for="teacher_id">Profesor</label>
          <select class="form-control" id="teacher_id" name="teacher_id" required>
            <option value="">Seleccione un profesor encargado del grupo</option>
            <?php foreach ($teachers as $teacher): ?>
              <option value="<?= $teacher->id ?>" <?= isset($datos["teacher_id"]) && $datos["teacher_id"] == $teacher->id ? 'selected' : '' ?>><?= $teacher->name ?></option>
            <?php endforeach; ?>
          </select>
          <?= isset($errores["teacher_id"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "teacher_id") . '</div>' : ""; ?>
        </div>
        <br>
        
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a class="btn btn-danger" href="backend.php">Cancelar</a>

    </form>

    <?php
    //Una vez mostrados los errores, los eliminamos
    unset($_SESSION["datos"]);
    unset($_SESSION["errores"]);
    ?>

 </div>
 
</main>