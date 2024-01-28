<?php
include_once './models/admin_model.php';
class contact_controller {
    private $adminModel;

    public function __construct() {
        $this->adminModel = new admin_model();
    }

    public function config() {
        $result = $this->adminModel->configAdmin();
        return $result['admin'];
    }

    public function info() {
        $titulo = 'Para más información contáctanos';
        include './includes/contact.php';
    }
}
?>
