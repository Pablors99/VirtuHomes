<?php
require_once './models/apartment_model.php';
include_once 'admin_controller.php';

class apartment_controller {
    private $apartmentModel;
    private $config;
    private $listApartment;
    private $pageApartment;
    private $pageDashboard;


    public function __construct() {
        $this->apartmentModel = new apartment_model();
        $this->config = new admin_controller();
        $this->listApartment = './?apartment=list';
        $this->pageApartment = './?user=apartment';
        $this->pageDashboard = './?user=dashboard';
    }

    private function validateImageStore() {
        if (isset($_FILES["imagen-input"]) && $_FILES["imagen-input"]["error"] == UPLOAD_ERR_OK) {
            $imagen_info = getimagesize($_FILES["imagen-input"]["tmp_name"]);
            $tipo_mime = $imagen_info['mime'];

            if ($tipo_mime != 'image/png') {
                $this->config->encode('La imagen tiene que ser un archivo .png', $this->pageApartment, 'danger');
                return false;
            }
            return true;
        } else {
            $this->config->encode('No se seleccionó ninguna imagen o hubo un error al subirla.', $this->pageApartment, 'danger');
            return false;
        }
    }

    private function validateImageUpdate() {
        if (isset($_FILES["imagen-input"]) && $_FILES["imagen-input"]["error"] == UPLOAD_ERR_OK) {
            $imagen_info = getimagesize($_FILES["imagen-input"]["tmp_name"]);
            $tipo_mime = $imagen_info['mime'];

            if ($tipo_mime != 'image/png') {
                $this->config->encode('La imagen tiene que ser un archivo .png', $this->pageApartment, 'danger');
                return false;
            }
            return true;
        } else {
            return false;
        }
    }

    private function moveUploadedFile($ruta_completa) {
        return move_uploaded_file($_FILES["imagen-input"]["tmp_name"], $ruta_completa);
    }

    private function collectFormData($imagen) {
        $apartmentData = [
            'id_usuario' => $_GET['id'],
            'habitaciones' => $_POST['habitaciones'],
            'aseos' => $_POST['aseos'],
            'metros' => $_POST['metros'],
            'planta' => ($_POST['planta'] !== '') ? $_POST['planta'] : null,
            'precio' => $_POST['precio'],
            'descripcion' => $_POST['descripcion'],
            'municipio' => $_POST['id_municipio'],
            'calle' => $_POST['calle'],
            'numero_calle' => $_POST['numero_calle'],
            'codigo_postal' => $_POST['codigo_postal'],
            'imagen' => $imagen
        ];
        if (isset($_GET['ref'])) $apartmentData['id_piso'] = $_GET['ref'];

        return $apartmentData;
    }

