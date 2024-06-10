<?php
require_once "controllers/coursesController.php";
require_once "controllers/teachersController.php";

$controlador = new coursesController();
$controladorTeachers = new teachersController();

$teachers = $controladorTeachers->listar();

$mensaje = "";
$clase = "alert alert-success";
$visibilidad = "hidden";
$mostrarDatos = false;
$course = "";
$texto = "";

if (isset($_REQUEST["evento"])) {
    $mostrarDatos = true;
    switch ($_REQUEST["evento"]) {
        case "todos":
            $courses = $controlador->listar();
            $mostrarDatos = true;
            break;
        case "filtrar":
            $texto = ($_REQUEST["busqueda"]) ?? "";
            $campo = ($_REQUEST["opcionesTipoBusqueda"]) ?? "";
            $modoBusqueda = ($_REQUEST["modoBusqueda"]) ?? "";
            // comprobarSiEsBorrable: true -> es lo mismo que = true (solo)
            $courses = $controlador->buscar($campo, $modoBusqueda, $texto);
            // $courses = $controlador->buscar($course);
            break;
        case "borrar":
            try {

                $visibilidad = "visibility";
                $mostrarDatos = true;
                $clase = "alert alert-success";
                $mensaje = "El curso con id: {$_REQUEST['id']} ¡Borrado correctamente!";
                if (isset($_REQUEST["error"])) {
                    $clase = "alert alert-danger ";
                    $mensaje = "ERROR!!! No se ha podido borrar el curso con id: {$_REQUEST['id']}";
                }

            } catch (Exception $deleteError) {
                $mensaje = $deleteError->getMessage();
            }
            break;
    }
} ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Buscar Curso</h1>
    </div>
    <div id="contenido">
        <div class="<?= $clase ?>" <?= $visibilidad ?> role="alert">
            <?= $mensaje ?>
        </div>
        <div>
        <form action="backend.php?tabla=course&accion=buscar&evento=filtrar" method="POST">
            <div class="form-group">
                <label for="course">Buscar curso</label>
                <select name="opcionesTipoBusqueda" id="opcionesTipoBusqueda">
                    <option value="id" <?php if(isset($_POST['opcionesTipoBusqueda']) && $_POST['opcionesTipoBusqueda'] == 'id') echo 'selected="selected"'; ?>>Id</option>
                    <option value="name" <?php if(isset($_POST['opcionesTipoBusqueda']) && $_POST['opcionesTipoBusqueda'] == 'name') echo 'selected="selected"'; ?>>Nombre</option>
                    <option value="duration" <?php if(isset($_POST['opcionesTipoBusqueda']) && $_POST['opcionesTipoBusqueda'] == 'duration') echo 'selected="selected"'; ?>>Duración</option>
                    <option value="num_lessons" <?php if(isset($_POST['opcionesTipoBusqueda']) && $_POST['opcionesTipoBusqueda'] == 'num_lessons') echo 'selected="selected"'; ?>>Nº Lecciones</option>
                    <option value="teacher_id" <?php if(isset($_POST['opcionesTipoBusqueda']) && $_POST['opcionesTipoBusqueda'] == 'teacher_id') echo 'selected="selected"'; ?>>ID Profesor</option>
                </select>
                <br>

                <input type="text" required class="form-contteacher" id="busqueda" name="busqueda" value="<?= $texto ?>" placeholder="Buscar">
                <br><label for="cliente2">Opciones de Búsqueda:</label>

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
        <form action="backend.php?tabla=course&accion=buscar&evento=todos" method="POST">
            <button type="submit" class="btn btn-info" name="Todos"><i class="fas fa-list"></i> Listar</button>
        </form>
        </div>
        <?php
        if ($mostrarDatos) {
        ?>
            <table class="table table-light table-hover" style="text-align: center; border: 1px solid #2f3235;">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Duración</th>
                        <th scope="col">Nº Lecciones</th>
                        <th scope="col">ID Profesor</th>
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
                            <td><?= $course->name ?></td>
                            <td><?= $course->duration ?></td>
                            <td><?= $course->num_lessons ?></td>
                            <?php
   
                                    foreach ($teachers as $teacher) : 
                                        if ($course->teacher_id == $teacher->id) {
                                            ?>  
                                            <th scope="row"><?= $teacher->name ?></th>  
                                            <?php
                                    }
                                    endforeach;
                                ?>

                            <?php
                                // $disable="";
                                $ruta="backend.php?tabla=course&accion=borrar&id={$id}";
                                // if (isset($course->esBorrable) && $course->esBorrable==false){
                                //     $disable="disabled"; 
                                //     $ruta="#";
                                // }
                            ?>

                            <td><a class="btn btn-danger <?= $disable?>" href="<?=$ruta?>"><i class="fa fa-trash"></i> Borrar</a></td>
                            <td><a class="btn btn-success" href="backend.php?tabla=course&accion=editar&id=<?=$id?>"><i class="fa fa-pencil"></i>Editar</a></td>
                        </tr>
                    <?php
                    endforeach;

                    ?>
                </tbody>
            </table>
        <?php
        }
        ?>
    </div>
</main>