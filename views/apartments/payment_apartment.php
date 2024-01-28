<?php
include './includes/session_closed.php';
$apartmentController = new apartment_controller;
$referencia = isset($_GET['ref']) ? (int)$_GET['ref'] : 0;
if (isset($_SESSION['shopcar'])) {
    $productos = $_SESSION['shopcar'];
    $precios = [];
    foreach ($productos as $id_piso) {
        $precio = $apartmentController->viewApartmentPrice($id_piso);
        $precios[] = $precio['precio'];
    }
    $pagoTotal = array_sum($precios);
}
?>
<!-- Sección de Payment -->
<section id="bienvenida" class="d-flex flex-column gap-4 flex-content-center align-items-center text-center text-white">
    <h1 class="text-uppercase my-3"><span class="text-primary-emphasis">VirtuHomes</span> - <?= $titulo ?></h1>
</section>
<main class="flex-grow-1 flex-shrink-1">
<section id="propiedades" class="d-flex flex-column justify-content-center align-items-center mx-5 gap-2">
    <div class="bg-filter rounded p-2">
        <h2 class="text-center mb-4">Total a pagar: <?= number_format($pagoTotal, 0, ',', '.') ?> €</h2>
        <form action="./?apartment=paid" method="POST" class="needs-validation row g-2 mb-3" novalidate>
            <div class="row g-3 mb-3">
                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="titular" name="titular" placeholder="" pattern="[A-Za-z\s]+" required>
                        <label for="titular">Nombre del Titular:</label>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="tarjeta" name="tarjeta" placeholder="" maxlength="16" pattern="[0-9]{16}" required>
                        <label for="tarjeta">Nº Tarjeta:</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" placeholder="" maxlength="5" pattern="(0[1-9]|1[0-2])\/[0-9]{2}" required>
                        <label for="fecha_vencimiento">Fecha venc. (MM/YY):</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <div class="form-floating">
                            <input type="password" class="form-control" id="cvv" name="contrasenia" placeholder="" maxlength="4" pattern="[0-9]{3}" required>
                            <label for="cvv">CVV:</label>
                        </div>
                        <button class="btn btn-outline-primary" type="button" id="showPasswordBtn"><i id="toogleIcon" class="fa-solid fa-eye-slash"></i></button>
                    </div>
                </div>
                <div class="col-md-8 text-end">
                    <button type="submit" class="btn btn-primary btn-block mt-3"><i class="fa-solid fa-credit-card"></i> Realizar pago</button>
                </div>
            </div>
        </form>
        <?php include './includes/show_alert.php'; showAlert(); ?>
    </div>
</section>
</main>
