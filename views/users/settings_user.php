<div class="row justify-content-center">
    <div class="bg-filter rounded col-md-6 p-4">
        <h2 class="text-center">Cambiar datos de la cuenta</h2>
        <form action="./?user=update&id=<?= $_SESSION['user']['id_usuario'] ?>" method="POST" class="needs-validation" novalidate>
            <div class="row g-3 mb-3">
                <div class="col-12">
                    <div class="form-floating dark-dark">
                        <input type="text" value="<?=$_SESSION['user']['nombre']?>" class="form-control" id="nombre" name="nombre" placeholder="" required>
                        <label for="nombre">Nombre:</label>
                        <div class="invalid-feedback">Por favor, introduce tu nombre.</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating dark-dark">
                        <input type="text" value="<?=$_SESSION['user']['apellidos']?>" class="form-control" id="apellidos" name="apellidos" placeholder="" required>
                        <label for="apellidos">Apellidos:</label>
                        <div class="invalid-feedback">Por favor, introduce tus apellidos.</div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-floating dark-dark">
                        <input type="text" value="<?=$_SESSION['user']['dni']?>" disabled class="form-control bg-blue" id="dni" name="dni" placeholder="" required>
                        <label for="dni">DNI:</label>
                        <div class="invalid-feedback">Por favor, introduce tu DNI.</div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-floating dark-dark">
                        <input type="tel" value="<?=$_SESSION['user']['telefono']?>" class="form-control" id="telefono" name="telefono" pattern="[0-9]{9}" placeholder="" required>
                        <label for="telefono">Teléfono:</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating dark-dark">
                        <input type="email" value="<?=$_SESSION['user']['correo']?>" class="form-control" id="correo" name="correo" placeholder="" required>
                        <label for="correo">Correo electrónico:</label>
                        <div class="invalid-feedback">Por favor, introduce un correo electrónico válido.</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <input type="password" class="form-control" id="contrasenia" name="contrasenia" placeholder="" required>
                        <label for="contrasenia">Contraseña:</label>
                        <div class="invalid-feedback">Por favor, introduce tu contraseña.</div>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block mt-3"><i class="fa-solid fa-floppy-disk"></i> Actualizar datos</button>
                </div>
            </div>
        </form>
    </div>
</div>
