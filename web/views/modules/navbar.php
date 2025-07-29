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


<div class="container py-lg-3">
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

    <!-- Menú Hamburguesa, Categorías y Buscador. Con bootstrap: dispositivo pequeño 12 columnas es y ocupa 100% de la pantalla,
    en dispositivo lg (large) ocupa 7 columnas de 12, en dispositivo xl (extra large) ocupa 8 columnas de 12,
    margin top 1, padding 3 a todo en disp. pequeños, padding 0 en dispositivos lg (large) -->
    <div class="col-12 col-lg-7 col-xl-8 mt-1 px-lg-0">
      <div class="d-flex justify-content-start">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        <div class="dropdown px-1" style="background: #47BAC1; color: white">
          <a id="dropdownSubMenu1" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-uppercase">
            <span class="d-lg-block d-none">Categorias<i class="ps-lg-2 fas fa-th-list"></i></span>
            <span class="d-lg-none d-block"><i class="fas fa-th-list"></i></span>

          </a>
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

        <!-- buscador -->
        <form class="form-inline w-100">
          <div class="input-group w-100 me-0 me-lg-0">
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
      <div class="my-2 my-lg-0 ms-lg-2 d-flex justify-content-end">
        <a href="#">
          <button class="bt btn-default rounded-0 border-0 py-2 px-3" style="background: #47BAC1; color: white">
            <i class="fa fa-shopping-cart"></i>
          </button>
        </a>
        <div class="small border ps-2 pe-2 w-100">
          TU CESTA <span>0</span> <br> <span>0</span> €
        </div>
      </div>
    </div>

  </div>
</div>