    private function datacollectStore() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->validateImageStore()) {
                $ruta_destino = "./assets/img/";
                $nombre_archivo = sha1(uniqid()) . '.png';
                $ruta_completa = $ruta_destino . $nombre_archivo;

                if ($this->moveUploadedFile($ruta_completa)) {
                    $apartmentData = $this->collectFormData($ruta_completa);
                    return $apartmentData;
                } else {
                    $this->config->encode('Hubo un error al subir la imagen.', $this->pageApartment, 'danger');
                }
            }
        } else {
            header("Location: " . $this->listApartment);
        }
    }

    private function datacollectUpdate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->validateImageUpdate()) {
                $ruta_destino = "./assets/img/";
                $nombre_archivo = sha1(uniqid()) . '.png';
                $ruta_completa = $ruta_destino . $nombre_archivo;
                $upload_imagen = $this->moveUploadedFile($ruta_completa);

                if (!$upload_imagen) $this->config->encode('Hubo un error al subir la imagen.', $this->pageApartment, 'danger');
            } else {
                $ruta_completa = $_POST['imagen-hidden'];
            }
            $apartmentData = $this->collectFormData($ruta_completa);
            return $apartmentData;
        } else {
            header("Location: " . $this->listApartment);
        }
    }

    public function list() {
        $titulo = 'Descubre cual será tu nuevo hogar';
        include './includes/apartments.php';
    }

    public function view() {
        include './views/apartments/view_apartment.php';
    }

    public function filter() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $page = (isset($_GET['page']) && (int)$_GET['page'] > 0) ? (int)$_GET['page'] : 1;
            $municipio = $_POST['municipio'];
            $calle = $_POST['calle'];
            $habitaciones = $_POST['habitaciones'];
            $aseos = $_POST['aseos'];

            header("Location: ./?apartment=list&page=$page&filter=$municipio+$calle+$habitaciones+$aseos");
        } else {
            header("Location: " . $this->listApartment);
        }
    }

    public function payment() {
        $titulo = 'A poco pasos de conseguir tu piso';
        include './views/apartments/payment_apartment.php';
    }


    public function paid() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_SESSION['user']['id_usuario'];
            $id_pisos = $_SESSION['shopcar'];

            foreach ($id_pisos as $id) {
                $result = $this->apartmentModel->paidApartment($id_usuario, $id);
            }

            if ($result === true) {
                $_SESSION['shopcar'] = [];
                $this->config->encode('Se ha realizado la compra éxitosamente', $this->pageDashboard, 'success');
            } else {
                $this->config->encode($result, $this->listApartment, 'danger');
            }
        } else {
            header("Location: " . $this->listApartment);
        }
    }

    public function store() {
        $apartmentData = $this->datacollectStore();
        $result = $this->apartmentModel->createApartment($apartmentData);

        if ($result === true) {
            $this->config->encode('Se ha publicado el piso con éxito', $this->pageDashboard, 'success');
        } else {
            $this->config->encode($result, $this->pageApartment, 'danger');
        }
    }

    public function update() {
        $apartmentData = $this->datacollectUpdate();
        //print_r($apartmentData);
        $result = $this->apartmentModel->updateApartment($apartmentData);

        if ($result === true) {
            $this->config->encode('Se ha actualizado el piso con éxito', $this->pageDashboard, 'success');
        } else {
            $this->config->encode($result, $this->pageDashboard, 'danger');
        }
    }

    public function archive() {
        if (isset($_GET['ref'])) {
            $id_piso = $_GET['ref'];
            $result = $this->apartmentModel->archivedApartment($id_piso);

            if ($result === true) {
                if (isset($_SESSION['admin'])) {
                    $this->apartmentModel->addHistoryArchived($id_piso, $_SESSION['admin']['id_empleado']);
                    $this->pageDashboard = './?admin=archived';
                }
                $this->config->encode('Se ha retirado el piso de la lista de ventas.', $this->pageDashboard, 'success');
            } else {
                $this->config->encode($result, $this->pageDashboard, 'danger');
            }
        } else {
            header("Location: " . $this->pageDashboard);
        }
    }

    public function restore() {
        if (isset($_GET['ref'])) {
            $id_piso = $_GET['ref'];
            $result = $this->apartmentModel->restoredApartment($id_piso);
            if ($result === true) {
                $this->config->encode('Se ha restaurado el piso correctamente.', $this->pageDashboard, 'success');
            } else {
                $this->config->encode($result, $this->pageDashboard, 'danger');
            }
        } else {
            header("Location: " . $this->pageDashboard);
        }
    }

    public function remove() {
        if (isset($_GET['ref'])) {
            $id_piso = $_GET['ref'];
            $result = $this->apartmentModel->deleteApartment($id_piso);
            if ($result === true) {
                $this->config->encode('Se ha eliminado el piso de manera definitiva.', $this->pageDashboard, 'success');
            } else {
                $this->config->encode($result, $this->pageDashboard, 'danger');
            }
        } else {
            header("Location: " . $this->pageDashboard);
        }
    }

    public function municipios() {
        return $this->apartmentModel->municipiosApartment();
    }

    public function showUserApartment($id_usuario, $estado) {
        return $this->apartmentModel->showAllUserApartment($id_usuario, $estado);
    }

    public function viewApartmentPrice($id_piso) {
        return $this->apartmentModel->showApartmentPrice($id_piso);
    }

    public function viewApartment($id_piso) {
        return $this->apartmentModel->showOneApartment($id_piso);
    }

    public function viewApartmentPurchased($id_usuario) {
        return $this->apartmentModel->showAllPurchased($id_usuario);
    }

    public function showAvailable($filter, $start, $limit, $estado) {
        return $this->apartmentModel->showAllForSale($filter, $start, $limit, $estado);
    }

    public function totalAvailable() {
        return $this->apartmentModel->getNumPisos();
    }
}
?>
