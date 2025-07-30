<!-- styles en linea, para poder modificarlos, de forma dinámica, desde el panel de control con info de la DB -->
<div class="container-fluid banner p-0" 
    style="position:relative; background:url('<?php echo $path ?>views/assets/img/banner/1/default.jpg'); background-size:cover; background-position:center; background-repeat:no-repeat;">

    <div class="container-fluid" style="background-color: rgba(0,0,0,.5);">

        <div class="container text-right p-5">
            <h2 class="text-uppercase" style="color:#fff; text-shadow: 2px 2px 5px #000">Ofertas especiales</h2>
            <h3 style="color:#fff; text-shadow: 2px 2px 5px #000">Hasta el 50%</h3>
            <h4 style="color:#fff; text-shadow: 2px 2px 5px #000">Aprovéchalas ahora.</h4>
        </div>

    </div>

</div>

<!-- efecto paralax de la imagen de fondo cuando scroll -->
<!-- modifica el css de la clase .banner, con js -->
 <script>
    $(".banner").css({'background-attachment':'fixed'});
 </script>