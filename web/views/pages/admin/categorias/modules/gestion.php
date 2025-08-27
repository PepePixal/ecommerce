<?php
    //gestion.php se invoca tanto para alta nueva como para edicion de Categorías,
    //si se invoca desde editar, la url contiene argumento (?) con la var category con el id_category codificado,
    //de la categoría a editar, que podemos obtener de la var super glob $_GET,
    //se decodifica y se usa para traer la info del registro de la categoria de la BD, e imprimirla en el form

    //validar si en la url viene la var category
    if (isset($_GET['category'])) {

        //var con los campos que necesitaremos del registro a editar, para mostrarlos en los inputs del el form
        $select = "id_category,name_category,url_category,icon_category,image_category,description_category,keywords_category";

        //define vars para buscar el rgistro por el id_category decodificado, en la tabla de la BD, a traves de la API
        //En la tabla categories, en la columna id_category, busca un registro cuyo valor sea igual al valor de la var 'catrgory', seleccionando solo los datos de las colunas en $select
        $url = "categories?linkTo=id_category&equalTo=".base64_decode($_GET['category'])."&select=".$select;
        $method = "GET";
        $fields = array();

        //llama método static request(), enviando parámetros, que retorna un objeto a $category
        $category =  CurlController::request($url, $method, $fields);

        //valida si el valor de la propiedad [status] es = 200, respuesta válida
        if ($category->status == 200) {

            //obtiene el indice [0] del arreglo de la propiedad [results], el registro buscado (objeto).
            $category = $category->results[0];

        //si la respuesta ha sido error
        } else {
            //asigna null a la var $admin
            $category = null;
        }

    //si en la url no viene la var admin
    } else {
        //asigna null a la var $admin
        $category = null;
    }

?>

