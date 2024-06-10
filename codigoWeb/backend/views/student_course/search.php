<?php
require_once "controllers/students_coursesController.php";
require_once "controllers/studentsController.php";
require_once "controllers/coursesController.php";

$controlador = new students_coursesController();
$controladorStudents = new studentsController();
$controladorCourses = new coursesController();

$students_courses = $controlador->listar();
$students = $controladorStudents->listar();
$courses = $controladorCourses->listar();

$mensaje = "";
$clase = "alert alert-success";
$visibilidad = "hidden";
$mostrarDatos = false;
$student_course = "";
$texto = "";

if (isset($_REQUEST["evento"])) {
    $mostrarDatos = true;
    switch ($_REQUEST["evento"]) {
        case "todos":
            $students_courses = $controlador->listar();
            $mostrarDatos = true;
            break;
        case "filtrar":
            $texto = ($_REQUEST["busqueda"]) ?? "";
            $campo = ($_REQUEST["opcionesTipoBusqueda"]) ?? "";
            $modoBusqueda = ($_REQUEST["modoBusqueda"]) ?? "";
            $students_courses = $controlador->buscar($campo, $modoBusqueda, $texto);
            break;
        case "borrar":
            try {
                $visibilidad = "visibility";
                $mostrarDatos = true;
                $clase = "alert alert-success";
                $mensaje = "La unión de alumno y curso comprado con student_id: {$_REQUEST['student_id']} ¡Borrado correctamente!";
                if (isset($_REQUEST["error"])) {
                    $clase = "alert alert-danger ";
                    $mensaje = "ERROR!!! No se ha podido borrar la unión de alumno y curso comprado con student_id: {$_REQUEST['student_id']}";
                }
            } catch (Exception $deleteError) {
                $mensaje = $deleteError->getMessage();
            }
            break;
    }
}
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Buscar Alumnos y Sus Cursos Comprados</h1>
    </div>
    <div id="contenido">
        <div class="<?= $clase ?>" style="visibility: <?= $visibilidad ?>;" role="alert">
            <?= $mensaje ?>
        </div>
        <div>
        <form action="backend.php?tabla=student_course&accion=buscar&evento=filtrar" method="POST">
            <div class="form-group">
                <label for="student_course">Buscar Alumnos y Sus Cursos Comprados</label>
                <select name="opcionesTipoBusqueda" id="opcionesTipoBusqueda">
                    <option value="student_id" <?php if(isset($_POST['opcionesTipoBusqueda']) && $_POST['opcionesTipoBusqueda'] == 'student_id') echo 'selected="selected"'; ?>>ID Alumno</option>
                    <option value="course_id" <?php if(isset($_POST['opcionesTipoBusqueda']) && $_POST['opcionesTipoBusqueda'] == 'course_id') echo 'selected="selected"'; ?>>ID Curso</option>
                </select>
                <input type="text" required class="form-control" id="busqueda" name="busqueda" value="<?= $texto ?>" placeholder="Buscar">
                <label for="cliente2">Opciones de Búsqueda:</label>
                <select name="modoBusqueda" id="modoBusqueda">
                    <option value="empiezaPor" <?php if(isset($_POST['modoBusqueda']) && $_POST['modoBusqueda'] == 'empiezaPor') echo 'selected="selected"'; ?>>Empieza por</option>
                    <option value="acabaEn" <?php if(isset($_POST['modoBusqueda']) && $_POST['modoBusqueda'] == 'acabaEn') echo 'selected="selected"'; ?>>Acaba en</option>
                    <option value="contiene" <?php if(isset($_POST['modoBusqueda']) && $_POST['modoBusqueda'] == 'contiene') echo 'selected="selected"'; ?>>Contiene</option>
                    <option value="iguala" <?php if(isset($_POST['modoBusqueda']) && $_POST['modoBusqueda'] == 'iguala') echo 'selected="selected"'; ?>>Igual a</option>
                </select>
            </div>
            <br>
            <button type="submit" class="btn btn-success" name="Filtrar"><i class="fas fa-search"></i> Buscar</button>
        </form>
        <!-- Este formulario es para ver todos los datos    -->
        <form action="backend.php?tabla=student_course&accion=buscar&evento=todos" method="POST">
            <button type="submit" class="btn btn-info" name="Todos"><i class="fas fa-list"></i> Listar</button>
        </form>
        </div>
        <?php
        if ($mostrarDatos) {
        ?>
            <table class="table table-light table-hover" style="text-align: center; border: 1px solid #2f3235;">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID Alumno (Nombre Alumno)</th>
                        <th scope="col">ID Curso (Nombre Curso)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students_courses as $student_course) : ?>
                        <tr>
                            <?php
                            foreach ($students as $student) :
                                if ($student_course->student_id == $student->id) {
                                    ?>
                                    <th scope="row"><?= $student_course->student_id ?> (<?= $student->name ?>)</th>
                                    <?php
                                }
                            endforeach;

                            foreach ($courses as $course) :
                                if ($student_course->course_id == $course->id) {
                                    ?>
                                    <th scope="row"><?= $student_course->course_id ?> (<?= $course->name ?>)</th>
                                    <?php
                                }
                            endforeach;

                            // Define la variable $id correctamente
                            $id = isset($student_course->id) ? $student_course->id : null;

                            // Define la variable $disable correctamente
                            $disable = "";
                            $ruta = "backend.php?tabla=student_course&accion=borrar&student_id={$student_course->student_id}";
                            ?>

                            <!-- <td><a class="btn btn-danger <?= $disable ?>" href="<?= $ruta ?>"><i class="fa fa-trash"></i> Borrar</a></td> -->
                            <!-- <td><a class="btn btn-success" href="backend.php?tabla=student_course&accion=editar&id=<?= $id ?>"><i class="fa fa-pencil"></i> Editar</a></td> -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php
        }
        ?>
    </div>
</main>
