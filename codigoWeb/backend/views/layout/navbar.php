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
            <a class="nav-link dropdown-toggle" href="backend.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="far fa-user"></i> Usuarios</a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="backend.php?tabla=user&accion=listar">Listar </a></li>
              <li><a class="dropdown-item" href="backend.php?tabla=user&accion=buscar">Buscar </a></li>
          </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="backend.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="far fa-user"></i> Administradores</a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="backend.php?tabla=administrator&accion=crear">Añadir</a></li>
              <li><a class="dropdown-item" href="backend.php?tabla=administrator&accion=listar">Listar </a></li>
              <li><a class="dropdown-item" href="backend.php?tabla=administrator&accion=buscar">Buscar </a></li>
          </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="backend.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="far fa-user"></i> Profesores</a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="backend.php?tabla=teacher&accion=crear">Añadir</a></li>
              <li><a class="dropdown-item" href="backend.php?tabla=teacher&accion=listar">Listar </a></li>
              <li><a class="dropdown-item" href="backend.php?tabla=teacher&accion=buscar">Buscar </a></li>
          </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="backend.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="far fa-user"></i> Alumnos</a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="backend.php?tabla=student&accion=crear">Añadir</a></li>
              <li><a class="dropdown-item" href="backend.php?tabla=student&accion=listar">Listar </a></li>
              <li><a class="dropdown-item" href="backend.php?tabla=student&accion=buscar">Buscar </a></li>
          </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="backend.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="far fa-user"></i> Cursos</a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="backend.php?tabla=course&accion=crear">Añadir</a></li>
              <li><a class="dropdown-item" href="backend.php?tabla=course&accion=listar">Listar </a></li>
              <li><a class="dropdown-item" href="backend.php?tabla=course&accion=buscar">Buscar </a></li>
          </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="backend.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="far fa-user"></i> Grupos de trabajo</a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="backend.php?tabla=workgroup&accion=crear">Añadir</a></li>
              <li><a class="dropdown-item" href="backend.php?tabla=workgroup&accion=listar">Listar </a></li>
              <li><a class="dropdown-item" href="backend.php?tabla=workgroup&accion=buscar">Buscar </a></li>
          </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="backend.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="far fa-user"></i> Roles</a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <!-- <li><a class="dropdown-item" href="backend.php?tabla=rol&accion=crear">Añadir</a></li> -->
              <li><a class="dropdown-item" href="backend.php?tabla=rol&accion=listar">Listar </a></li>
              <li><a class="dropdown-item" href="backend.php?tabla=rol&accion=buscar">Buscar </a></li>
          </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="backend.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="far fa-user"></i> Lecciones de los cursos</a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <!-- <li><a class="dropdown-item" href="backend.php?tabla=lesson&accion=crear">Añadir</a></li> -->
              <li><a class="dropdown-item" href="backend.php?tabla=lesson&accion=listar">Listar </a></li>
              <li><a class="dropdown-item" href="backend.php?tabla=lesson&accion=buscar">Buscar </a></li>
          </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="backend.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="far fa-user"></i> Alumnos y sus profesores</a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <!-- <li><a class="dropdown-item" href="backend.php?tabla=student_teacher&accion=crear">Añadir</a></li> -->
              <li><a class="dropdown-item" href="backend.php?tabla=student_teacher&accion=listar">Listar </a></li>
              <li><a class="dropdown-item" href="backend.php?tabla=student_teacher&accion=buscar">Buscar </a></li>
          </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="backend.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="far fa-user"></i> Alumnos y sus cursos comprados</a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <!-- <li><a class="dropdown-item" href="backend.php?tabla=student_course&accion=crear">Añadir</a></li> -->
              <li><a class="dropdown-item" href="backend.php?tabla=student_course&accion=listar">Listar </a></li>
              <li><a class="dropdown-item" href="backend.php?tabla=student_course&accion=buscar">Buscar </a></li>
          </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="backend.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="far fa-user"></i> Alumnos y sus grupos de trabajo</a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <!-- <li><a class="dropdown-item" href="backend.php?tabla=student_workgroup&accion=crear">Añadir</a></li> -->
              <li><a class="dropdown-item" href="backend.php?tabla=student_workgroup&accion=listar">Listar </a></li>
              <li><a class="dropdown-item" href="backend.php?tabla=student_workgroup&accion=buscar">Buscar </a></li>
          </ul>
          </li>
        </ul>
      </div>
    </nav>