<?php
require_once "controllers/students_coursesController.php";
require_once "controllers/studentsController.php";
require_once "controllers/coursesController.php";

$controlador = new Students_CoursesController();
$controladorStudents = new StudentsController();
$controladorCourses = new CoursesController();

$students_courses = $controlador->listar();
$students = $controladorStudents->listar();
$courses = $controladorCourses->listar();

$visibilidad = "hidden";

try {
    if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "borrar") {
        $visibilidad = "visibility";
        $clase = "alert alert-success";
        
        $mensaje = "La unión de alumno y curso comprado con id: {$_REQUEST['id']} ¡Borrado correctamente!";
        
        if (isset($_REQUEST["error"])) {
            $clase = "alert alert-danger ";
            throw new Exception("ERROR!!! No se ha podido borrar la unión de alumno y curso comprado con id: {$_REQUEST['id']}");
        }
    }
} catch (Exception $deleteError) {
    $mensaje = $deleteError->getMessage();
}

?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Listado de alumnos y sus cursos comprados</h1>
    </div>
    <div id="contenido">
        <div class="<?= $clase ?>" <?= $visibilidad ?> role="alert">
            <?= $mensaje ?>
        </div>
        <table class="table table-light table-hover">
            <?php
            if (count($students_courses) <= 0) :
                echo "No hay Datos a Mostrar";
            else : ?>
                <table class="table table-light table-hover" style="text-align: center; border: 1px solid #2f3235;">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Nombre del estudiante</th>
                            <th scope="col">Nombre del curso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students_courses as $student_course) :
                            
                        ?>
                            <tr>
                                <?php
                                    foreach ($students as $student) : 
                                        if ($student_course->student_id == $student->id) {
                                            ?>  
                                            <th scope="row"><?= $student->name ?></th>  
                                            <?php
                                        }
                                    endforeach;

                                    foreach ($courses as $course) : 
                                        if ($student_course->course_id == $course->id) {
                                            ?>  
                                            <th scope="row"><?= $course->name ?></th>  
                                            <?php
                                        }
                                    endforeach;
                                ?>
                            </tr>
                        <?php
                        endforeach;

                        ?>
                    </tbody>
                </table>
            <?php
            endif;
            ?>
    </div>
</main>