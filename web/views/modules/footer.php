<style>
  a:link, a:visited, a:hover, a:active{
    text-decoration: none !important; 
    color: inherit !important;
  }
</style>


<div class="container-fluid bg-dark small">
  <div class="container py-5 text-light">
    <!-- fila 1 col disp pequeño , 2 cols disp mediano (md) , 3 cols disp grande (large) -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">

      <div class="col row">
        <div class="col-12 col-sm-4 col-md-3 col-lg-4">
          <h4 class="lead">
            <a href="#" class="text-uppercase text-md">Ropa</a>
          </h4>
          <hr class="border-white">
          <ul>
            <li>
              <a href="#">Ropa para mujer</a>
            </li>
            <li>
              <a href="#">Ropa para hombre</a>
            </li>
            <li>
              <a href="#">Ropa deportiva</a>
            </li>
            <li>
              <a href="#">Ropa infantil</a>
            </li>
          </ul>
        </div>

        <div class="col-12 col-sm-4 col-md-3 col-lg-4">
          <h4 class="lead">
            <a href="#" class="text-uppercase text-md">Calzado</a>
          </h4>
          <hr class="border-white">
          <ul>
            <li>
              <a href="#">Calzado para mujer</a>
            </li>
            <li>
              <a href="#">Calzado para hombre</a>
            </li>
            <li>
              <a href="#">Calzado deportivo</a>
            </li>
            <li>
              <a href="#">Calzado infantil</a>
            </li>
          </ul>
        </div>

        <div class="col-12 col-sm-4 col-md-3 col-lg-4">
          <h4 class="lead">
            <a href="#" class="text-uppercase text-md">Tecnología</a>
          </h4>
          <hr class="border-white">
          <ul>
            <li>
              <a href="#">Telefonía Móvil</a>
            </li>
            <li>
              <a href="#">Tabletas</a>
            </li>
            <li>
              <a href="#">Ordenadores</a>
            </li>
            <li>
              <a href="#">Auriculares</a>
            </li>
          </ul>
        </div>

        <div class="col-12 col-sm-4 col-md-3 col-lg-4">
          <h4 class="lead">
            <a href="#" class="text-uppercase text-md">Cursos</a>
          </h4>
          <hr class="border-white">
          <ul>
            <li>
              <a href="#">Desarrollo Web</a>
            </li>
            <li>
              <a href="#">Aplicaciones Móviles</a>
            </li>
            <li>
              <a href="#">Diseño Gráfico</a>
            </li>
            <li>
              <a href="#">Marketing Digital</a>
            </li>
          </ul>
        </div>
      </div>

      <div class="col my-3 my-lg-0 px-0 px-lg-5 text-light">
        <h2 class="lead ">Contáctanos en:</h2>
        <br>
        <h2 class="lead text-md">
          <i class="fa fa-phone-square pe-2"></i> 123 123 123
          <br>
          <i class="fa fa-envelope pe-2 mt-1"></i> soporte@soporte.com
          <br>
          <i class="fa fa-map-marker pe-2 mt-1"></i> Dirección - 12550 Almassora
          <br><span class="ps-4">Castelló</span>
        </h2>
        <iframe class="mt-3" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d28068.997634190917!2d-0.0653353!3d39.950407899999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1ses!2ses!4v1753786699246!5m2!1ses!2ses" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>

      <div class="col my-3 my-lg-0 px-0 text-md">
        <h2 class="lead mb-4">Consulta tu dudas:</h2>
        <form role=form method=post>
          <input type=text id=nombreContactenos name=nombreContactenos class=form-control placeholder="Escriba su nombre" required>
          <br>
          <input type=email id=emailContactenos name=emailContactenos class=" form-control" placeholder="Escriba su correo electrónico" required>
          <br>
          <textarea id=mensajeContactenos name=mensajeContactenos class=form-control placeholder="Escriba su mensaje" rows=5 required></textarea>
          <br>
          <input type=submit value=Enviar class="btn btn-default float-end border-0" style="background: #47BAC1; color: white">
        </form>
      </div>

    </div>
  </div>
</div>

<!-- Main Footer -->
<footer class="main-footer" style="background: black; color: white">
  <div class="container">
    <!-- To the right -->
    <div class="float-end mb-1">
      <div class="d-flex justify-content-center" style="line-height:0px">
            <div class="p-2">
                <a href="https://facebook.com" target="_blank" class="text-white">
                    <i class="fab fa-facebook-f"></i>
                </a>
            </div>
            <div class="p-2">
                <a href="https://youtube.com" target="_blank" class="text-white">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
            <div class="p-2">
                <a href="https://twitter.com" target="_blank" class="text-white">
                    <i class="fab fa-twitter"></i>
                </a>
            </div>
            <div class="p-2">
                <a href="https://instagram.com" target="_blank" class="text-white">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- Default to the left -->
    <strong>&copy; Copyright <?php echo date("Y"); ?><a href="#">#</a>.</strong> Todos los derechos reservados. 
  </div>
</footer>