<div class="content mb-5">
    <div class="container">
        <div class="card">
            <!-- needs-validate validación con js / novalidate desactiva la validacion html -->
            <!-- enctype="multipart/form-data" permite al form trabajar con archivos (img, etc) -->
            <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

                <!-- valida si la var $category NO está vacia - EDITANDO  -->
                <?php if (!empty($category)): ?>

                    <!-- como está editando, genera input hidden para enviar el id_coategory, codificado, al controller -->
                    <input type="hidden" name="idCategory" value="<?php echo base64_encode($category->id_category); ?>">

                <?php endif ?>

                <div class="card-header">
                    <div class="container">
                        <div class="row">

                            <div class="col-12 col-lg-6 text-center text-lg-left">
                                <!-- comprobar si está EDITANDO -->
                                <?php if (!empty($category)): ?>
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
                                        <!-- readonly si se está editando el campo, para no modificarlo (por lo de la url)-->
                                        <!-- el value se asigna si la var $category no viene vacia, está EDITANDO -->
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Nombre de la Categoría"
                                            id="name_category"
                                            name="name_category"
                                            onchange="validateDataRepeat(event, 'category')"
                                            <?php if (!empty($category)): ?> readonly  <?php endif ?>
                                            value="<?php if (!empty($category)): ?><?php echo $category->name_category; ?><?php endif ?>"
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
                                            value="<?php if (!empty($category)): ?><?php echo $category->url_category; ?><?php endif ?>"
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
                                                <i class="<?php if (!empty($category)): ?><?php echo $category->icon_category; ?><?php else: ?>fas fa-shopping-bag<?php endif ?>"></i>
                                            </span>
                                            
                                            <input
                                            type="text"
                                            class="form-control"
                                            id="icon_category"
                                            name="icon_category"
                                            onfocus="addIcon(event)"
                                            value="<?php if (!empty($category)): ?><?php echo $category->icon_category; ?><?php else: ?>fas fa-shopping-bag<?php endif ?>"
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
                                        <!--texarea no tiene value, si está EDITANDO el texto se inserta en el própio textarea -->
                                        <textarea
                                        rows="9"
                                        class="form-control mb-3"
                                        placeholder="Escribe la descripción"
                                        id="description_category"
                                        name="description_category"
                                        onchange="validateJS(event, 'complete')"
                                        required
                                        ><?php if (!empty($category)): ?><?php echo $category->description_category; ?><?php endif ?>
                                        </textarea>

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
                                            onchange="validateJS(event, 'complete-tags')"
                                            value="<?php if (!empty($category)): ?><?php echo $category->keywords_category; ?><?php endif ?>"                                            
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

                                            <!-- si $category no viene vacia, está EDITANDO-->
                                            <?php if (!empty($category)): ?>
                                                <!-- la class changeImage es para la validación y cambio de url de img con el método validateImageJS() -->
                                                <img src="/views/assets/img/categories/<?php echo $category->url_category ?>/<?php echo $category->image_category ?>" class="img-fluid changeImage">

                                                <!-- envia el nombre de la imagen en un input oculto, con name=old_image_category -->
                                                <input type="hidden" value="<?php echo $category->image_category ?>" name="old_image_category">

                                            <!-- si category viene vacia, asigna la imagen default     -->
                                            <?php else: ?>
                                                
                                                <img src="/views/assets/img/categories/default/default-image.jpg" class="img-fluid changeImage">
                                            
                                            <?php endif ?>
 
                                            <p class="help-block small mt-3">Tamaño recomendado 1000 x 600 px | Peso Max. 2MB | Formato: PNG o JPG</p>

                                        </label>
                                        <!-- el required solo cuando es un ALTA nueva -->
                                        <div class="custom-file">
                                            <input
                                            type="file"
                                            class="custom-file-input"
                                            id="image_category"
                                            name="image_category"
                                            accept="image/*"
                                            maxSize="2000000"
                                            onchange="validateImageJS(event, 'changeImage')"
                                            <?php if (empty($category)): ?>
                                            required
                                            <?php endif ?>
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

                    <!--======================================
                        TERCER BLOQUE - Visor Metadatos
                    ========================================-->
                    <div class="row row-cols-1 pt-2">
                        <div class="col">
                            <div class="card">
                                <!-- col-md-6 para que ocupe 2 columnas a partir de dispositivos medium -->
                                <!-- offset-md-3 en el div crea un margen izquierdo de 3 columnas en dispositivos de tamaño medio (medium, md) y superiores.
                                  Esto desplaza la tarjeta hacia el centro de la página, ya que la clase col-md-6 ocupa 6 de las 12 columnas disponibles en la grill de Bootstrap. -->
                                <div class="card-body col-md-6 offset-md-3">
                                    <!--======================================
                                        Visor Metadatos
                                    ========================================-->
                                    <div class="form-group pb-3 text-center">
                                        <label>Visor Metadatos</label>
                                        <div class="d-flex justify-content-center">
                                            <div class="card">
                                                <div class="card-body">
                                                    <!--======================================
                                                        Imagen
                                                    ========================================-->
                                                    <figure class="mb-2">
                                                        <!-- valida si $category no está vacia -->
                                                        <?php if (!empty($category)): ?>
                                                            <!-- muestra la imagen del directorio y con el nombre, de la categoria -->
                                                            <!-- la class metaImg es para mostrar la imagen temporal, con el js de forms.js -->
                                                            <img src="/views/assets/img/categories/<?php echo $category->url_category ?>/<?php echo $category->image_category ?>" class="img-fluid metaImg" style="width:100%">
                                                        <?php else: ?>
                                                            <!-- muestra la imagen por defecto -->
                                                            <img src="/views/assets/img/categories/default/default-image.jpg" class="img-fluid metaImg" style="width:100%">
                                                        <?php endif ?>
                                                    </figure>
                                                    <!--======================================
                                                        Título
                                                    ========================================-->
                                                    <?php if (!empty($category)): ?>
                                                        <h6 class="text-left text-primary mb-1 metaTitle">
                                                            <?php echo $category->name_category ?>
                                                        </h6>   
                                                    <?php else: ?>
                                                        <h6 class="text-left text-primary mb-1">
                                                            Título
                                                        </h6>       
                                                    <?php endif ?>
                                                    <!--======================================
                                                        URL
                                                    ========================================-->
                                                    <p class="text-left text-success small mb-1">
                                                        <?php echo $path ?><span class="metaURL"><?php if (!empty($category)): ?><?php echo $category->url_category ?><?php else: ?>url<?php endif ?></span>
                                                    </p>
                                                    <!--======================================
                                                        Descripción
                                                    ========================================-->
                                                    <!-- la class metaDescription es para mostrar la descripción en tiempo real -->
                                                    <p class="text-left small mb-1 metaDescription">
                                                        <?php if (!empty($category)): ?>
                                                                <?php echo $category->description_category ?>
                                                        <?php else: ?>
                                                                Descripción
                                                        <?php endif ?>
                                                    </p>
                                                    <!--======================================
                                                        Palabras Clave
                                                    ========================================-->
                                                    <p class="text-left text-secondary small mb-1 metaTags">
                                                        <?php if (!empty($category)): ?>
                                                                <?php echo $category->keywords_category ?>
                                                        <?php else: ?>
                                                                palabras clave
                                                        <?php endif ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


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