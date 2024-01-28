<?php
$contactController = new contact_controller();
$config = $contactController->config();
?>
<?php if (!empty($config)): ?>
<div class="row justify-content-center gap-3">
    <div class="col-md-4 order-md-1">
        <div class="card mb-4 h-100">
            <h2 class="text-center p-3">Información de contacto</h2>
            <div class="card-body">
                <h6><i class="fa-solid fa-location-dot"></i> Nuestra Oficina Central</h6>
                <p><?= $config['direccion_oficina'] ?></p>
                <hr>
            </div>
            <div class="card-body">
                <h6><i class="fa-solid fa-phone"></i> Nuestro Teléfono</h6>
                <p><?= $config['telefono_contacto'] ?></p>
                <hr>
            </div>
            <div class="card-body">
                <h6><i class="fa-solid fa-envelope"></i> Nuestro correo</h6>
                <p><?= $config['email_contacto'] ?></p>
                <hr>
            </div>
        </div>
    </div>
    <div class="card col-md-6 order-md-2 py-2">
        <iframe src="<?= $config['mapa_embedded'] ?>" width="100%" height="450" class="rounded border-0" allowfullscreen="" loading="lazy"></iframe>
    </div>
</div>
<?php else: ?>
<div class="col-md-6">
   <div class="card">
      <div class="card-body">
          <h2 class="card-title d-flex justify-content-center align-items-center">Hubo un fallo al intentar cargar los datos de contacto.</h2>
      </div>
   </div>
</div>
<?php endif; ?>
