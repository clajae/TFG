<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active disabled" aria-current="page" href="#">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="far fa-user"></i> Cursos</a>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <li><a class="dropdown-item" href="backendStudent.php?tabla=course&accion=listar">Listar </a></li>
                    <li><a class="dropdown-item" href="backendStudent.php?tabla=course&accion=buscar">Buscar </a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="far fa-user"></i> Profesores</a>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <li><a class="dropdown-item" href="backendStudent.php?tabla=teacher&accion=listar">Listar </a></li>
                    <li><a class="dropdown-item" href="backendStudent.php?tabla=teacher&accion=buscar">Buscar </a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="far fa-user"></i> Grupos de trabajo</a>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <li><a class="dropdown-item" href="backendStudent.php?tabla=workgroup&accion=listar">Listar </a></li>
                    <li><a class="dropdown-item" href="backendStudent.php?tabla=workgroup&accion=buscar">Buscar </a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
