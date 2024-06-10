<?php
require_once "controllers/students_teachersController.php";
require_once "controllers/studentsController.php";
require_once "controllers/teachersController.php";

$controlador = new Students_TeachersController();
$controladorStudents = new StudentsController();
$controladorTeachers = new TeachersController();

$students_teachers = $controlador->listar();
$students = $controladorStudents->listar();
$teachers = $controladorTeachers->listar();

$visibilidad = "hidden";

try {
    if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "borrar") {
        $visibilidad = "visibility";
        $clase = "alert alert-success";
        
        $mensaje = "La unión de alumno y profesor con student_id: {$_REQUEST['student_id']} ¡Borrado correctamente!";
        
        if (isset($_REQUEST["error"])) {
            $clase = "alert alert-danger ";
            throw new Exception("ERROR!!! No se ha podido borrar la unión de alumno y profesor con student_id: {$_REQUEST['student_id']}");
        }
    }
} catch (Exception $deleteError) {
    $mensaje = $deleteError->getMessage();
}

?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Listado de alumnos y sus profesores</h1>
    </div>
    <div id="contenido">
        <div class="<?= $clase ?>" <?= $visibilidad ?> role="alert">
            <?= $mensaje ?>
        </div>
        <table class="table table-light table-hover">
            <?php
            if (count($students_teachers) <= 0) :
                echo "No hay Datos a Mostrar";
            else : ?>
                <table class="table table-light table-hover" style="text-align: center; border: 1px solid #2f3235;">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Nombre del estudiante</th>
                            <th scope="col">Nombre del profesor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students_teachers as $student_teacher) :
                            
                        ?>
                            <tr>
                                <?php
                                    foreach ($students as $student) : 
                                        if ($student_teacher->student_id == $student->id) {
                                            ?>  
                                            <th scope="row"><?= $student->name ?></th>  
                                            <?php
                                        }
                                    endforeach;

                                    foreach ($teachers as $teacher) : 
                                        if ($student_teacher->teacher_id == $teacher->id) {
                                            ?>  
                                            <th scope="row"><?= $teacher->name ?></th>  
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