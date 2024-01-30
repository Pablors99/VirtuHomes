<?php
$referencia = isset($_GET['ref']) ? (int)$_GET['ref'] : 0;
$apartmentController = new apartment_controller();
$apartment = $apartmentController->viewApartment($referencia);
if (!empty($apartment)) $titulo = '¿Nuevo hogar en ' . $apartment['nombre_municipio'] . '?';
else header('Location: ./?apartment=list&page=1');
?>
<section id="bienvenida" class="d-flex flex-column gap-4 flex-content-center align-items-center text-center text-white">
    <h1 class="text-uppercase my-3"><span class="text-primary-emphasis">VirtuHomes</span> - <?= $titulo ?></h1>
    <?php include './includes/show_alert.php'; showAlert(); ?>
</section>
<main class="flex-grow-1 flex-shrink-1">
<section id="propiedades" class="d-flex flex-column justify-content-center align-items-center mx-5">
    <div class="container bg-filter rounded p-2">
        <div class="row g-2 mb-3">
            <div class="d-flex justify-content-center col-md-4">
                <img src="<?= $apartment['imagen'] ?>" alt="Imagen de apartamento" id="imagen-preview" class="img-fluid rounded">
            </div>
            <div class="col-md-8 px-2">
                <div class="d-flex flex-column">
                    <div class="h-100">
                        <div class="row mb-3">
                            <p class="fs-5 fw-bold text-body-secondary text-uppercase"><?= $apartment['nombre_municipio'] ?> <?= $apartment['codigo_postal'] ?></p>
                        </div>
                        <div class="row mb-3">
                            <p class="fs-6 fw-semibold"><?= $apartment['calle'] ?> - Nº <?= $apartment['numero_calle'] ?></p>
                        </div>
                        <div class="mb-3">
                            <ul class="navbar-nav gap-2">
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
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <p class="card-text"><?= $apartment['descripcion']?></p>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="card-title my-3"><strong><?= number_format($apartment['precio'], 0, ',', '.') ?></strong>€</h4>
            <div class="d-flex justify-content-end align-items-end gap-3 p-3">
                <?php if (isset($_SESSION['user'])): ?>
                    <?php if ($apartment['id_usuario'] !== $_SESSION['user']['id_usuario']): ?>
                        <?php if (in_array($referencia, $_SESSION['shopcar'])): ?>
                            <a href="./?user=removeshopcar&ref=<?= $referencia ?>" class="btn btn-danger text-white mt-2"><i class="fa-solid fa-cart-arrow-down"></i> Quitar del carrito</a>
                        <?php else: ?>
                            <a href="./?user=addshopcar&ref=<?= $referencia ?>" class="btn btn-primary text-white mt-2"><i class="fa-solid fa-cart-plus"></i> Agregar al carrito</a>
                        <?php endif ?>
                    <?php else: ?>
                    <a href="#" class="btn btn-danger btn-block text-white mt-2 disabled"><i class="fa-solid fa-ban"></i> Eres el propietario</a>
                    <?php endif ?>
                <?php elseif (isset($_SESSION['admin'])): ?>
                    <a href="./?apartment=archive&ref=<?= $apartment['id_piso'] ?>" class="btn btn-danger text-white mt-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Retirar piso"><i class="fa-solid fa-trash"></i> Retirar piso inapropiado</a>
                <?php else: ?>
                <a href="./?user=login" class="btn btn-primary btn-block text-white mt-2"><i class="fa-solid fa-cart-shopping"></i> Comprar</a>
                <?php endif ?>
            </div>
        </div>
    </div>
</section>
</main>
