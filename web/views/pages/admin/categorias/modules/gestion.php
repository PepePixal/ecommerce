<div class="content mb-5">
    <div class="container">
        <div class="card">
            <!-- needs-validate validación con js / novalidate desactiva la validacion html -->
            <form method="post" class="needs-validation" novalidate>

                <!-- valida si la var $admin NO está vacia - EDITANDO  -->
                <?php if (!empty($admin)): ?>

                    <!-- para capturar el valor de id_admin y de la password , genera inputs hidden -->
                    <input type="hidden" name=idAdmin value="<?php echo base64_encode($admin->id_admin); ?>">
                    <input type="hidden" name=oldPassword value="<?php echo $admin->password_admin; ?>">

                <?php endif ?>

                <div class="card-header">
                    <div class="container">
                        <div class="row">

                            <div class="col-12 col-lg-6 text-center text-lg-left">
                                <!-- comprobar si está EDITANDO -->
                                <?php if (!empty($admin)): ?>
                                    <h4 class="mt-3">Editando Categoría</h4>
                                <?php else: ?>
                                    <h4 class="mt-3">Añadir Categoría</h4>
                                <?php endif ?>
                            </div>

                            <div class="col-12 col-lg-6 mt-2 d-flex justify-content-center justify-content-lg-end align align-items-center">
                                <button type="submit" class="btn border-0 templateColor py-2 px-3 mr-3 btn-sm rounded-pill">Guardar Información</button>
                                <a href="/admin/categorias" class="btn btn-default py-2 px-3 btn-sm rounded-pill">Vovler</a>
                            </div>

                        </div>
                    </div>
                </div><!--Fin Card Head -->

                <div class="card-body">

                    <!-- Instancia el controller, class y método que gestiona el Alta de Categorias en la BD.
                     Se instancia aquí para posicionar los mensajes tanto de error como de éxito, en esta parte del form -->
                    <?php
                        require_once "controllers/categories.controller.php";
                        $manage = new CategoriesController();
                        $manage -> categoryManage();
                    ?>

                    <!--======================================
                        PRIMER BLOQUE FORMULARIO
                    ========================================-->
                    <div class="row row-cols-1">

                        <div class="col">
                            <div class="card">
                                <div class="card-body">

                                    <!--======================================
                                      Nombre Categoría
                                    ========================================-->
                                    <div class="form-group pb-3">
                                        <label for="name_category">Nobre Cat. <sup class="text-danger font-weight-bold">*</sup></label>
                                        <!-- el evento onchange llama a la función enviando el valor del elemento (input) que dispara el evento y
                                          el tipo de tabla sobre la que buscar si el elemento ya existe -->
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Nombre de la Categoría"
                                            id="name_category"
                                            name="name_category"
                                            onchange="validateDataRepeat(event, 'category')"
                                            required
                                        >
                                        
                                        <div class="valid-feedback">Completado</div>
                                        <div class="invalid-feedback">Campo obligatorio</div>
                                    </div>

                                    <!--================================================
                                      URL Categoría - se genera automat según el nombre
                                    ==================================================-->
                                    <div class="form-group pb-3">
                                        <label for="url_category">URL <sup class="text-danger font-weight-bold">*</sup></label>
                                        <!-- readonly convierte el input a solo lectura. La url se genera auto según el Nombre -->
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="url_category"
                                            name="url_category"
                                            readonly
                                            required
                                        >
                                        
                                        <div class="valid-feedback">Completado</div>
                                        <div class="invalid-feedback">Campo obligatorio</div>
                                    </div>

                                    <!--================================================
                                      Icono Categoría
                                    ==================================================-->
                                    <div class="form-group pb-3">
                                        <label for="icon_category">Icono <sup class="text-danger font-weight-bold">*</sup></label>
                                        <!-- el atributo de evento onfocus, llama la función js addIcon() enviando el parámetro event,
                                         que es un objeto que contiene toda la información sobre el evento, en este caso el onfocus -->
                                        
                                        <div class="input-group">
                                            <!-- class iconView, para el cambio de icono desde la ventana modal -->
                                            <span class="input-group-text iconView">
                                                <i class="fas fa-shopping-bag"></i>
                                            </span>
                                            
                                            <input
                                            type="text"
                                            class="form-control"
                                            id="icon_category"
                                            name="icon_category"
                                            onfocus="addIcon(event)"
                                            value="fas fa-shopping-bag"
                                            required
                                            >                 
                                        </div>

                                        <div class="valid-feedback">Completado</div>
                                        <div class="invalid-feedback">Campo obligatorio</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!--Fin Primer bloque -->

                    <!--======================================
                        SEGUNDO BLOQUE FORMULARIO
                    ========================================-->
                    <div class="row row-cols-1 row-cols-md-2 pt-2">

                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <!--======================================
                                      Nombre Categoría
                                    ========================================-->
                                    <div class="form-group pb-3">
                                        <label for="description_category">Descripción <sup class="text-danger font-weight-bold">*</sup></label>
                                        <textarea
                                        rows="9"
                                        class="form-control mb-3"
                                        placeholder="Escribe la descripción"
                                        id="description_category"
                                        name="description_category"
                                        onchange="validateJS(event, 'complete')"
                                        required
                                        ></textarea>

                                        <div class="valid-feedback">Completado</div>
                                        <div class="invalid-feedback">Campo obligatorio</div>
                                    </div>

                                    <!--======================================
                                      Palabras Claves de la categoría
                                    ========================================-->
                                    <div class="form-group pb-3">
                                        <label for="keywords_category">Palabras Clave <sup class="text-danger font-weight-bold">*</sup></label>
                                        <!-- class tags-input y data-role="tagsinput", para poder agregar tags (etiquetas) al input. 
                                         Según la documentación del plugin Tags Input -->
                                        <input
                                            type="text"
                                            class="form-control tags-input"
                                            data-role="tagsinput"
                                            placeholder="Palabra clave + Intro. Max. 5"
                                            id="keywords_category"
                                            name="keywords_category"
                                            onchange="validateJS(event, 'complete')"
                                            required
                                        >
                                        
                                        <div class="valid-feedback">Completado</div>
                                        <div class="invalid-feedback">Campo obligatorio</div>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <!--======================================
                                      Imagen de la Categoría
                                    ========================================-->
                                    <div class="form-group pb-3 text-center">
                                        <label class="float-left">Imagen <sup class="text-danger font-weight-bold">*</sup></label>
                                        <label for="image_category">
                                            <!-- la class changeImage es para la validación y cambio de url de img con el método validateImageJS() -->
                                            <img src="/views/assets/img/categories/default/default-image.jpg" class="img-fluid changeImage">
                                            <p class="help-block small mt-3">Tamaño recomendado 1000 x 600 px | Peso Max. 2MB | Formato: PNG o JPG</p>
                                        </label>
                                        <div class="custom-file">
                                            <input
                                            type="file"
                                            class="custom-file-input"
                                            id="image_category"
                                            name="image_category"
                                            accept="image/*"
                                            maxSize="2000000"
                                            onchange="validateImageJS(event, 'changeImage')"
                                            requirede
                                            >

                                            <div class="valid-feedback">Completado</div>
                                            <div class="invalid-feedback">Campo obligatorio</div>

                                            <label for="image_category" class="custom-file-label" >Buscar Archivo</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!--Fin Segundo bloque -->

                </div><!--Fin Card body -->
                
                <div class="card-footer">
                    <div class="container">
                        <div class="row">

                            <div class="col-12 col-lg-6 text-center text-lg-left">
                                <h6 class="mt-3"><sup class="text-danger font-weight-bold">*</sup> Campos obligatorios</h6>
                            </div>

                            <div class="col-12 col-lg-6 mt-2 d-flex justify-content-center justify-content-lg-end align align-items-center">
                                <button type="submit" class="btn border-0 templateColor py-2 px-3 mr-3 btn-sm rounded-pill">Guardar Información</button>
                                <a href="/admin/categorias" class="btn btn-default py-2 px-3 btn-sm rounded-pill">Vovler</a>
                            </div>

                        </div>
                    </div>
                </div><!--Fin Card body -->

            </form>
        </div>
    </div>
