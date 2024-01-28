<?php include './includes/session_started.php'; ?>
<section id="bienvenida" class="d-flex flex-column gap-4 flex-content-center align-items-center text-center text-white">
    <h1 class="text-uppercase my-3"><span class="text-primary-emphasis">VirtuHomes</span> - <?= $titulo ?></h1>
</section>
<main class="d-flex align-items-center flex-grow-1 flex-shrink-1">
<section id="propiedades" class="container">
    <div class="row justify-content-center">
        <div class="bg-filter rounded col-md-6 p-4">
            <h2 class="text-center">Registrate</h2>
            <form action="./?user=signin" method="POST" class="needs-validation" novalidate>
                <div class="row g-3 mb-3">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" required>
                            <label for="nombre">Nombre:</label>
                            <div class="invalid-feedback">Por favor, pon tu nombre.</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="" required>
                            <label for="apellidos">Apellidos:</label>
                            <div class="invalid-feedback">Por favor, pon tus apellidos.</div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-floating">
                            <input type="text" class="form-control bg-blue" id="dni" name="dni" pattern="[0-9]{8}[A-Z]" placeholder="" required>
                            <label for="dni">DNI:</label>
                            <div class="invalid-feedback">Introduce un DNI válido.</div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-floating">
                            <input type="tel" class="form-control" id="telefono" name="telefono" pattern="[0-9]{9}" placeholder="" required>
                            <label for="telefono">Teléfono:</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="correo" name="correo" placeholder="" required>
                            <label for="correo">Correo electrónico:</label>
                            <div class="invalid-feedback">Introduce un correo electrónico válido.</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-group">
                            <div class="form-floating">
                                <input type="password" class="form-control" id="contrasenia" name="contrasenia" placeholder="" required>
                                <label for="contrasenia">Contraseña:</label>
                            </div>
                            <button class="btn btn-outline-primary" type="button" id="showPasswordBtn"><i id="toogleIcon" class="fa-solid fa-eye-slash"></i></button>
                        </div>
                        <small class="form-text">La contraseña debe de contener letras, números y carácteres especiales</small>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block mt-3">Crear cuenta</button>
                    </div>
                </div>
            </form>
            <div class="text-center mt-3">
                <p>¿Ya tienes una cuenta? <a href="./?user=login">Inicia Sesión</a></p>
            </div>
            <?php include './includes/show_alert.php'; showAlert(); ?>
        </div>
    </div>
</section>
</main>
