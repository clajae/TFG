<?php
session_start();
$email = ($_POST["email"]) ?? "";
$password_key = ($_POST["password_key"]) ?? "";
$rol_id = ($_POST["rol_id"]) ?? "";
$error = false;

if (isset($_POST["email"], $_POST["password_key"], $_POST["rol_id"])) {

    require_once "models/userModel.php";
    require_once "controllers/usersController.php";
    $userModel = new userModel();
    $usersController = new usersController();
    $users = $usersController->listar();

    if ($email != null) {
        $_SESSION["email"] = $email;

        // Verifica si el usuario está en la lista de usuarios
        $userFound = false;
        foreach ($users as $user) {
            if ($user->email == $email && $user->password_key == $password_key) {
                $userFound = true;
                if ($user->rol_id == 1) {
                    header("Location: backendStudent.php");
                    exit;
                } elseif ($user->rol_id == 2) {
                    header("Location: backendTeacher.php");
                    exit;
                } elseif ($user->rol_id == 3) {
                    header("Location: backend.php");
                    exit;
                }
            }
        }
        
        // Si el usuario no está en la lista o las credenciales son incorrectas
        if (!$userFound) {
            $error = true;
        }
    }
}

$msg = "";
$visibilidad = "";
$style = "";
if ($error) {
    $msg = "Error, email o Contraseña Incorrectos";
    $visibilidad = "visible";
    $style = "alert-danger";
}

if (isset($_GET["session"]) && ($_GET["session"] == "logout")) {
    $msg = "Fin de Sesion";
    $visibilidad = "visible";
    $style = "alert-success";
}
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RTEA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome/4.7.0/css/font-awesome.min.css">
    <link href="assets/css/sign-in.css" rel="stylesheet">
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signin w-100 m-auto">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
            <center><img class="mb-4" src="assets/img/proyecto.png" alt="" width="150" height="150"></center>
            <div class="alert <?= $style . ' ' . $visibilidad ?>"><?= $msg ?></div>
            <h1 class="h3 mb-3 fw-normal">Inicio de Sesión</h1>
            <div class="form-floating">
                <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>">
                <label for="email">Email</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password_key" name="password_key" value="<?= $password_key ?>">
                <label for="password_key">Contraseña</label>
            </div>
            <div class="form-floating">
                <select hidden class="form-select" id="rol_id" name="rol_id">
                    <option value="1">Estudiante</option>
                    <option value="2">Profesor</option>
                    <option value="3">Administrador</option>
                </select>
            </div>
            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">Recuérdame</label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit">Iniciar sesión</button>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>
