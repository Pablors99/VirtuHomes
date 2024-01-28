<?php
require_once './models/admin_model.php';
class admin_controller {
    private $adminModel;
    private $pageSettings;
    private $pageAccount;
    private $pageLogin;
    private $dashboardAdmin;

    public function __construct() {
        $this->adminModel = new admin_model();
        $this->pageSettings = './?admin=settings';
        $this->pageAccount = './?admin=account';
        $this->pageLogin = './?admin=login';
        $this->dashboardAdmin = './views/admin/dashboard_admin.php';
    }

    public function settings() {
        $titulo = 'Actualiza los datos de configuración';
        include $this->dashboardAdmin;
    }

    public function account() {
        $titulo = 'Actualiza los datos de la cuenta';
        include $this->dashboardAdmin;
    }

    public function archived() {
        $titulo = 'Lista general de pisos retirados';
        include $this->dashboardAdmin;
    }

    public function sold() {
        $titulo = 'Lista general de pisos vendidos';
        include $this->dashboardAdmin;
    }

    public function login() {
        $titulo = 'Cuenta del Administrador';
        include './views/admin/login_admin.php';
    }

    public function logoff() {
        session_destroy();
        $this->encode('Sesión del Administrador cerrada correctamente.', $this->pageLogin, 'success',);
        exit();
    }

    public function logon() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = $_POST['correo'];
            $contrasenia = $_POST['contrasenia'];

            $result = $this->adminModel->loginAdmin($correo, $contrasenia);

            if ($result['status'] === 'success') {
                session_start();

                $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                $_SESSION['admin'] = [
                    'id_empleado' => $result['admin']['id_configuracion'],
                    'email_administrador' => $result['admin']['email_administrador'],
                    'password_administrador' => $result['admin']['password_administrador'],
                    'telefono_contacto' => $result['admin']['telefono_contacto'],
                    'email_contacto' => $result['admin']['email_contacto'],
                    'direccion_oficina' => $result['admin']['direccion_oficina'],
                    'mapa_embedded' => $result['admin']['mapa_embedded']
                ];

                header("Location: $this->pageSettings");
                exit();
            } else {
                $this->encode($result['message'], $this->pageLogin, 'danger');
            }
        } else {
            header("Location: $this->pageLogin");
        }
    }

    private function collectFormDataSettings() {
        $accountData = [
            'telefono_contacto' => $_POST['telefono_contacto'],
            'email_contacto' => $_POST['email_contacto'],
            'direccion_oficina' => $_POST['direccion_oficina'],
            'mapa_embedded' => $_POST['mapa_embedded']
        ];

        return $accountData;
    }

    private function collectFormDataAccount() {
        $accountData = [
            'email_administrador' => $_POST['email_administrador'],
            'password_administrador' => password_hash($_POST['password_administrador'], PASSWORD_DEFAULT)
        ];

        return $accountData;
    }

    public function uaccount() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accountData = $this->collectFormDataAccount();
            $result = $this->adminModel->updateAdmin($accountData);

            if ($result === true) {
                $this->encode('Se han actualizado los datos del Admin correctamente', $this->pageAccount, 'success');
            } else {
                $this->encode($result, $this->pageAccount, 'danger');
            }
        } else {
            header("Location: ./");
        }
    }

    public function usettings() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $settingsData = $this->collectFormDataSettings();
            $result = $this->adminModel->updateConfig($settingsData);

            if ($result === true) {
                $this->encode('Se han actualizado los datos de configuración correctamente', $this->pageSettings, 'success');
            } else {
                $this->encode($result, $this->pageSettings, 'danger');
            }
        } else {
            header("Location: ./");
        }
    }

    public function encode($message, $page, $type) {
        $encodedMessage = base64_encode($message);
        header("Location: $page&m=$encodedMessage&t=$type");
        exit();
    }
}
?>
