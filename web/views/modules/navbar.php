<style>
  /* quita los triangulitos de los menus y submenus */
  .dropdown-toggle::after {
    display: none !important;
  }

  ul{
    padding: 0;
    list-style: none;
    text-decoration: none;
  }
</style>


<div class="container">
  <div class="row">

    <!-- Logo. Con bootstrap: dispositivo pequeño 12 columnas es y ocupa 100% de la pantalla,
    en dispositivo lg (large) ocupa 2 columnas de 12, margin top 1 -->
    <div class="col-12 col-lg-2 mt-1">
      <div class="d-flex justify-content-center">
        <a href="../../index3.html" class="navbar-brand">
          <img src="<?php echo $path ?>views/assets/img/template/logo.png" alt="logo" class="brand-image img-fluid py-3 px-5 p-lg-0 pe-lg-3">
        </a>
      </div>
    </div>

    <!-- Menú Hamburguesa y Buscador. Con bootstrap: dispositivo pequeño 12 columnas es y ocupa 100% de la pantalla,
    en dispositivo lg (large) ocupa 7 columnas de 12, en dispositivo xl (extra large) ocupa 8 columnas de 12,
    margin top 1, padding 3 a todo en disp. pequeños, padding 0 en dispositivos lg (large) -->
    <div class="col-12 col-lg-7 col-xl-8 mt-1 px-3 px-lg-0">

      <div class="d-flex justify-content-start">

        <a class="nav-link float-start" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>

        <div class="dropdown px-1 float-star" style="background: #47BAC1; color: white">

          <a id="dropdownSubMenu1" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-uppercase">Categorias <i class="ps-2 fas fa-th-list"></i></a>

          <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <!-- Level two dropdown-->
            <li class="dropdown-submenu dropdown-hover">
              <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle text-uppercase">
                <i class="fas fa-tshirt pe-2 fa-xs"></i>  Ropa
              </a>
              <!-- vista solo dispositivo pequeño no en dispositivos grandes lg-->
              <ul class="border-0 shadow py-3 ps-3 d-block d-lg-none">
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Ropa para mujer</a>
                </li>
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Ropa para hombre</a>
                </li>
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Ropa deportiva</a>
                </li>
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Ropa infantil</a>
                </li>
              </ul>
              <!-- vista solo dispositivo grande lg (large) -->
              <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Ropa para mujer</a>
                </li>
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Ropa para hombre</a>
                </li>
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Ropa deportiva</a>
                </li>
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Ropa infantil</a>
                </li>
              </ul>
            </li>

            <li class="dropdown-submenu dropdown-hover">
              <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle text-uppercase">
                <i class="fas fa-shoe-prints pe-2 fa-xs"></i>  Calzado
              </a>
              <!-- vista solo dispositivo pequeño no en dispositivos grandes lg-->
              <ul class="border-0 shadow py-3 ps-3 d-block d-lg-none">
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Calzado para mujer</a>
                </li>
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Calzado para hombre</a>
                </li>
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Calzado deportivo</a>
                </li>
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Calzado infantil</a>
                </li>
              </ul>
              <!-- vista solo dispositivo grande lg (large) -->
              <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Calzado para mujer</a>
                </li>
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Calzado para hombre</a>
                </li>
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Calzado deportivo</a>
                </li>
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Calzado infantil</a>
                </li>
              </ul>
            </li>

            <li class="dropdown-submenu dropdown-hover">
              <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle text-uppercase">
                <i class="fas fa-laptop pe-2 fa-xs"></i>  Tecnología
              </a>
              <!-- vista solo dispositivo pequeño no en dispositivos grandes lg-->
              <ul class="border-0 shadow py-3 ps-3 d-block d-lg-none">
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Telefonía Móvil</a>
                </li>
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Tablets</a>
                </li>
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Ordenadores</a>
                </li>
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Auriculares</a>
                </li>
              </ul>
              <!-- vista solo dispositivo grande lg (large) -->
              <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Telefonía Móvil</a>
                </li>
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Tablets</a>
                </li>
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Ordenadores</a>
                </li>
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Auriculares</a>
                </li>
              </ul>
            </li>

            <li class="dropdown-submenu dropdown-hover">
              <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle text-uppercase">
                <i class="fas fa-graduation-cap pe-2 fa-xs"></i>  Cursos
              </a>
              <!-- vista solo dispositivo pequeño no en dispositivos grandes lg-->
              <ul class="border-0 shadow py-3 ps-3 d-block d-lg-none">
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Desarrollo Web</a>
                </li>
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Aplicaciones Móviles</a>
                </li>
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Diseño Gráfico</a>
                </li>
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Marketing Digital</a>
                </li>
              </ul>
              <!-- vista solo dispositivo grande lg (large) -->
              <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Desarrollo Web</a>
                </li>
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Aplicaciones Móviles</a>
                </li>
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Diseño Gráfico</a>
                </li>
                <li>
                  <a tabindex="-1" href="#" class="dropdown-item">Marketing Digital</a>
                </li>
              </ul>
            </li>
            <!-- End Level two -->
          </ul>

        </div>

        <form class="form-inline w-100">
          <div class="input-group w-100 me-0 me-lg-4">
            <input class="form-control rounded-0 p-3 pe-5" type="search" placeholder="Buscar..." style="height: 40px;">
            <div class="input-group-append px-2" style="background: #47BAC1; color: white">
              <button class="btn btn-navbar text-white" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>

      </div>

    </div>

    <!-- Carrito. Con bootstrap: dispositivo pequeño 12 columnas es y ocupa 100% de la pantalla,
    en dispositivo lg (large) ocupa 3 columnas de 12, en dispositivo xl (extra large) ocupa 2 columnas de 12,
    margin top 1, padding 3 a todo en disp. pequeños, padding 0 en dispositivos lg (large) -->
    <div class="col-12 col-lg-3 col-xl-2 mt-1 px-3 px-lg-0">

    </div>




    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
        </li>
        <li class="nav-item">
          <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">Contact</a>
        </li>

      </ul>

      <!-- SEARCH FORM -->

    </div>

    <!-- Right navbar links -->
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="<?php echo $path ?>views/assets/img/adminlte/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="<?php echo $path ?>views/assets/img/adminlte/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="<?php echo $path ?>views/assets/img/adminlte/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </div>
</div>

