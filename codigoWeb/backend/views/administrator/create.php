<?php
require_once "assets/php/funciones.php";

$cadenaErrores = "";
$cadena = "";
$errores = [];
$datos = [];
$visibilidad = "invisible";

if (isset($_REQUEST["error"])) {
  $errores = ($_SESSION["errores"]) ?? [];
  $datos = ($_SESSION["datos"]) ?? [];
  $cadena = "Atención Se han producido Errores";
  $visibilidad = "visible";
}

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

 <div class="d-flex justify-content-between flex-wrap flex-md-nowrap alignitems-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">Añadir nuevo profesor</h1>
 </div>

 <div id="contenido">
    <div class="alert alert-danger <?= $visibilidad ?>"><?= $cadena ?></div>
    <form action="backend.php?tabla=administrator&accion=guardar&evento=crear" method="POST">

        <div class="form-group">
          <label for="name">Nombre Completo</label>
          <input type="text" required class="form-control" id="name" name="name" value="<?= $_SESSION["datos"]["name"] ?? "" ?>" ariadescribedby="name" placeholder="Introduce su nombre completo" required>
          <?= isset($errores["name"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "name") . '</div>' : ""; ?>
        </div>
        <br>

        <div class="form-group">
          <label for="email">Correo electrónico</label>
          <input type="email" class="form-control" id="email" name="email" value="<?= $_SESSION["datos"]["email"] ?? "" ?>" pattern="^[^@\s]+@[^@\s]+\.[^@\s]+$" placeholder="Introduce su email" required>
          <?= isset($errores["email"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "email") . '</div>' : ""; ?>
        </div>
        <br>

        <div class="form-group">
          <label for="password">Contraseña</label>
          <input type="password" required class="form-control" id="password" name="password" value="<?= $_SESSION["datos"]["password"] ?? "" ?>" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{1,10}$" placeholder="Introduce su contraseña" required>
          <small id="password" class="form-text text-muted">Requisitos: (Máximo 10 carácteres) - (Al menos una letra minúscula) - (Al menos una letra mayúscula) - (Al menos un carácter especial)</small>
          <?= isset($errores["password"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "password") . '</div>' : ""; ?>
        </div>
        <br>

        <div class="form-group">
          <label for="phone">Teléfono</label>
          <input type="number" required class="form-control" id="phone" name="phone" value="<?= $_SESSION["datos"]["phone"] ?? "" ?>" pattern="(\+34\s?(\d{3}\s?\d{2}\s?\d{2}\s?\d{2}|\d{2}\s?\d{3}\s?\d{2}\s?\d{2}))|(\d{9})" placeholder="Introduce su teléfono" required>
          <?= isset($errores["phone"]) ? '<div class="alert alert-danger" role="alert">' . DibujarErrores($errores, "phone") . '</div>' : ""; ?>
        </div>
        <br>

        <input type="hidden" id="rol_id" name="rol_id" value="3">
        <br>
        
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a class="btn btn-danger" href="backend.php">Cancelar</a>

    </form>

    <?php
    //Una vez mostrados los errores, los eliminamos
    unset($_SESSION["datos"]);
    unset($_SESSION["errores"]);
    ?>

 </div>
 
</main>