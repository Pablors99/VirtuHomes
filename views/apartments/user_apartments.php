<?php
include './controllers/apartment_controller.php';
$apartmentController = new apartment_controller();
$apartments = $apartmentController->showUserApartment($_SESSION['user']['id_usuario'], 'EN VENTA');
?>
<?php if (!empty($apartments)): ?>
    <?php foreach ($apartments as $apartment): ?>
        <div class="col-lg-6">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-5">
                        <img src="<?= $apartment['imagen'] ?>" class="card-img img-fluid p-1" alt="">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body d-flex flex-column">
                            <div class="h-100">
                                <h3 class="card-title text-body-secondary text-uppercase"><?= $apartment['nombre_municipio'] ?> <?= $apartment['codigo_postal'] ?></h3>
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
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="card-title my-3"><strong><?= number_format($apartment['precio'], 0, ',', '.') ?></strong>€</h4>
                                    <div class="d-flex justify-content-end align-items-end gap-3 p-3">
                                        <a href="./?user=aupdate&ref=<?= $apartment['id_piso'] ?>" class="btn btn-warning btn-block text-white mt-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Editar piso"><i class="fa-solid fa-pencil"></i></a>
                                        <a href="./?apartment=archive&ref=<?= $apartment['id_piso'] ?>" class="btn btn-danger btn-block text-white mt-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Retirar piso"><i class="fa-solid fa-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="col-md-6">
       <div class="card">
          <div class="card-body">
              <h2 class="card-title d-flex justify-content-center align-items-center">No tienes pisos puestos a la venta.</h2>
          </div>
       </div>
    </div>
<?php endif; ?>
</main>
