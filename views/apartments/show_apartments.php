<?php
include_once './controllers/apartment_controller.php';

/* Controla los filtros */
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
$filter = filter_input(INPUT_GET, 'filter', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

/* Controla el paginado */
$page = (isset($_GET['page']) && (int)$_GET['page'] > 0) ? (int)$_GET['page'] : 1; // * SE SOLICITARA EL NÚMERO DE PÁGINA

$apartment_per_page = 4; // * SE CAMBIA EL $limit por $tems_per_page
$apartment_start = ($page - 1) * $apartment_per_page;

$apartmentController = new apartment_controller();
$apartments = $apartmentController->showAvailable($filter, $apartment_start, $apartment_per_page, 'EN VENTA');
$total_items = $apartmentController->totalAvailable(); // * NUEVA FORMA DE CONTAR APARTAMENTOS

$number_of_pages = ceil($total_items / $apartment_per_page); // * NUMERADOR DE PAGINAS OPCIONAL

$lista_municipios = $apartmentController->municipios();
?>
<?php include './views/apartments/pages_apartments.php'; ?>
<?php if (!empty($apartments)): ?>
    <div class="row g-3 justify-content-evenly">
    <?php foreach ($apartments as $apartment): ?>
        <div class="col-lg-6">
            <a class="text-decoration-none" href="./?apartment=view&ref=<?= $apartment['id_piso'] ?>">
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
                                        <?php if (isset($_SESSION['shopcar'])): ?>
                                            <?php if (in_array($apartment['id_piso'], $_SESSION['shopcar'])): ?>
                                                <div class="card-text fw-semibold text-uppercase text-info-emphasis">En el carrito</div>
                                            <?php endif ?>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
    </div>

    <div class="d-flex justify-content-center align-items-center gap-3">
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="<?php echo buildUrl($page - 1, $filter); ?>" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Anterior</a>
            <?php else: ?>
                <a href="#" class="btn btn-primary disabled"><i class="fas fa-chevron-left"></i> Anterior</a>
            <?php endif; ?>
        </div>
        <div class="pagination">
            <?php if ($page < $number_of_pages): ?>
                <a href="<?php echo buildUrl($page + 1, $filter); ?>" class="btn btn-primary">Siguiente <i class="fas fa-chevron-right"></i></a>
            <?php else: ?>
                <a href="#" class="btn btn-primary disabled">Siguiente <i class="fas fa-chevron-right"></i></a>
            <?php endif; ?>
        </div>
    </div>

<?php else: ?>
    <div class="col-md-6">
       <div class="card">
          <div class="card-body">
              <h2 class="card-title d-flex justify-content-center align-items-center">No se han encontrado pisos a la venta disponibles.</h2>
          </div>
       </div>
    </div>

    <div class="d-flex justify-content-center align-items-center gap-3">
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="<?php echo buildUrl($page - 1, $filter); ?>" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Anterior</a>
            <?php else: ?>
                <a href="#" class="btn btn-primary disabled"><i class="fas fa-chevron-left"></i> Anterior</a>
            <?php endif; ?>
        </div>
        <div class="pagination">
            <?php if ($page < $number_of_pages): ?>
                <a href="<?php echo buildUrl($page + 1, $filter); ?>" class="btn btn-primary">Siguiente <i class="fas fa-chevron-right"></i></a>
            <?php else: ?>
                <a href="#" class="btn btn-primary disabled">Siguiente <i class="fas fa-chevron-right"></i></a>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
