<?php
require_once "controllers/usersController.php";
require_once "controllers/rolesController.php";

$controlador = new UsersController();
$controladorRoles = new RolesController();

$users = $controlador->listar();
$roles = $controladorRoles->listar();

$visibilidad = "hidden";

try {
    if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "borrar") {
        $visibilidad = "visibility";
        $clase = "alert alert-success";
        
        $mensaje = "El usuario con id: {$_REQUEST['id']} ¡Borrado correctamente!";
        
        if (isset($_REQUEST["error"])) {
            $clase = "alert alert-danger ";
            throw new Exception("ERROR!!! No se ha podido borrar el usuario con id: {$_REQUEST['id']}");
        }
    }
} catch (Exception $deleteError) {
    $mensaje = $deleteError->getMessage();
}

?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Listado de usuarios</h1>
    </div>
    <div id="contenido">
        <div class="<?= $clase ?>" <?= $visibilidad ?> role="alert">
            <?= $mensaje ?>
        </div>
        <table class="table table-light table-hover">
            <?php
            if (count($users) <= 0) :
                echo "No hay Datos a Mostrar";
            else : ?>
                <table class="table table-light table-hover" style="text-align: center; border: 1px solid #2f3235;">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Email</th>
                            <th scope="col">Password</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) :
                            $id = $user->id;
                        ?>
                            <tr>
                                <th scope="row"><?= $user->id ?></th>
                                <th scope="row"><?= $user->name ?></th>
                                <th scope="row"><?= $user->email ?></th>
                                <th scope="row"><?= $user->password_key ?></th>
                                <?php
                                    foreach ($roles as $rol) : 
                                        if ($user->rol_id == $rol->id) {
                                            ?>  
                                            <th scope="row"><?= $rol->name ?></th>  
                                            <?php
                                    }
                                    endforeach;
                                ?>

                                <td><a class="btn btn-danger" href="backend.php?tabla=user&accion=borrar&id=<?= $id ?>"><i class="fa fa-trash"></i> Borrar</a></td>
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