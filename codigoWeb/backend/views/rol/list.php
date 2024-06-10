<?php
require_once "controllers/rolesController.php";

$controlador = new rolesController();
$roles = $controlador->listar();
$visibilidad = "hidden";

try {
    if (isset($_REQUEST["evento"]) && $_REQUEST["evento"] == "borrar") {
        $visibilidad = "visibility";
        $clase = "alert alert-success";
        
        $mensaje = "El rol con id: {$_REQUEST['id']} ¡Borrado correctamente!";
        
        if (isset($_REQUEST["error"])) {
            $clase = "alert alert-danger ";
            throw new Exception("ERROR!!! No se ha podido borrar el rol con id: {$_REQUEST['id']}");
        }
    }
} catch (Exception $deleteError) {
    $mensaje = $deleteError->getMessage();
}

?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3">Listado de roles</h1>
    </div>
    <div id="contenido">
        <div class="<?= $clase ?>" <?= $visibilidad ?> rol="alert">
            <?= $mensaje ?>
        </div>
        <table class="table table-light table-hover">
            <?php
            if (count($roles) <= 0) :
                echo "No hay Datos a Mostrar";
            else : ?>
                <table class="table table-light table-hover" style="text-align: center; border: 1px solid #2f3235;">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Eliminar</th>
                            <th scope="col">Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($roles as $rol) :
                            $id = $rol->id;
                        ?>
                            <tr>
                                <th scope="row"><?= $rol->id ?></th>
                                <th scope="row"><?= $rol->name ?></th>
                                <td><a class="btn btn-danger" href="backend.php?tabla=rol&accion=borrar&id=<?= $id ?>"><i class="fa fa-trash"></i> Borrar</a></td>
                                <td><a class="btn btn-success" href="backend.php?tabla=rol&accion=editar&id=<?= $id ?>"><i class="fas fa-pencil-alt"></i> Editar</a></td>
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