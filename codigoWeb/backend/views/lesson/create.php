<?php
require_once "assets/php/funciones.php";
require_once "controllers/coursesController.php";

$controladorCourses = new CoursesController();
$courses = $controladorCourses->listar();

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
    <h1 class="h3">Añadir nueva lección</h1>
 </div>

 <div id="contenido">
    <div class="alert alert-danger <?= $visibilidad ?>"><?= $cadena ?></div>
    <form action="backend.php?tabla=lesson&accion=guardar&evento=crear" method="POST">

        <div class="form-group">
          <label for="name">Nombre de la lección</label>
          <input type="text" required class="form-control" id="name" name="name" value="<?= $_SESSION["datos"]["name"] ?? "" ?>" ariadescribedby="name" placeholder="Introduce el nombre de la lección" required>
          <?= isset($errores["name"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "name") . '</div>' : ""; ?>
        </div>
        <br>

        <div class="form-group">
          <label for="duration">Duración de la lección</label>
          <input type="text" required class="form-control" id="duration" name="duration" value="<?= $_SESSION["datos"]["duration"] ?? "" ?>" ariadescribedby="duration" placeholder="Introduce la duración de la lección" required>
          <small id="duration" class="form-text text-muted">Requisitos: (Introducelo como: h, min y seg) (Ejemplo: 1h 30min)</small>
          <?= isset($errores["duration"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "duration") . '</div>' : ""; ?>
        </div>
        <br>

        <div class="form-group">
          <label for="url">URL de la lección</label>
          <input type="text" required class="form-control" id="url" name="url" value="<?= $_SESSION["datos"]["url"] ?? "" ?>" ariadescribedby="url" placeholder="Introduce la URL del video de la lección" required>
          <?= isset($errores["url"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "url") . '</div>' : ""; ?>
        </div>
        <br>

        <div class="form-group">
          <label for="course_id">Cursos</label>
          <select class="form-control" id="course_id" name="course_id" required>
            <option value="">Seleccione el curso al que pertenece esta lección</option>
            <?php foreach ($courses as $course): ?>
              <option value="<?= $course->id ?>" <?= isset($datos["course_id"]) && $datos["course_id"] == $course->id ? 'selected' : '' ?>><?= $course->name ?></option>
            <?php endforeach; ?>
          </select>
          <?= isset($errores["course_id"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "course_id") . '</div>' : ""; ?>
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