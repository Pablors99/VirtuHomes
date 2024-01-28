<?php include './includes/session_started.php'; ?>
<section id="bienvenida" class="d-flex flex-column gap-4 flex-content-center align-items-center text-center text-white">
    <h1 class="text-uppercase my-3"><span class="text-primary-emphasis">VirtuHomes</span> - <?= $titulo ?></h1>
</section>
<main class="d-flex align-items-center flex-grow-1 flex-shrink-1">
<section id="propiedades" class="container">
    <div class="row justify-content-center">
        <div class="bg-filter rounded col-md-6 p-4">
            <h2 class="text-center">Iniciar Sesión</h2>
            <form action="./?user=logon" method="POST" class="needs-validation" novalidate>
                <div class="row g-3 mb-3">
                    <div class="col-12">
                        <div class="form-floating dark-dark">
                            <input type="email" class="form-control" id="correo" name="correo" placeholder="" required>
                            <label for="correo">Correo electrónico:</label>
                            <div class="invalid-feedback">Introduce tu correo electrónico.</div>
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
                    </div>
                    <div class="col-12 d-flex justify-content-between">
                        <!-- Un botón para que te sientas recordado, menos por ella -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="recordarme">
                            <label class="form-check-label" for="recordarme">Recordarme</label>
                        </div>
                        <div class="text-end">
                            <a href="./?user=login&m=QWwgaWd1YWwgcXVlIGVsbGEgdGUgb2x2aWRvIGEgdGkg=&t=danger">¿Olvidaste tu contraseña?</a>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block mt-3">Iniciar sesión</button>
                    </div>
                </div>
            </form>
            <div class="text-center mt-3">
                <p>¿Aún no tienes cuenta? <a href="./?user=signup">Regístrate</a></p>
                <p>¿Administrador? <a href="./?admin=login">Accede a la cuenta</a></p>
            </div>
            <?php include './includes/show_alert.php'; showAlert(); ?>
        </div>
    </div>
</section>
</main>
