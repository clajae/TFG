<?php
require_once "assets/php/funciones.php";
require_once "controllers/teachersController.php";
require_once "controllers/studentsController.php";

$controladorTeachers = new TeachersController();
$controladorStudents = new StudentsController();
$teachers = $controladorTeachers->listar();
$students = $controladorStudents->listar();


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
    <h1 class="h3">Vincular un alumno con el profesor del curso que ha comprado</h1>
 </div>

 <div id="contenido">
    <div class="alert alert-danger <?= $visibilidad ?>"><?= $cadena ?></div>
    <form action="backend.php?tabla=student_teacher&accion=guardar&evento=crear" method="POST">

        <div class="form-group">
          <label for="student_id">Alumno </label>
          <select class="form-control" id="student_id" name="student_id" required>
            <option value="">Seleccione un alumno al que vincular con el profesor de su curso</option>
            <?php foreach ($students as $student): ?>
              <option value="<?= $student->id ?>" <?= isset($datos["student_id"]) && $datos["student_id"] == $student->id ? 'selected' : '' ?>><?= $student->name ?></option>
            <?php endforeach; ?>
          </select>
          <?= isset($errores["student_id"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "student_id") . '</div>' : ""; ?>
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
    //Una vez mostrados los errores, los eliminamos
    unset($_SESSION["datos"]);
    unset($_SESSION["errores"]);
    ?>

 </div>
 
</main>