<?php
require_once "assets/php/funciones.php";
require_once "controllers/workgroupsController.php";
require_once "controllers/studentsController.php";

$controladorWorkgroups = new WorkgroupsController();
$controladorStudents = new StudentsController();
$workgroups = $controladorWorkgroups->listar();
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
    <h1 class="h3">Vincular un alumno con un grupo de trabajo</h1>
 </div>

 <div id="contenido">
    <div class="alert alert-danger <?= $visibilidad ?>"><?= $cadena ?></div>
    <form action="backend.php?tabla=student_workgroup&accion=guardar&evento=crear" method="POST">

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
          <label for="work_group_id">Grupo de trabajo</label>
          <select class="form-control" id="work_group_id" name="work_group_id" required>
            <option value="">Seleccione un grupo de trabajo</option>
            <?php foreach ($workgroups as $workgroup): ?>
              <option value="<?= $workgroup->id ?>" <?= isset($datos["work_group_id"]) && $datos["work_group_id"] == $workgroup->id ? 'selected' : '' ?>><?= $workgroup->name ?></option>
            <?php endforeach; ?>
          </select>
          <?= isset($errores["work_group_id"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "work_group_id") . '</div>' : ""; ?>
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