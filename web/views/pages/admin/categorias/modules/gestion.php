<div class="content">
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
                </div>

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
                                        <!-- onchange llama a la función enviando el valor del elemento (input) que dispara el evento y
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
                                        <!-- readonly convierte el input a solo lectura. La url se genera auto según el Nombre -->
                                        
                                        <div class="input-group">

                                            <span class="input-group-text">
                                                <i class="fas fa-shopping-bag"></i>
                                            </span>
                                            
                                            <input
                                            type="text"
                                            class="form-control"
                                            id="icon_category"
                                            name="icon_category"
                                            required
                                            >
                                            
                                        </div>

                                        <div class="valid-feedback">Completado</div>
                                        <div class="invalid-feedback">Campo obligatorio</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

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
                                        required
                                        ></textarea>

                                        <div class="valid-feedback">Completado</div>
                                        <div class="invalid-feedback">Campo obligatorio</div>
                                    </div>

                                    <!--======================================
                                      Palabras Claves
                                    ========================================-->
                                    <div class="form-group pb-3">
                                        <label for="keywords_category">Palabras Clave <sup class="text-danger font-weight-bold">*</sup></label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Escribe las palabras clave"
                                            id="keywords_category"
                                            name="keywords_category"
                                            onchange="validateJS(event, 'text')"
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
                                            <img src="/views/assets/img/categories/default/default-image.jpg" class="img-fluid">
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
                
                    </div>                            

                </div>
                
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
                </div>

            </form>
        </div>
    </div>
</div>