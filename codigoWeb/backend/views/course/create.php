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
    <h1 class="h3">Añadir nuevo curso</h1>
 </div>

 <div id="contenido">
    <div class="alert alert-danger <?= $visibilidad ?>"><?= $cadena ?></div>
    <form action="backend.php?tabla=course&accion=guardar&evento=crear" method="POST">

        <div class="form-group">
          <label for="name">Nombre</label>
          <input type="text" class="form-control" id="name" name="name" value="<?= $_SESSION["datos"]["name"] ?? "" ?>" ariadescribedby="name" placeholder="Introduce su nombre" required>
          <?= isset($errores["name"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "name") . '</div>' : ""; ?>
        </div>
        <br>

        <div class="form-group">
          <label for="duration">Duración</label>
          <input type="text" class="form-control" id="duration" name="duration" value="<?= $_SESSION["datos"]["duration"] ?? "" ?>" ariadescribedby="duration" placeholder="Introduce su duración" required>
          <?= isset($errores["duration"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "duration") . '</div>' : ""; ?>
        </div>
        <br>
        
        <div class="form-group">
          <label for="num_lessons">Nº lecciones</label>
          <input type="number" class="form-control" id="num_lessons" name="num_lessons" value="<?= $_SESSION["datos"]["num_lessons"] ?? "" ?>" ariadescribedby="num_lessons" placeholder="Introduce su número de lecciones" maxlength="4" required>
          <?= isset($errores["num_lessons"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "num_lessons") . '</div>' : ""; ?>
        </div>
        <br>

        <div class="form-group">
          <label for="teacher_id">Profesor</label>
          <select class="form-control" id="teacher_id" name="teacher_id" required>
            <option value="">Seleccione un profesor</option>
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
    // Una vez mostrados los errores, los eliminamos
    unset($_SESSION["datos"]);
    unset($_SESSION["errores"]);
    ?>

 </div>
 
</main>
