<div class="d-flex justify-content-center container">
    <div class="bg-filter rounded col-md-6 p-4">
        <h2 class="text-center">Configuración</h2>
        <form action="./?admin=usettings" method="POST" novalidate>
            <div class="row g-3 mb-3">
                <div class="col-12">
                    <div class="form-floating">
                        <input type="email" value="<?=$_SESSION['admin']['email_contacto']?>" class="form-control" id="email_contacto" name="email_contacto" placeholder="" required>
                        <label for="email_contacto">Email contacto</label>
                        <div class="invalid-feedback">Por favor, introduce el email de contacto.</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-floating">
                        <input type="tel" value="<?=$_SESSION['admin']['telefono_contacto']?>" class="form-control" id="telefono_contacto" name="telefono_contacto" pattern="[0-9]{9}" placeholder="" required>
                        <label for="telefono_contacto">Telefono contacto</label>
                        <div class="invalid-feedback">Por favor, introduce el telefono de contacto.</div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="form-floating">
                        <input type="text" value="<?=$_SESSION['admin']['direccion_oficina']?>" class="form-control" id="direccion_oficina" name="direccion_oficina" placeholder="" required>
                        <label for="direccion_oficina">Dirección oficina:</label>
                        <div class="invalid-feedback">Por favor, introduce la dirección de la oficina.</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <input type="text" value="<?=$_SESSION['admin']['mapa_embedded']?>" class="form-control" id="mapa_embedded" name="mapa_embedded" placeholder="" required>
                        <label for="mapa_embedded">URL Mapa:</label>
                        <div class="invalid-feedback">Por favor, introduce la URL del mapa.</div>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block mt-3"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
