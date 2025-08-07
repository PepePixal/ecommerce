<div class="login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-dark">
            <div class="card-header text-center">
                <h3><b>Administradores</b></h3>
            </div>
            <div class="card-body">

                <!-- la class ned-validated es para la validación del formulario con bootstrap,
                 novalidate para que no tenga en cuenta la validación por defecto de html -->
                <form method="post" class="needs-validation" novalidate>
                    <div class="input-group mb-3">
                        <input
                         onchange="validateJS(event, 'email')" 
                         type="email"
                         name="loginAdminEmail"
                         class="form-control"
                         placeholder="Email"
                         required
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <!-- Validacion de formulario con bootstrap -->
                        <div class="valid-feedback">Válido</div>
                        <div class="invalid-feedback">Completa este campo.</div>
                    </div>

                    <div class="input-group mb-3">
                        <input
                         type="password"
                         name="loginAdminPass"
                         class="form-control"
                         placeholder="Password"
                         required
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <!-- Validacion de formulario con bootstrap -->
                        <div class="valid-feedback">Válido</div>
                        <div class="invalid-feedback">Completa este campo.</div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input
                                 type="checkbox"
                                 id="remember"
                                 onchange="rememberEmail(event)"
                                >
                                <label for="remember">
                                    Recordar
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-4">
                            <button type="submit" class="btn btn-default templateColor btn-block">Entrar</button>
                        </div>
                        
                        <!-- desde aquí se puede instanciar los métodos del controlador admins.controller.php -->
                        <?php

                        require_once "controllers/admins.controller.php";
                        //instancia la class en el objeto $login
                        $login = new AdminsController();
                        //instancia el método login() de la clase instanciada
                        $login -> login();

                        ?>

                    </div>
                </form>

                <p class="mb-1">
                    <a href="#resetPassword" data-bs-toggle="modal">Recuperar contraseña</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
</div>


<!-- Ventana modal - Restablecer contraseña -->
<div class="modal" id="resetPassword">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Restablecer contraseña</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <p class="login-box-msg">¿Olvidaste tu contraseña? Aquí puedes restablecerla.</p>
        <form method="post">
            <div class="input-group mb-3">
                        <input
                         onchange="validateJS(event, 'email')" 
                         type="email"
                         name="resetPassword"
                         class="form-control"
                         placeholder="Email"
                         required
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <!-- Validacion de formulario con bootstrap -->
                        <div class="valid-feedback">Válido</div>
                        <div class="invalid-feedback">Completa este campo.</div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-default templateColor btn-block py-2">Solicitar nueva contraseña</button>
                </div>
            </div>

            <?php
                //requiere el archivo admins.controllers.php
                require_once "controllers/admins.controller.php";
                //objeto $reset con nueva instancia de la class AdminsController():
                $reset = new AdminsController();
                //llama al método resetPassword() de la class AdminsController()
                $reset -> resetPassword();
            ?>

        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>