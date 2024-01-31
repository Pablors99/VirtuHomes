<?php
require_once './models/database.php';

class user_model {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function createUser($dni, $nombre, $apellidos, $correo, $telefono, $contrasenia) {
        $hashedPassword = password_hash($contrasenia, PASSWORD_DEFAULT);
        $consulta = "INSERT INTO usuarios (dni, nombre, apellidos, correo, telefono, contrasenia) VALUES (:dni, :nombre, :apellidos, :correo, :telefono, :contrasenia)";
        try {
            $stmt = $this->db->connect()->prepare($consulta);
            $stmt->bindParam(':dni', $dni);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellidos', $apellidos);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':contrasenia', $hashedPassword);

            return $stmt->execute();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function updateUser($id_usuario, $nombre, $apellidos, $correo, $telefono, $contrasenia) {
        $hashedPassword = password_hash($contrasenia, PASSWORD_DEFAULT);
        $consulta = "UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, correo = :correo,
        telefono = :telefono, contrasenia = :contrasenia WHERE id_usuario = :id_usuario";
        try {
            $stmt = $this->db->connect()->prepare($consulta);
            $stmt->bindParam(':id_usuario', $id_usuario);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellidos', $apellidos);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':contrasenia', $hashedPassword);

            return $stmt->execute();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function loginUser($correo, $contrasenia) {
        $consulta = "SELECT * FROM usuarios WHERE correo = :correo";
        try {
            $stmt = $this->db->connect()->prepare($consulta);
            $stmt->bindParam(':correo', $correo);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($contrasenia, $user['contrasenia'])) {
                return ['status' => 'success', 'user' => $user];
            }
            return ['status' => 'failure', 'message' => 'Correo no encontrado o contraseña incorrecta'];
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function verifyDNI($dni) {
        $consulta = "SELECT * FROM usuarios WHERE dni = :dni";
        try {
            $stmt = $this->db->connect()->prepare($consulta);
            $stmt->bindParam(':dni', $dni);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return "Error: Se ha comprobado que el DNI coincide con uno ya registrado.";
            }

            return null;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function verifyEmail($correo) {
        try {
            $query = "SELECT * FROM usuarios WHERE correo = :correo";
            $stmt = $this->db->connect()->prepare($query);
            $stmt->bindParam(':correo', $correo);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return "Error: Se ha comprobado que el correo electrónico coincide con uno ya registrado.";
            }
            return null;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
?>
