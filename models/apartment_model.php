<?php
require_once './models/database.php';

class apartment_model {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function createApartment($apartmentData) {
        $consulta = "INSERT INTO pisos (id_usuario, habitaciones, aseos, metros, planta, precio, descripcion, municipio, calle, numero_calle, codigo_postal, imagen)";

        if ($apartmentData['planta'] === null) {
            $consulta .= " VALUES (:id_usuario, :habitaciones, :aseos, :metros, NULL, :precio, :descripcion, :municipio, :calle, :numero_calle, :codigo_postal, :imagen)";
            unset($apartmentData['planta']);
        } else {
            $consulta .= " VALUES (:id_usuario, :habitaciones, :aseos, :metros, :planta, :precio, :descripcion, :municipio, :calle, :numero_calle, :codigo_postal, :imagen)";
        }

        try {
            $stmt = $this->db->connect()->prepare($consulta);

            return $stmt->execute($apartmentData);
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function updateApartment($apartmentData) {
        $consulta = "UPDATE pisos SET
        id_usuario = :id_usuario, habitaciones = :habitaciones, aseos = :aseos, metros = :metros, ";

        if ($apartmentData['planta'] === null) {
            $consulta .= " planta = NULL";
            unset($apartmentData['planta']);
        } else {
            $consulta .= " planta = :planta";
        }

        $consulta .= ", precio = :precio, descripcion = :descripcion, municipio = :municipio, calle = :calle, numero_calle = :numero_calle, codigo_postal = :codigo_postal, imagen = :imagen, estado = 'EN VENTA' WHERE id_piso = :id_piso";

        try {
            $stmt = $this->db->connect()->prepare($consulta);
            return $stmt->execute($apartmentData);
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function restoredApartment($id_piso) {
        $consulta = "UPDATE pisos SET estado = 'EN VENTA' WHERE id_piso = :id_piso";

        try {
            $stmt = $this->db->connect()->prepare($consulta);
            $stmt->bindParam(':id_piso', $id_piso);
            return $stmt->execute();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function archivedApartment($id_piso) {
        $consulta = "UPDATE pisos SET estado = 'RETIRADO' WHERE id_piso = :id_piso";

        try {
            $stmt = $this->db->connect()->prepare($consulta);
            $stmt->bindParam(':id_piso', $id_piso);
            return $stmt->execute();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function addHistoryArchived($id_piso, $empleado) {
        $consulta = "INSERT INTO historial_retiro_pisos (id_piso, empleado) VALUES (:id_piso, :empleado)";

        try {
            $stmt = $this->db->connect()->prepare($consulta);
            $stmt->bindParam(':id_piso', $id_piso);
            $stmt->bindParam(':empleado', $empleado);

            return $stmt->execute();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function deleteApartment($id_piso) {
        $consulta = "DELETE FROM pisos WHERE id_piso = :id_piso";

        try {
            $stmt = $this->db->connect()->prepare($consulta);
            $stmt->bindParam(':id_piso', $id_piso);

            return $stmt->execute();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function paidApartment($id_usuario_comprador, $id_piso) {
        $consulta = "INSERT INTO transacciones (id_usuario_comprador, id_piso) VALUES (:id_usuario_comprador, :id_piso)";
        try {
            $stmt = $this->db->connect()->prepare($consulta);
            $stmt->bindParam(':id_usuario_comprador', $id_usuario_comprador);
            $stmt->bindParam(':id_piso', $id_piso);

            return $stmt->execute();
        } catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function showAllUserApartment($id_usuario, $estado) {
        $consulta = "SELECT pisos.*, municipios.nombre_municipio AS nombre_municipio, historial_retiro_pisos.id_retiro, historial_retiro_pisos.mensaje,
        CASE
            WHEN configuracion.id_configuracion IS NOT NULL THEN 'Administrador'
            ELSE 'Desconocido'
        END AS retirador
        FROM pisos
        JOIN municipios ON pisos.municipio = municipios.id_municipio
        LEFT JOIN historial_retiro_pisos ON pisos.id_piso = historial_retiro_pisos.id_piso
        LEFT JOIN configuracion ON historial_retiro_pisos.empleado = configuracion.id_configuracion
        WHERE pisos.id_usuario = :id_usuario AND pisos.estado = :estado";

        try {
            $stmt = $this->db->connect()->prepare($consulta);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
            $stmt->execute();

            $pisos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }

        return $pisos;
    }

    public function showApartmentPrice($id_piso) {
        $consulta = "SELECT precio FROM pisos WHERE id_piso = :id_piso";

        try {
            $stmt = $this->db->connect()->prepare($consulta);
            $stmt->bindParam(":id_piso", $id_piso, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function showOneApartment($id_piso) {
        $consulta = "SELECT pisos.*,
        municipios.nombre_municipio AS nombre_municipio,
        usuarios.id_usuario AS id_propietario,
        usuarios.nombre AS nombre_propietario,
        usuarios.apellidos AS apellidos_propietario
        FROM pisos
        JOIN municipios ON pisos.municipio = municipios.id_municipio
        JOIN usuarios ON pisos.id_usuario = usuarios.id_usuario WHERE id_piso = :id_piso";

        try {
            $stmt = $this->db->connect()->prepare($consulta);
            $stmt->bindParam(':id_piso', $id_piso, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function showAllPurchased($id_usuario) {
        $consulta = "SELECT pisos.*,
        municipios.nombre_municipio AS nombre_municipio,
        usuarios.nombre AS nombre_propietario,
        usuarios.apellidos AS apellidos_propietario
        FROM pisos
        JOIN municipios ON pisos.municipio = municipios.id_municipio
        JOIN usuarios ON pisos.id_usuario = usuarios.id_usuario
        JOIN transacciones ON pisos.id_piso = transacciones.id_piso
        WHERE transacciones.id_usuario_comprador = :id_usuario";

        try {
            $stmt = $this->db->connect()->prepare($consulta);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function showAllForSale($filter, $start, $limit, $estado) {
        $consulta = "SELECT pisos.*, municipios.nombre_municipio AS nombre_municipio, historial_retiro_pisos.id_retiro, historial_retiro_pisos.mensaje,
        CASE
            WHEN configuracion.id_configuracion IS NOT NULL THEN 'Administrador'
            ELSE 'Desconocido'
        END AS retirador
        FROM pisos
        JOIN municipios ON pisos.municipio = municipios.id_municipio
        LEFT JOIN historial_retiro_pisos ON pisos.id_piso = historial_retiro_pisos.id_piso
        LEFT JOIN configuracion ON historial_retiro_pisos.empleado = configuracion.id_configuracion
        WHERE pisos.estado = :estado";

        try {
            if (!empty($filter)) {
                $filterArray = explode(' ', $filter);
                $filter = array(
                    'municipio' => isset($filterArray[0]) ? '%' . $filterArray[0] . '%': '',
                    'calle' => isset($filterArray[1]) ? '%' . $filterArray[1] . '%' : '',
                    'habitaciones' => isset($filterArray[2]) ? (int)$filterArray[2] : 0,
                    'aseos' => isset($filterArray[3]) ? (int)$filterArray[3] : 0,
                );

                if (!empty($filter['municipio'])) $consulta .= " AND nombre_municipio LIKE LOWER(:municipio)";
                if (!empty($filter['calle'])) $consulta .= " AND calle LIKE LOWER(:calle)";
                if (!empty($filter['habitaciones'])) $consulta .= " AND habitaciones >= :habitaciones";
                if (!empty($filter['aseos'])) $consulta .= " AND aseos >= :aseos";
            }

            $consulta .= " LIMIT :start, :limit";

            $stmt = $this->db->connect()->prepare($consulta);
            if (!empty($filter)) {
                $stmt->bindParam(':calle', $filter['calle'], PDO::PARAM_STR);
                $stmt->bindParam(':municipio', $filter['municipio'], PDO::PARAM_STR);
                $stmt->bindParam(':habitaciones', $filter['habitaciones'], PDO::PARAM_INT);
                $stmt->bindParam(':aseos', $filter['aseos'], PDO::PARAM_INT);
            }
            $stmt->bindParam(':start', $start, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
            $stmt->execute();

            $apartments = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $apartments;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function municipiosApartment() {
        $consulta = "SELECT * FROM municipios";

        try {
            $stmt = $this->db->connect()->prepare($consulta);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getNumPisos() {
        $consulta = "SELECT COUNT(*) as numero_filas FROM pisos";

        try {
            $stmt = $this->db->connect()->query($consulta);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            return $resultado['numero_filas'];
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
?>
