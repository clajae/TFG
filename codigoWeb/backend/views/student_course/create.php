<?php
require_once "assets/php/funciones.php";
require_once "controllers/studentsController.php";
require_once "controllers/coursesController.php";
require_once "controllers/students_coursesController.php";

$controlador = new Students_CoursesController();
$controladorStudents = new StudentsController();
$controladorCourses = new CoursesController();
$students_courses = $controlador->listar();
$students = $controladorStudents->listar();
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
    <h1 class="h3">Añadir nuevo curso</h1>
 </div>

 <div id="contenido">
    <div class="alert alert-danger <?= $visibilidad ?>"><?= $cadena ?></div>
    <form action="backend.php?tabla=student_course&accion=guardar&evento=crear" method="POST">

        <div class="form-group">
          <label for="student_id">Alumno que ha comprado el curso</label>
          <select class="form-control" id="student_id" name="student_id" required>
            <option value="">Seleccione un alumno</option>
            <?php foreach ($students as $student): ?>
              <option value="<?= $student->id ?>" <?= isset($datos["student_id"]) && $datos["student_id"] == $student->id ? 'selected' : '' ?>><?= $student->name ?></option>
            <?php endforeach; ?>
          </select>
          <?= isset($errores["student_id"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "student_id") . '</div>' : ""; ?>
        </div>
        <br>

        <div class="form-group">
          <label for="course_id">Curso que ha comprado</label>
          <select class="form-control" id="course_id" name="course_id" required>
            <option value="">Seleccione un profesor</option>
            <?php foreach ($courses as $course): ?>
              <option value="<?= $course->id ?>" <?= isset($datos["course_id"]) && $datos["course_id"] == $student->id ? 'selected' : '' ?>><?= $course->name ?></option>
            <?php endforeach; ?>
          </select>
          <?= isset($errores["course_id"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "course_id") . '</div>' : ""; ?>
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