</div>


<!--===================================================================
  Ventana Modal de Bootstrap, con la libreria de iconos de fontawesome
=====================================================================-->
<!-- la ventana modal permanece oculta hasta que se dispara o invoca desde js con $("#myIcon").show(); -->
<div class="modal" id="myIcon">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            
            <div class="modal-header">
                <h4 class="modal-title">Cambiar Icono</h4>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body mx-3">

                <!-- buscador de iconos -->
                <input type="text" class="form-control mt-4 mb-3 myInputIcon" placeholder="Buscar Icono"></input>

                <?php
                    //obtener los nombres de clase de los iconos, que estan en el archivo json/fontawesome.json, en formato json
                    $data = file_get_contents($path."/views/assets/json/fontawesome.json");
                    //decodifica el json a array index y lo asigna a $icons
                    $icons = json_decode($data);
                ?>

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 py-3" style="overflow-y: scroll; overflow-x: hidden; height:500px">
                    <!-- para obtener un listado de los iconos,
                    itera el arreglo index con los nombres de clases de los iconos y por cada nombre -->
                    <?php foreach ($icons as $key => $value): ?>
                        <!-- class btnChangeIcon para el buscador js -->
                        <!-- atributo mode, con el mismo valor que el icono (nombre el icono), para el buscador js  -->
                        <div class="col text-center py-4 btn btnChangeIcon" mode="<?php echo $value ?>">
                            <!-- en cada itereción el valor de la clase es el nombre de cada icono (fontawesome),
                             y fa-2x para aumentar su tamaño original -->
                            <i class="<?php echo $value ?> fa-2x"></i>
                        </div>
                    <?php endforeach ?>
                </div>
            
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white btn-sm" data-bs-dismiss="modal">Salir</button>
            </div>
        
        </div>
    </div>
</div><!--Fin Modal -->