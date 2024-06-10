<?php
require_once "controllers/studentsController.php";
require_once "controllers/rolesController.php";

$controlador = new StudentsController();
$controladorRoles = new RolesController();

$roles = $controladorRoles->listar();

$mensaje = "";
$clase = "alert alert-success";
$visibilidad = "hidden";
$mostrarDatos = false;
$student = "";
$texto = "";

if (isset($_REQUEST["evento"])) {
    $mostrarDatos = true;
    switch ($_REQUEST["evento"]) {
        case "todos":
            $students = $controlador->listar();
            $mostrarDatos = true;
            break;
        case "filtrar":
            $texto = ($_REQUEST["busqueda"]) ?? "";
            $campo = ($_REQUEST["opcionesTipoBusqueda"]) ?? "";
            $modoBusqueda = ($_REQUEST["modoBusqueda"]) ?? "";
            // comprobarSiEsBorrable: true -> es lo mismo que = true (solo)
            $students = $controlador->buscar($campo, $modoBusqueda, $texto);
            // $students = $controlador->buscar($student);
            break;
        case "borrar":
            try {

                $visibilidad = "visibility";
                $mostrarDatos = true;
                $clase = "alert alert-success";
                $mensaje = "El alumno con id: {$_REQUEST['id']} ¡Borrado correctamente!";
                if (isset($_REQUEST["error"])) {
                    $clase = "alert alert-danger ";
                    $mensaje = "ERROR!!! No se ha podido borrar el alumno con id: {$_REQUEST['id']}";
                }

            } catch (Exception $deleteError) {
                $mensaje = $deleteError->getMessage();
            }
            break;
    }
} ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Buscar alumno</h1>
    </div>
    <div id="contenido">
        <div class="<?= $clase ?>" <?= $visibilidad ?> role="alert">
            <?= $mensaje ?>
        </div>
        <div>
        <form action="backend.php?tabla=student&accion=buscar&evento=filtrar" method="POST">
            <div class="form-group">
                <label for="student">Buscar alumno</label>
                <select name="opcionesTipoBusqueda" id="opcionesTipoBusqueda">
                    <option value="id" <?php if(isset($_POST['opcionesTipoBusqueda']) && $_POST['opcionesTipoBusqueda'] == 'id') echo 'selected="selected"'; ?>>Id</option>
                    <option value="name" <?php if(isset($_POST['opcionesTipoBusqueda']) && $_POST['opcionesTipoBusqueda'] == 'name') echo 'selected="selected"'; ?>>Nombre</option>
                    <option value="email" <?php if(isset($_POST['opcionesTipoBusqueda']) && $_POST['opcionesTipoBusqueda'] == 'email') echo 'selected="selected"'; ?>>Email</option>
                    <option value="phone" <?php if(isset($_POST['opcionesTipoBusqueda']) && $_POST['opcionesTipoBusqueda'] == 'phone') echo 'selected="selected"'; ?>>Teléfono</option>
                    <option value="nationality" <?php if(isset($_POST['opcionesTipoBusqueda']) && $_POST['opcionesTipoBusqueda'] == 'nationality') echo 'selected="selected"'; ?>>Nacionalidad</option>
                    <option value="age" <?php if(isset($_POST['opcionesTipoBusqueda']) && $_POST['opcionesTipoBusqueda'] == 'age') echo 'selected="selected"'; ?>>Edad</option>
                    <option value="rol" <?php if(isset($_POST['opcionesTipoBusqueda']) && $_POST['opcionesTipoBusqueda'] == 'rol') echo 'selected="selected"'; ?>>Rol</option>
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
        <form action="backend.php?tabla=student&accion=buscar&evento=todos" method="POST">
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
                        <th scope="col">Email</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Nacionalidad</th>
                        <th scope="col">Edad</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Eliminar</th>
                        <th scope="col">Editar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student) :
                        $id = $student->id;
                    ?>
                        <tr>
                            <th scope="row"><?= $student->id ?></th>
                            <td><?= $student->name ?></td>
                            <td><?= $student->email ?></td>
                            <td><?= $student->phone ?></td>
                            <td><?= $student->nationality ?></td>
                            <td><?= $student->age ?></td>
                            <?php
   
                                    foreach ($roles as $rol) : 
                                        if ($student->rol_id == $rol->id) {
                                            ?>  
                                            <th scope="row"><?= $rol->name ?></th>  
                                            <?php
                                    }
                                    endforeach;
                                ?>

                            <?php
                                // $disable="";
                                $ruta="backend.php?tabla=student&accion=borrar&id={$id}";
                                // if (isset($student->esBorrable) && $student->esBorrable==false){
                                //     $disable="disabled"; 
                                //     $ruta="#";
                                // }
                            ?>

                            <td><a class="btn btn-danger <?= $disable?>" href="<?=$ruta?>"><i class="fa fa-trash"></i> Borrar</a></td>
                            <td><a class="btn btn-success" href="backend.php?tabla=student&accion=editar&id=<?=$id?>"><i class="fa fa-pencil"></i>Editar</a></td>
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