<div class="container-fluid bg-light border">
    <!-- clearfix para poder poner el div hijo como float-end -->
    <div class="container clearfix">
        <!-- btn-group agrupa los botones para posicionarlos con float-end -->
         <div class="btn-group float-end p-2">
           <button class="btn btn-default btnView bg-white" attr-type="grid" attr-index="2">
                <i class="fas fa-th fa-xs pe-1"></i>
                <span class="float-end small mt-1">CUADRÍCULA</span>
            </button>
            <button class="btn btn-default btnView" attr-type="list" attr-index="2">
                <i class="fas fa-list fa-xs pe-1"></i>
                <span class="float-end small mt-1">LISTA</span>
            </button>
         </div>
    </div>

    <div class="container-fluid bg-white">
        
        <div class="container">
            <div class="clearfix pt-3 pb-0 px-2">
                <h4 class="float-start text-uppercase pt-2">Artículos más vistos</h4>
                <span class="float-end">
                    <a href="#" class="btn btn-default templateColor">
                        <small>VER MÁS <i class="fas fa-chevron-right"></i></small>
                    </a>
                </span>
            </div>

            <hr style="color:#666">

            <!-- GRID -->
            <!-- fila con 1 col disp móvil, 2 cols disp small, 4 cols disp medianos y superior  -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 pt-3 pb-4 grid-2">
                
                <!-- primera columna lg -->
                <div class="col px-3 py-2 py-lg-0">
                    <a href="#">
                        <figure class="imgProduct">
                            <img src="<?php echo $path; ?>views/assets/img/products/ropa/1/ropa01.jpg" class="img-fluid">
                        </figure>
                        <h5><small class="text-uppercase text-muted">Falda flores</small></h5>
                    </a>
                    <h6>
                        <span class="badge badgeNew bg-warning text-uppercase text-white mt-1 p-2">Nuevo</span>
                    </h6>
                    <div class="clearfix">
                        <h5 class="float-start text-uppercase text-muted">
                            <del class="small" style="color:#bbb">29€</del> 11€
                        </h5>
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
                            <img src="<?php echo $path; ?>views/assets/img/products/ropa/2/ropa02.jpg" class="img-fluid">
                        </figure>
                        <h5><small class="text-uppercase text-muted">Vestido jean</small></h5>
                    </a>
                    <h6>
                        <span class="badge badgeNew bg-warning text-uppercase text-white mt-1 p-2">Nuevo</span>
                    </h6>
                    <div class="clearfix">
                        <h5 class="float-start text-uppercase text-muted">
                            <del class="small" style="color:#bbb">29€</del> 11€
                        </h5>
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
                            <img src="<?php echo $path; ?>views/assets/img/products/cursos/1/curso01.jpg" class="img-fluid">
                        </figure>
                        <h5><small class="text-uppercase text-muted">Curso PHP</small></h5>
                    </a>
                    <h6>
                        <span class="badge badgeNew bg-warning text-uppercase text-white mt-1 p-2">Nuevo</span>
                    </h6>
                    <div class="clearfix">
                        <h5 class="float-start text-uppercase text-muted">
                            <del class="small" style="color:#bbb">29€</del> 11€
                        </h5>
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
                            <img src="<?php echo $path; ?>views/assets/img/products/ropa/4/ropa04.jpg" class="img-fluid">
                        </figure>
                        <h5><small class="text-uppercase text-muted">Sombrero clásico</small></h5>
                    </a>
                    <h6>
                        <span class="badge badgeNew bg-warning text-uppercase text-white mt-1 p-2">Nuevo</span>
                    </h6>
                    <div class="clearfix">
                        <h5 class="float-start text-uppercase text-muted">
                            <del class="small" style="color:#bbb">29€</del> 11€
                        </h5>
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

            <!-- LISTA -->
            <!-- Comienza oculta hasta que se pulse el botón LISTA -->
            <div class="row list-2" style="display:none">

                <!-- la class media de btstrp permite el contenido del div en una linea, de izq a derecha -->
                <div class="media border-bottom px-3 pt-4 pb-3 pb-lg-2">
                    <figure class="imgProduct">
                        <img src="<?php echo $path; ?>views/assets/img/products/ropa/1/ropa01.jpg" class="img-fluid" style="width:150px">
                    </figure>
                    <!-- class media-body de btstrp, iguala la altura del elemento anterior (<figure>), con este div -->
                    <div class="media-body ps-3">
                        <h5><small class="text-uppercase text-muted">Falda flores</small></h5>
                        <span class="badge badgeNew bg-warning text-uppercase text-white p-2">Nuevo</span>
                        <p class="my-2">Descripción del producto. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Assumenda pariatur perspiciatis beatae laudantium velit reiciendis nobis, sit amet nesciunt!.
                        </p>
                        <div class="clearfix">
                            <h5 class="float-start text-uppercase text-muted">
                                <del class="small" style="color:#bbb">29€</del> 11€
                            </h5>
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

                <!-- la class media de btstrp permite el contenido del div en una linea, de izq a derecha -->
                <div class="media border-bottom px-3 pt-4 pb-3 pb-lg-2">
                    <figure class="imgProduct">
                        <img src="<?php echo $path; ?>views/assets/img/products/ropa/2/ropa02.jpg" class="img-fluid" style="width:150px">
                    </figure>
                    <!-- class media-body de btstrp, iguala la altura del elemento anterior (<figure>), con este div -->
                    <div class="media-body ps-3">
                        <h5><small class="text-uppercase text-muted">Vestido jean</small></h5>
                        <span class="badge badgeNew bg-warning text-uppercase text-white p-2">Nuevo</span>
                        <p class="my-2">Descripción del producto. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Assumenda pariatur perspiciatis beatae laudantium velit reiciendis nobis, sit amet nesciunt!.
                        </p>
                        <div class="clearfix">
                            <h5 class="float-start text-uppercase text-muted">
                                <del class="small" style="color:#bbb">29€</del> 11€
                            </h5>
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

                <!-- la class media de btstrp permite el contenido del div en una linea, de izq a derecha -->
                <div class="media border-bottom px-3 pt-4 pb-3 pb-lg-2">
                    <figure class="imgProduct">
                        <img src="<?php echo $path; ?>views/assets/img/products/cursos/1/curso01.jpg" class="img-fluid" style="width:150px">
                    </figure>
                    <!-- class media-body de btstrp, iguala la altura del elemento anterior (<figure>), con este div -->
                    <div class="media-body ps-3">
                        <h5><small class="text-uppercase text-muted">Curso PHP</small></h5>
                        <span class="badge badgeNew bg-warning text-uppercase text-white p-2">Nuevo</span>
                        <p class="my-2">Descripción del producto. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Assumenda pariatur perspiciatis beatae laudantium velit reiciendis nobis, sit amet nesciunt!.
                        </p>
                        <div class="clearfix">
                            <h5 class="float-start text-uppercase text-muted">
                                <del class="small" style="color:#bbb">29€</del> 11€
                            </h5>
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

                <!-- la class media de btstrp permite el contenido del div en una linea, de izq a derecha -->
                <div class="media border-bottom px-3 pt-4 pb-3 pb-lg-2">
                    <figure class="imgProduct">
                        <img src="<?php echo $path; ?>views/assets/img/products/ropa/4/ropa04.jpg" class="img-fluid" style="width:150px">
                    </figure>
                    <!-- class media-body de btstrp, iguala la altura del elemento anterior (<figure>), con este div -->
                    <div class="media-body ps-3">
                        <h5><small class="text-uppercase text-muted">Sombrero clásico</small></h5>
                        <span class="badge badgeNew bg-warning text-uppercase text-white p-2">Nuevo</span>
                        <p class="my-2">Descripción del producto. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Assumenda pariatur perspiciatis beatae laudantium velit reiciendis nobis, sit amet nesciunt!.
                        </p>
                        <div class="clearfix">
                            <h5 class="float-start text-uppercase text-muted">
                                <del class="small" style="color:#bbb">29€</del> 11€
                            </h5>
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
</div>