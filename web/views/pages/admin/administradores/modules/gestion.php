<?php
    //gestion.php se invoca tanto para alta nueva como para edicion de Administrador,
    //si se invoca desde editar, la url contiene argumento (?) con la var admin con el id_admin codificado,
    //del Administrador a editar, que podemos obtener de la var super glob $_GET,
    //se decodifica y se usa para traer la info del registro del Administrador de la BD, e imprimirla en el form

    //validar si en la url viene la var admin
    if (isset($_GET['admin'])) {

        //var con los campos del registro que necesitaremos para mostrarlos en el form
        $select = "id_admin,rol_admin,name_admin,email_admin,password_admin";

        //define vars para buscar el rgistro por el id_admin decodificado, en la tabla de la BD, a traves de la API
        //En la tabla admins, en la columna id_admins, busca un registro cuyo valor sea igual al valor de la var 'admin'
        $url = "admins?linkTo=id_admin&equalTo=".base64_decode($_GET['admin']);
        $method = "GET";
        $fields = array();

        //llama método static request(), enviando parámetros, que retorna un objeto a $admin
        $admin =  CurlController::request($url, $method, $fields);

        //valida si el valor de la propiedad [status] es = 200, respuesta válida
        if ($admin->status == 200) {

            //obtiene el indice [0] del arreglo de la propiedad [results], el registro buscado (objeto).
            $admin = $admin->results[0];

        //si la respuesta ha sido error
        } else {
            //asigna null a la var $admin
            $admin = null;
        }

    //si en la url no viene la var admin
    } else {
        //asigna null a la var $admin
        $admin = null;
    }
?>

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
                                    <h4 class="mt-3">Editando Administrador</h4>
                                <?php else: ?>
                                    <h4 class="mt-3">Añadir Administrador</h4>
                                <?php endif ?>
                            </div>

                            <div class="col-12 col-lg-6 mt-2 d-flex justify-content-center justify-content-lg-end align align-items-center">
                                <button type="submit" class="btn border-0 templateColor py-2 px-3 mr-3 btn-sm rounded-pill">Guardar Información</button>
                                <a href="/admin/administradores" class="btn btn-default py-2 px-3 btn-sm rounded-pill">Vovler</a>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <!-- Instancia el controller, class y método que gestiona el Alta de Administradores en la BD.
                     Se instancia aquí para posicionar los mensajes tanto de error como de éxito, en esta parte del form -->
                    <?php
                        require_once "controllers/admins.controller.php";
                        $manage = new AdminsController();
                        $manage -> adminManage();
                    ?>

                    <div class="row row-cols-1 row-cols-md-2">

                        <div class="col">
                            <div class="card">
                                <div class="card-body">

                                    <div class="form-group pb-3">
                                        <label for="name_admin">Nombre <sup class="text-danger font-weight-bold">*</sup></label>
                                        <!-- el value está condicionado a si está EDITANDO -->
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Escribe tu nombre"
                                            id="name_admin"
                                            name="name_admin"
                                            onchange="validateJS(event, 'text')"
                                            value="<?php if (!empty($admin)): ?><?php echo $admin->name_admin; ?><?php endif ?>"
                                            required
                                        >
                                        
                                        <div class="valid-feedback">Completado</div>
                                        <div class="invalid-feedback">Campo obligatorio</div>
                                    </div>

                                    <div class="form-group pb-3">
                                        <label for="rol_admin">Rol <sup class="text-danger font-weight-bold">*</sup></label>
                                        <select name="rol_admin" id="rol_admin" class="form-control" required>
                                            <option value="">Elije Rol</option>
                                            <!-- options condicionadas a si está EDITANDO -->
                                            <option value="admin"  <?php if (!empty($admin) && $admin->rol_admin == "admin"): ?> selected <?php endif ?>>Administrador</option>
                                            <option value="editor" <?php if (!empty($admin) && $admin->rol_admin == "editor"): ?> selected <?php endif ?>>Editor</option>
                                        </select>
                                        <!-- para la validación de formato por JS -->
                                        <div class="valid-feedback">Completado</div>
                                        <div class="invalid-feedback">Campo obligatorio</div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col pl-lg-3">
                            <div class="card">
                                <div class="card-body">

                                    <div class="form-group pb-3">
                                        <label for="email_admin">Email <sup class="text-danger font-weight-bold">*</sup></label>
                                        <!-- el value está condicionado a si está EDITANDO -->
                                        <input
                                            type="email"
                                            class="form-control"
                                            placeholder="Escribe tu email"
                                            id="email_admin"
                                            name="email_admin"
                                            onchange="validateJS(event, 'email')"
                                            value="<?php if (!empty($admin)): ?><?php echo $admin->email_admin; ?><?php endif ?>"
                                            required
                                        >
                                        <!-- para la validación de formato por JS -->
                                        <div class="valid-feedback">Completado</div>
                                        <div class="invalid-feedback">Campo obligatorio</div>
                                    </div>

                                    <div class="form-group pb-3">
                                        <label for="password_admin">Contraseña <sup class="text-danger font-weight-bold">*</sup></label>
                                        <input
                                            type="password"
                                            class="form-control"
                                            placeholder="Escribe tu contraseña"
                                            id="password_admin"
                                            name="password_admin"
                                            onchange="validateJS(event, 'password')"
                                            required
                                        >
                                        <!-- para la validación de formato por JS -->
                                        <div class="valid-feedback">Completado</div>
                                        <div class="invalid-feedback">Campo obligatorio</div>
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
                                <a href="/admin/administradores" class="btn btn-default py-2 px-3 btn-sm rounded-pill">Vovler</a>
                            </div>

                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>