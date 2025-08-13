<div class="content">
    <div class="container">
        <div class="card">
            <!-- needs-validate validación con js / novalidate desactiva la validacion html -->
            <form method="post" class="needs-validation" novalidate>

                <div class="card-header">
                    <div class="container">
                        <div class="row">

                            <div class="col-12 col-lg-6 text-center text-lg-left">
                                <h4 class="mt-3">Añadir Administrador</h4>
                            </div>

                            <div class="col-12 col-lg-6 mt-2 d-flex justify-content-center justify-content-lg-end align align-items-center">
                                <button type="submit" class="btn border-0 templateColor py-2 px-3 mr-3 btn-sm rounded-pill">Guardar Información</button>
                                <a href="/admin/administradores" class="btn btn-default py-2 px-3 btn-sm rounded-pill">Vovler</a>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-2">

                        <div class="col">
                            <div class="card">
                                <div class="card-body">

                                    <div class="form-group pb-3">
                                        <label for="name_admin">Nombre <sup class="text-danger font-weight-bold">*</sup></label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Escribe tu nombre"
                                            id="name_admin"
                                            name="name_admin"
                                            required
                                        >
                                        <!-- para la validación de formato por JS -->
                                        <div class="valid-feedback">Válido</div>
                                        <div class="invalid-feedback">Formato no válido</div>
                                    </div>

                                    <div class="form-group pb-3">
                                        <label for="rol_admin">Rol <sup class="text-danger font-weight-bold">*</sup></label>
                                        <select name="rol_admin" id="rol_admin" class="form-control" required>
                                            <option value="">Elije Rol</option>
                                            <option value="admin">Administrador</option>
                                            <option value="admin">Editor</option>
                                        </select>
                                        <!-- para la validación de formato por JS -->
                                        <div class="valid-feedback">Válido</div>
                                        <div class="invalid-feedback">Formato no válido</div>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="col pl-lg-3">
                            <div class="card">
                                <div class="card-body">

                                    <div class="form-group pb-3">
                                        <label for="email_admin">Email <sup class="text-danger font-weight-bold">*</sup></label>
                                        <input
                                            type="email"
                                            class="form-control"
                                            placeholder="Escribe tu email"
                                            id="email_admin"
                                            name="email_admin"
                                            required
                                        >
                                        <!-- para la validación de formato por JS -->
                                        <div class="valid-feedback">Válido</div>
                                        <div class="invalid-feedback">Formato no válido</div>
                                    </div>

                                    <div class="form-group pb-3">
                                        <label for="password_admin">Contraseña <sup class="text-danger font-weight-bold">*</sup></label>
                                        <input
                                            type="password"
                                            class="form-control"
                                            placeholder="Escribe tu contraseña"
                                            id="password_admin"
                                            name="password_admin"
                                            required
                                        >
                                        <!-- para la validación de formato por JS -->
                                        <div class="valid-feedback">Válido</div>
                                        <div class="invalid-feedback">Formato no válido</div>
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