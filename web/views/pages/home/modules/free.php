<div class="container-fluid bg-light border">
    <!-- clearfix para poder poner el div hijo como float-end -->
    <div class="container clearfix">
        <!-- btn-group agrupa los botones para posicionarlos con float-end -->
         <div class="btn-group float-end p-2">
            <button class="btn btn-default">
                <i class="fas fa-th fa-xs pe-1"></i>
                <span class="float-end small mt-1">CUADRÍCULA</span>
            </button>
            <button class="btn btn-default">
                <i class="fas fa-list fa-xs pe-1"></i>
                <span class="float-end small mt-1">LISTA</span>
            </button>
         </div>
    </div>

    <div class="container-fluid bg-white">
        
        <div class="container">
            <div class="clearfix pt-3 pb-0 px-2">
                <h3 class="float-start text-uppercase">Artículos gratuitos</h3>
                <span class="float-end">
                    <a href="#" class="btn btn-default templateColor">
                        <small>VER MÁS <i class="fas fa-chevron-right"></i></small>
                    </a>
                </span>
            </div>

            <hr style="color:#666">

            <!-- GRID -->
            <!-- fila con 1 col disp móvil, 2 cols disp small, 4 cols disp medianos y superior  -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 pt-3 pb-4">
                
                <!-- primera columna lg -->
                <div class="col px-3 py-2 py-lg-0">
                    <a href="#">
                        <figure class="imgProduct">
                            <img src="<?php echo $path; ?>views/assets/img/products/accesorios/1/accesorio01.jpg" class="img-fluid">
                        </figure>
                        <h5><small class="text-uppercase text-muted">Collar de diamantes</small></h5>
                    </a>
                    <h6>
                        <span class="badge badgeNew bg-warning text-uppercase text-white mt-1 p-2">Nuevo</span>
                    </h6>
                    <div class="clearfix">
                        <h5 class="float-start text-uppercase text-muted"><small>Gratis</small></h5>
                        <div class="float-end">
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-light border">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <button type="button" class="btn btn-light border">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- segunda columna lg -->
                <div class="col px-3 py-2 py-lg-0">
                    <a href="#">
                        <figure class="imgProduct">
                            <img src="<?php echo $path; ?>views/assets/img/products/accesorios/2/accesorio02.jpg" class="img-fluid">
                        </figure>
                        <h5><small class="text-uppercase text-muted">Mochila deportiva</small></h5>
                    </a>
                    <h6>
                        <span class="badge badgeNew bg-warning text-uppercase text-white mt-1 p-2">Nuevo</span>
                    </h6>
                    <div class="clearfix">
                        <h5 class="float-start text-uppercase text-muted"><small>Gratis</small></h5>
                        <div class="float-end">
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-light border">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <button type="button" class="btn btn-light border">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- tercera columna lg -->
                <div class="col px-3 py-2 py-lg-0">
                    <a href="#">
                        <figure class="imgProduct">
                            <img src="<?php echo $path; ?>views/assets/img/products/accesorios/3/accesorio03.jpg" class="img-fluid">
                        </figure>
                        <h5><small class="text-uppercase text-muted">Mochila montaña</small></h5>
                    </a>
                    <h6>
                        <span class="badge badgeNew bg-warning text-uppercase text-white mt-1 p-2">Nuevo</span>
                    </h6>
                    <div class="clearfix">
                        <h5 class="float-start text-uppercase text-muted"><small>Gratis</small></h5>
                        <div class="float-end">
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-light border">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <button type="button" class="btn btn-light border">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- tercera columna lg -->
                <div class="col px-3 py-2 py-lg-0">
                    <a href="#">
                        <figure class="imgProduct">
                            <img src="<?php echo $path; ?>views/assets/img/products/accesorios/4/accesorio04.jpg" class="img-fluid">
                        </figure>
                        <h5><small class="text-uppercase text-muted">Pulsera dorada</small></h5>
                    </a>
                    <h6>
                        <span class="badge badgeNew bg-warning text-uppercase text-white mt-1 p-2">Nuevo</span>
                    </h6>
                    <div class="clearfix">
                        <h5 class="float-start text-uppercase text-muted"><small>Gratis</small></h5>
                        <div class="float-end">
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-light border">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <button type="button" class="btn btn-light border">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>