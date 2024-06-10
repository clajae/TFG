<?php
require_once "controllers/workgroupsController.php";
require_once "controllers/teachersController.php";
require_once "controllers/studentsController.php";
require_once "controllers/students_workgroupsController.php";

$controlador = new WorkgroupsController();
$controladorTeachers = new TeachersController();
$controladorStudents = new StudentsController();
$controladorStudentsWorkgroups = new Students_WorkgroupsController();

$workgroups = $controlador->listar();
$teachers = $controladorTeachers->listar();
$students = $controladorStudents->listar();
$students_workgroups = $controladorStudentsWorkgroups->listar();

$visibilidad = "hidden";

try {
    if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "borrar") {
        $visibilidad = "visibility";
        $clase = "alert alert-success";
        
        $mensaje = "El grupo de trabajo con id: {$_REQUEST['id']} ¡Borrado correctamente!";
        
        if (isset($_REQUEST["error"])) {
            $clase = "alert alert-danger ";
            throw new Exception("ERROR!!! No se ha podido borrar el grupo de trabajo con id: {$_REQUEST['id']}");
        }
    }
} catch (Exception $deleteError) {
    $mensaje = $deleteError->getMessage();
}

?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Listado de grupos de trabajo</h1>
    </div>
    <div id="contenido">
        <div class="<?= $clase ?>" <?= $visibilidad ?> role="alert">
            <?= $mensaje ?>
        </div>
        <table class="table table-light table-hover">
            <?php
            if (count($workgroups) <= 0) :
                echo "No hay Datos a Mostrar";
            else : ?>
                <table class="table table-light table-hover" style="text-align: center; border: 1px solid #2f3235;">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Profesor encargado</th>
                            <th scope="col">Eliminar</th>
                            <th scope="col">Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($workgroups as $workgroup) :
                            $id = $workgroup->id;
                        ?>
                            <tr>
                                <th scope="row"><?= $workgroup->id ?></th>
                                <th scope="row"><?= $workgroup->name ?></th>
                                <?php
                                    foreach ($teachers as $teacher) : 
                                        if ($workgroup->teacher_id == $teacher->id) {
                                            ?>  
                                            <th scope="row"><?= $teacher->name ?></th>  
                                            <?php
                                    }
                                    endforeach;
                                ?> 

                                <td><a class="btn btn-danger" href="backend.php?tabla=workgroup&accion=borrar&id=<?= $id ?>"><i class="fa fa-trash"></i> Borrar</a></td>
                                <td><a class="btn btn-success" href="backend.php?tabla=workgroup&accion=editar&id=<?= $id ?>"><i class="fas fa-pencil-alt"></i> Editar</a></td>
                            </tr>
                            <thead>
                                <tr>
                                    <th scope="col" style="background-color: grey;">ID alumnos (grupo <?= $id ?>)</th>
                                    <th scope="col" style="background-color: grey;">Nombre alumnos (grupo <?= $id ?>)</th>
                                    <th scope="col" style="background-color: grey;">Email alumnos (grupo <?= $id ?>)</th>
                                    <th scope="col" style="background-color: grey;">Eliminar</th>
                                    <th scope="col" style="background-color: grey;">Editar</th>
                                </tr>
                            </thead>
                            <?php foreach ($students_workgroups as $student_workgroup) :

                                if ($student_workgroup->work_group_id == $workgroup->id) {
                            ?>
                            
                            <tr>                                   
                                <?php
                                    foreach ($students as $student) : 
                                        if ($student_workgroup->student_id == $student->id) {
                                            ?>  
                                            <th scope="row" style="background-color: silver;"><?= $student->id ?></th> 
                                            <th scope="row" style="background-color: silver;"><?= $student->name ?></th> 
                                            <th scope="row" style="background-color: silver;"><?= $student->email ?></th> 
                                            <?php
                                    }
                                    endforeach;
                                ?>
                                 
                                <td style="background-color: silver;"><a class="btn btn-danger" href="backend.php?tabla=course&accion=borrar&id=<?= $id ?>"><i class="fa fa-trash"></i> Borrar</a></td>
                                <td style="background-color: silver;"><a class="btn btn-success" href="backend.php?tabla=course&accion=editar&id=<?= $id ?>"><i class="fas fa-pencil-alt"></i> Editar</a></td>
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