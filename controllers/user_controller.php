<?php

require './models/user_model.php';
include 'admin_controller.php';

class user_controller {
    private $userModel;
    private $config;
    private $dashboard;

    public function __construct() {
        $this->userModel = new user_model();
        $this->config = new admin_controller();
        $this->dashboard = './views/users/dashboard_user.php';
    }

    public function dashboard() {
        $titulo = 'Lista de mis pisos en venta';
        require_once $this->dashboard;
    }

    public function settings() {
        $titulo = 'Actualiza tus datos de la cuenta';
        require_once $this->dashboard;
    }

    public function apartment() {
        $titulo = 'Agrega un nuevo piso a la venta';
        require_once $this->dashboard;
    }

    public function aupdate() {
        $titulo = 'Actualiza los datos de tu piso';
        require_once $this->dashboard;
    }

    public function archived() {
        $titulo = 'Restaura un piso retirado';
        require_once $this->dashboard;
    }

    public function sold() {
        $titulo = 'Pisos que has logrado vender';
        require_once $this->dashboard;
    }

    public function purchased() {
        $titulo = 'Pisos que son ahora tu nuevo hogar';
        require_once $this->dashboard;
    }

    public function shopcar() {
        $titulo = 'Lista de apartamentos en el carrito';
        require_once './views/users/shopcar_user.php';
    }

    public function addshopcar() {
        $ref = isset($_GET['ref']) ? $_GET['ref'] : '';
        if (!empty($ref)) {
            $shopcar = isset($_SESSION['shopcar']) ? $_SESSION['shopcar'] : [];
            $shopcar[] = $ref;
            $_SESSION['shopcar'] = $shopcar;
            header('Location: ./?apartment=view&ref=' . $ref);
        } else {
            $this->config->encode('Error al agregar el apartamento al carrito.', './?apartment=list', 'danger');
        }
    }

    public function removeshopcar($redirect_url = './?apartment=view') {
        $ref = isset($_GET['ref']) ? $_GET['ref'] : '';
        $this->removeProductFromShopcar($redirect_url . '&ref=' . $ref);
    }

    public function shopcarremove($redirect_url = './?user=shopcar') {
        $this->removeProductFromShopcar($redirect_url);
    }

    private function removeProductFromShopcar($redirect_url) {
        $ref = isset($_GET['ref']) ? $_GET['ref'] : '';
        if (!empty($ref)) {
            $shopcar = isset($_SESSION['shopcar']) ? $_SESSION['shopcar'] : [];
            $shopcar = array_diff($shopcar, [$ref]);
            $_SESSION['shopcar'] = $shopcar;
            header("Location: $redirect_url");
            exit();
        } else {
            $this->config->encode('Error al retirar apartamento del carrito.', './?apartment=list', 'danger');
        }
    }

    public function login() {
        $titulo = 'Inicia sesión y publica tu piso';
        require_once './views/users/login_user.php';
    }

    public function logon() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = $_POST['correo'];
            $contrasenia = $_POST['contrasenia'];

            $result = $this->userModel->loginUser($correo, $contrasenia);

            if ($result['status'] === 'success') {
                session_start();

                $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                $_SESSION['shopcar'] = [];
                $_SESSION['user'] = [
                    'id_usuario' => $result['user']['id_usuario'],
                    'dni' => $result['user']['dni'],
                    'nombre' => $result['user']['nombre'],
                    'apellidos' => $result['user']['apellidos'],
                    'correo' => $result['user']['correo'],
                    'telefono' => $result['user']['telefono'],
                    'contrasenia' => $result['user']['contrasenia'],
                ];

                header("Location: ./?user=dashboard");
                exit();
            } else {
                $this->config->encode($result['message'], './?user=login', 'danger');
            }
        } else {
            header("Location: ./?user=login");
        }
    }

    public function logoff() {
        session_destroy();
        $this->config->encode('Se ha cerrado sesión correctamente.', './?user=login', 'success',);
        exit();
    }

    public function signup() {
        $titulo = 'Registrate y explora tu nuevo hogar';
        include './views/users/signup_user.php';
    }

    public function signin() {
        $pageSignUp = './?user=signup';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dni = $_POST['dni'];
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $contrasenia = $_POST['contrasenia'];

            $dniError = $this->userModel->verifyDNI($dni);
            if ($dniError) $this->config->encode($dniError, $pageSignUp, 'danger');

            $correoError = $this->userModel->verifyEmail($correo);
            if ($correoError) $this->config->encode($correoError, $pageSignUp, 'danger');

            $result = $this->userModel->createUser($dni, $nombre, $apellidos, $correo, $telefono, $contrasenia);
            if ($result) {
                $this->config->encode('Se te ha registrado correctamente, por favor inicia sesión', './?user=login', 'success');
                exit();
            } else {
                $this->config->encode($result, $pageSignUp, 'success');
            }
        } else {
            header("Location: $pageSignUp");
        }
    }
}
