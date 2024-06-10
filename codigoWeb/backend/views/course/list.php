<?php
require_once "controllers/coursesController.php";
require_once "controllers/lessonsController.php";
require_once "controllers/teachersController.php";

$controlador = new CoursesController();
$controladorLessons = new LessonsController();
$controladorTeachers = new TeachersController();

$courses = $controlador->listar();
$lessons = $controladorLessons->listar();
$teachers = $controladorTeachers->listar();

$visibilidad = "hidden";

try {
    if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "borrar") {
        $visibilidad = "visibility";
        $clase = "alert alert-success";
        
        $mensaje = "El curso con id: {$_REQUEST['id']} ¡Borrado correctamente!";
        
        if (isset($_REQUEST["error"])) {
            $clase = "alert alert-danger ";
            throw new Exception("ERROR!!! No se ha podido borrar el curso con id: {$_REQUEST['id']}");
        }
    }
} catch (Exception $deleteError) {
    $mensaje = $deleteError->getMessage();
}

?>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Listado de cursos</h1>
    </div>
    <div id="contenido">
        <div class="<?= $clase ?>" <?= $visibilidad ?> role="alert">
            <?= $mensaje ?>
        </div>
        <table class="table table-light table-hover">
            <?php
            if (count($courses) <= 0 && count($lessons) <= 0) :
                echo "No hay Datos a Mostrar";
            else : ?>
                <table class="table table-light table-hover" style="text-align: center; border: 1px solid #2f3235;">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Duración</th>
                            <th scope="col">Nº lecciones</th>
                            <th scope="col">Profesor</th>
                            <th scope="col">Eliminar</th>
                            <th scope="col">Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($courses as $course) :
                            $id = $course->id;
                        ?>
                            <tr>
                                <th scope="row"><?= $course->id ?></th>
                                <th scope="row"><?= $course->name ?></th>
                                <th scope="row"><?= $course->duration ?></th>
                                <th scope="row"><?= $course->num_lessons ?></th>
                                <?php
                                    foreach ($teachers as $teacher) : 
                                        if ($course->teacher_id == $teacher->id) {
                                            ?>  
                                            <th scope="row"><?= $teacher->name ?></th>  
                                            <?php
                                    }
                                    endforeach;
                                ?>                              

                                <td><a class="btn btn-danger" href="backend.php?tabla=course&accion=borrar&id=<?= $id ?>"><i class="fa fa-trash"></i> Borrar</a></td>
                                <td><a class="btn btn-success" href="backend.php?tabla=course&accion=editar&id=<?= $id ?>"><i class="fas fa-pencil-alt"></i> Editar</a></td>
                            </tr>
                            <thead>
                                <tr>
                                    <th scope="col" style="background-color: grey;"></th>
                                    <th scope="col" style="background-color: grey;">Lección ID</th>
                                    <th scope="col" style="background-color: grey;">Nombre de la lección</th>
                                    <th scope="col" style="background-color: grey;">Duración</th>
                                    <th scope="col" style="background-color: grey;">ID del curso</th>
                                    <th scope="col" style="background-color: grey;">Eliminar</th>
                                    <th scope="col" style="background-color: grey;">Editar</th>
                                </tr>
                            </thead>
                            <?php foreach ($lessons as $lesson) :
                                $lesson_id = $lesson->id;

                                if ($course->id == $lesson->course_id) {
                            ?>
                            
                            <tr>                                   
                                <th style="background-color: silver;"></th>
                                <th scope="row" style="background-color: silver;"><?= $lesson->id ?></th>
                                <th scope="row" style="background-color: silver;"><?= $lesson->name ?></th>
                                <th scope="row" style="background-color: silver;"><?= $lesson->duration ?></th>
                                <th scope="row" style="background-color: silver;"><?= $lesson->course_id ?></th>
                                <td style="background-color: silver;"><a class="btn btn-danger" href="backend.php?tabla=lesson&accion=borrar&id=<?= $id ?>"><i class="fa fa-trash"></i> Borrar</a></td>
                                <td style="background-color: silver;"><a class="btn btn-success" href="backend.php?tabla=lesson&accion=editar&id=<?= $id ?>"><i class="fas fa-pencil-alt"></i> Editar</a></td>
                            <?php
                                }
                            ?>
                                </th>
                                <?php
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