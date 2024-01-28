<?php
require_once './models/database.php';

class admin_model {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function configAdmin() {
        $consulta = "SELECT telefono_contacto, email_contacto, direccion_oficina, mapa_embedded FROM configuracion";
        try {
            $stmt = $this->db->connect()->prepare($consulta);
            $stmt->execute();

            $admin = $stmt->fetch(PDO::FETCH_ASSOC);

            return ['status' => 'success', 'admin' => $admin];
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function updateConfig($settingsData) {
        $consulta = "UPDATE configuracion SET telefono_contacto = :telefono_contacto, email_contacto = :email_contacto,
        direccion_oficina = :direccion_oficina, mapa_embedded = :mapa_embedded";
        try {
            $stmt = $this->db->connect()->prepare($consulta);
            return $stmt->execute($settingsData);
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function updateAdmin($accountData) {
        $consulta = "UPDATE configuracion SET email_administrador = :email_administrador,
        password_administrador = :password_administrador";
        try {
            $stmt = $this->db->connect()->prepare($consulta);
            return $stmt->execute($accountData);
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function loginAdmin($email_administrador, $password_administrador) {
        $consulta = "SELECT * FROM configuracion WHERE email_administrador = :email_administrador";
        try {
            $stmt = $this->db->connect()->prepare($consulta);
            $stmt->bindParam(':email_administrador', $email_administrador);
            $stmt->execute();

            $admin = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($admin && password_verify($password_administrador, $admin['password_administrador'])) {
                return ['status' => 'success', 'admin' => $admin];
            }
            return ['status' => 'failure', 'message' => 'El correo o contraseña del administrador es incorrecto.'];
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}
?>
