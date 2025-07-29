  <link rel="stylesheet" href="<?php echo $path ?>views/assets/css/slide/slide.css">

<!-- https://www.jqueryscript.net/slider/Carousel-Slideshow-jdSlider.html -->
<div class="jd-slider">
    <div class="slide-inner">
        <ul class="slide-area">
            <li>
                <img src="<?php echo $path ?>\views\assets\img\slide\1\back_default.jpg" class="img-fluid">
                <!-- clase para superponer a la derecha, la segunda imagen sobre el fondo -->
                <div class="slideOpt opt1">
                    <img src="<?php echo $path ?>\views\assets\img\slide\1\calzado.png" style="top:15%; right:10%; width:45%">
                    <!-- clase para superponer a la izquierda, el texto sobre el fondo -->
                    <div class="slideText" style="top:20%; left:10%; width:40%">
                        <h2 class="text-uppercase" style="color:#333">Zapatillas</h2>
                        <h3 class="" style="color:#777">Zapatillas</h3>
                        <h4 class="" style="color:#888">Zapatillas</h4>
                        <a href="#">
                            <button class="my-lg-3 btn text-uppercase templateColor border-0">Ver producto</button>
                        </a>
                    </div>
                </div>
            </li>
            <li>
                <img src="<?php echo $path ?>\views\assets\img\slide\2\fondo2.jpg" class="img-fluid">
                <!-- clase para superponer a la izquierda, la segunda imagen sobre el fondo -->
                <div class="slideOpt opt2">
                    <img src="<?php echo $path ?>\views\assets\img\slide\2\iphone.png" style="bottom:0%; left:15%; width:28%">
                    <!-- clase para superponer a la derecha, el texto sobre el fondo -->
                    <div class="slideText" style="top:20%; right:15%; width:40%">
                        <h2 class="text-uppercase" style="color:#fff">Telefonía Móvil</h2>
                        <h3 class="" style="color:#fff">Telefonía</h3>
                        <h4 class="" style="color:#fff">Comunicaciones</h4>
                        <a href="#">
                            <button class="my-lg-3 btn text-uppercase templateColor border-0">Ver producto</button>
                        </a>
                    </div>
                </div>
            </li>
            <li>
                <img src="<?php echo $path ?>\views\assets\img\slide\3\fondo3.jpg" class="img-fluid">
            </li>
        </ul>
    </div>
    <a class="prev" href="#">
        <i class="fas fa-angle-left text-white px-3 py-4 rounded-right" style="background: rgba(0,0,0,.5);"></i>
    </a>
    <a class="next" href="#">
        <i class="fas fa-angle-right text-white px-3 py-4 rounded-left" style="background: rgba(0,0,0,.5);"></i>
    </a>
    <div class="controller">
        <div class="indicate-area"></div>
    </div>
</div>

<script src="<?php echo $path ?>views/assets/js/slide/slide.js"></script>
