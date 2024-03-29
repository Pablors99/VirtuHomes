<nav class='d-flex justify-content-center align-items-center'>
    <form action="./?apartment=filter" method="POST" class="needs-validation bg-filter rounded p-2 mx-4" novalidate>
        <div class="row">
            <div class="form-group col-md-1 text-center">
                <button type="submit" class="btn btn-primary text-whi1te"><i class="fas fa-search"></i></button>
            </div>
            <div class="form-group col-md-4">
                <input type="text" class="form-control" name="calle" id="buscador" placeholder="Buscar por calle" required>
            </div>
            <div class="form-group col-md-3">
                <select class="form-select" id="municipio" name="municipio" aria-label="Municipios" required>
                    <option value="" selected disabled>Municipios</option>
                    <?php if (!empty($lista_municipios)): ?>
                        <?php foreach ($lista_municipios as $municipio): ?>
                            <option value=<?= $municipio['nombre_municipio'] ?>><?= $municipio['nombre_municipio'] ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group col-md-2">
                <input type="number" class="form-control" name="habitaciones" id="habitaciones" placeholder="Habs." required>
            </div>
            <div class="form-group col-md-2">
                <input type="number" class="form-control" name="aseos" id="aseos" placeholder="Baños" required>
            </div>
        </div>
    </form>   
</nav>

<?php
function buildUrl($page, $filter) {
    $url = "?apartment=list&page={$page}";
    if (!empty($filter)) $url .= "&filter=" . urlencode($filter);
    return $url;
}
?>
