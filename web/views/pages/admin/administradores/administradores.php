<div class="content-wrapper" style="min-height: 1504.06px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="m-0"> <small>Administradores</small></h2>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Tablero</a></li>
              <li class="breadcrumb-item active">Administradores</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
  
    <!-- /.content -->
    <?php

      //valida si no viene vacio el indice [2] de la ruta (url de la página a partir del dominio)
      if (!empty($routesArray[2])){

        //valida si el valor del indice [2] de la ruta es = a gestión
        if($routesArray[2] == "gestion"){

          //insertar gestion.php en el tablero o dashboard
          include "modules/".$routesArray[2].".php";

        //si es diferente de "gestion", la página no existe
        } else {

          //mostrar a la página error 404, pagina no existe
          echo '<script>
            window.location = "'.$path.'404";
          </script>';
        }
        
      //si el indice [2] de la ruta, viene vacio
      } else {
        
        //insertar el listado de administradores en el tablero o dashboard
        include "modules/listado.php";
      }

    ?>

    <!-- /.content -->
</div>