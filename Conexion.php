<?php

class ConexionBD {
    private $conexion;

    // Constructor para establecer la conexión
    public function __construct($host, $usuario, $contrasena, $base_de_datos) {
        try {
            $this->conexion = new PDO("mysql:host=$host;dbname=$base_de_datos", $usuario, $contrasena);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    // Método para ejecutar consultas
    public function ejecutarConsulta($consulta) {
        try {
            $stmt = $this->conexion->query($consulta);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error al ejecutar la consulta: " . $e->getMessage());
        }
    }

    // Método para cerrar la conexión
    public function cerrarConexion() {
        $this->conexion = null;
    }
}
?>
