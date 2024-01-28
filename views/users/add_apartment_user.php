<?php
include './includes/session_closed.php';
include './controllers/apartment_controller.php';
$apartmentController = new apartment_controller();
$lista_municipios = $apartmentController->municipios();
?>
<div class="container bg-filter rounded p-2">
    <h2 class="text-center mb-4">Agregar nuevo apartamento</h2>
    <form action="./?apartment=store&id=<?= $_SESSION['user']['id_usuario'] ?>" method="POST" class="needs-validation row g-2 mb-3" novalidate enctype="multipart/form-data">
        <div class="col-md-4 text-center">
            <label class="form-text" for="imagen-input">
                <img src="./assets/img/preview.png" alt="Imagen de apartamento" id="imagen-preview" class="img-fluid rounded">
                Haz clic para seleccionar una imagen.
            </label>
            <input type="file" id="imagen-input" name="imagen-input" class="form-control d-none" accept="image/png">
        </div>
        <div class="col-md-8">
            <div class="card-body d-flex flex-column">
                <div class="h-100">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <select class="form-select" name="id_municipio" id="municipio" aria-label="Municipios" required>
                                <option value="" selected disabled>Municipios</option>
                                <?php if (!empty($lista_municipios)): ?>
                                    <?php foreach ($lista_municipios as $municipio): ?>
                                        <option value=<?= $municipio['id_municipio'] ?>><?= $municipio['nombre_municipio'] ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="codigo_postal" placeholder="Código postal" maxlength="5" pattern="[0-9]+" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text" name="calle" placeholder="Nombre de la calle" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="numero_calle" placeholder="Número de la calle" class="form-control" pattern="[0-9]+" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <ul class="navbar-nav flex-lg-row gap-2">
                            <li>
                                <i class="fa-solid fa-bed"></i>
                                <input type="text" name="habitaciones" placeholder="Habs." class="form-control" pattern="[0-9]+" required>
                            </li>
                            <li>
                                <i class="fa-solid fa-bath"></i>
                                <input type="text" name="aseos" placeholder="Aseos" class="form-control" pattern="[0-9]+" required>
                            </li>
                            <li>
                                <i class="fa-solid fa-ruler"></i>
                                <input type="text" name="metros" placeholder="m²" class="form-control" pattern="[0-9]+" required>
                            </li>
                            <li>
                                <i class="fa-solid fa-building"></i>
                                <input type="text" name="planta" placeholder="Planta" class="form-control" pattern="[0-9]+">
                            </li>
                        </ul>
                    </div>
                    <div class="mb-3">
                        <textarea id="descripcion" class="form-control" name="descripcion" placeholder="Descripción" rows="6"></textarea>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" name="precio" placeholder="Precio" pattern="[0-9]+" class="form-control" required>
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                        <div class="col-md-4 text-end">
                            <button type="submit" class="btn btn-primary text-white"><i class="fa-solid fa-floppy-disk"></i> Publicar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
