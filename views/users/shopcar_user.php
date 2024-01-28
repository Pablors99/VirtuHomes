<?php
include './controllers/apartment_controller.php';
$apartmentController = new apartment_controller();
$count_apartment = $apartmentController->totalAvailable();
$apartments = $apartmentController->showAvailable('', 0, $count_apartment, 'EN VENTA');
?>
<section id="bienvenida" class="d-flex flex-column gap-4 flex-content-center align-items-center text-center text-white">
    <h1 class="text-uppercase my-3"><span class="text-primary-emphasis">VirtuHomes</span> - <?= $titulo ?></h1>
    <?php include './includes/show_alert.php'; showAlert(); ?>
</section>
<main class="d-flex justify-content-center flex-grow-1 flex-shrink-1">
<section id="propiedades" class="d-flex flex-column justify-content-center align-items-center container rounded bg-filter mx-5 p-2 gap-2">
<?php if (!empty($apartments) && count($_SESSION['shopcar']) > 0): ?>
    <?php foreach ($apartments as $apartment): ?>
        <?php if (in_array($apartment['id_piso'], $_SESSION['shopcar'])): ?>
        <div class="col-lg-6">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-5">
                        <img src="<?= $apartment['imagen'] ?>" class="card-img img-fluid p-1" alt="">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body d-flex flex-column">
                            <div class="h-100">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title text-body-secondary text-uppercase"><?= $apartment['nombre_municipio'] ?> <?= $apartment['codigo_postal'] ?></h3>
                                </div>
                                <h2 class="card-title"><?= $apartment['calle'] ?> - nº <?= $apartment['numero_calle'] ?></h2>
                                <div class="card-text my-2">
                                    <ul class="navbar-nav flex-lg-row gap-2">
                                        <li>
                                            <p><i class="fa-solid fa-bed"></i><span class="mx-2"><?= $apartment['habitaciones']?> habs.</span></p>
                                        </li>
                                        <li>
                                            <p><i class="fa-solid fa-bath"></i><span class="mx-2"><?= $apartment['aseos']?> baños</span></p>
                                        </li>
                                        <li>
                                            <p><i class="fa-solid fa-ruler"></i><span class="mx-2"><?= $apartment['metros']?> m²</span></p>
                                        </li>
                                        <?php if ($apartment['planta'] !== null): ?>
                                        <li>
                                            <p><i class="fa-solid fa-building"></i><span class="mx-2"><?= $apartment['planta']?>ª planta</span></p>
                                        </li>
                                        <?php endif ?>
                                    </ul>
                                </div>
                                <p class="card-text card-description"><?= $apartment['descripcion']?></p>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="card-title my-3"><strong><?= number_format($apartment['precio'], 0, ',', '.') ?></strong>€</h4>
                                    <div class="col-md-4 text-end">
                                        <a href="./?user=shopcarremove&ref=<?= $apartment['id_piso'] ?>" class="btn btn-danger text-white mt-2"><i class="fa-solid fa-cart-arrow-down"></i> Quitar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <a href="./?apartment=payment" class="btn btn-primary text-white mt-2"><i class="fa-solid fa-money-bill"></i> Realizar pago</a>
<?php else: ?>
<div class="col-md-6">
   <div class="card">
      <div class="card-body">
          <h2 class="card-title d-flex justify-content-center align-items-center">El carrito se encuentra vacio</h2>
      </div>
   </div>
</div>
<?php endif; ?>
</main>
