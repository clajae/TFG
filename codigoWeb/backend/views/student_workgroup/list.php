<?php
require_once "controllers/students_workgroupsController.php";
require_once "controllers/studentsController.php";
require_once "controllers/workgroupsController.php";

$controlador = new Students_WorkgroupsController();
$controladorStudents = new StudentsController();
$controladorWorkgroups = new WorkgroupsController();

$students_workgroups = $controlador->listar();
$students = $controladorStudents->listar();
$workgroups = $controladorWorkgroups->listar();

$visibilidad = "hidden";

try {
    if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "borrar") {
        $visibilidad = "visibility";
        $clase = "alert alert-success";
        
        $mensaje = "La unión de alumno y su grupo de trabajo con student_id: {$_REQUEST['student_id']} ¡Borrado correctamente!";
        
        if (isset($_REQUEST["error"])) {
            $clase = "alert alert-danger ";
            throw new Exception("ERROR!!! No se ha podido borrar la unión de alumno y su grupo de trabajo con student_id: {$_REQUEST['student_id']}");
        }
    }
} catch (Exception $deleteError) {
    $mensaje = $deleteError->getMessage();
}

?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Listado de alumnos y sus grupos de trabajo</h1>
    </div>
    <div id="contenido">
        <div class="<?= $clase ?>" <?= $visibilidad ?> role="alert">
            <?= $mensaje ?>
        </div>
        <table class="table table-light table-hover">
            <?php
            if (count($students_workgroups) <= 0) :
                echo "No hay Datos a Mostrar";
            else : ?>
                <table class="table table-light table-hover" style="text-align: center; border: 1px solid #2f3235;">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Nombre del estudiante</th>
                            <th scope="col">Nombre del grupo de trabajo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students_workgroups as $student_workgroup) :
                            
                        ?>
                            <tr>
                                <?php
                                    foreach ($students as $student) : 
                                        if ($student_workgroup->student_id == $student->id) {
                                            ?>  
                                            <th scope="row"><?= $student->name ?></th>  
                                            <?php
                                    }
                                    endforeach;

                                    foreach ($workgroups as $workgroup) : 
                                        if ($student_workgroup->work_group_id == $workgroup->id) {
                                            ?>  
                                            <th scope="row"><?= $workgroup->name ?></th>  
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