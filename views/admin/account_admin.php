<div class="d-flex justify-content-center container">
    <div class="bg-filter rounded col-md-6 p-4">
        <h2 class="text-center">Cuenta Administrador</h2>
        <form action="./?admin=uaccount" method="POST" class="needs-validation" novalidate>
            <div class="row g-3 mb-3">
                <div class="col-12">
                    <div class="form-floating dark-dark">
                        <input type="email" value="<?=$_SESSION['admin']['email_administrador']?>" class="form-control" id="email_administrador" name="email_administrador" placeholder="" required>
                        <label for="email_administrador">Correo electrónico:</label>
                        <div class="invalid-feedback">Por favor, introduce un correo electrónico válido.</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password_administrador" name="password_administrador" placeholder="" required>
                        <label for="password_administrador">Contraseña:</label>
                        <div class="invalid-feedback">Por favor, introduce una contraseña.</div>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block mt-3"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
                </div>
            </div>
        </form>
    </div>
</div>
