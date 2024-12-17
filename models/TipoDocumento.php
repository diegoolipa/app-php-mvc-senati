<?php
class TipoDocumento
{
    private $conn;
    public $id_tipodocumento;
    public $nombre;
    public $sigla;
    public $orden;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function listar()
    {
        $query = "select * from tipo_documento order by fecha_creacion desc";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function crear()
    {
        $query = "INSERT INTO tipo_documento  
                (nombre, sigla, orden) 
                VALUES (:nombre, :sigla, :orden)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':sigla', $this->sigla);
        $stmt->bindParam(':orden', $this->orden);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function actualizar()
    {
        $query = "UPDATE tipo_documento 
                SET nombre = :nombre, 
                    sigla = :sigla, 
                    orden = :orden 
                WHERE id_tipodocumento = :id_tipodocumento";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':sigla', $this->sigla);
        $stmt->bindParam(':orden', $this->orden);
        $stmt->bindParam(':id_tipodocumento', $this->id_tipodocumento);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function eliminar()
    {
        $query = "DELETE FROM tipo_documento WHERE id_tipodocumento = :id_tipodocumento";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_tipodocumento', $this->id_tipodocumento);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function buscar($palabra)
    {
        $query = "SELECT * FROM tipo_documento
                 WHERE nombre LIKE :nombre 
                 ORDER BY name ASC";
        $term = "%{$palabra}%";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $term);
        $stmt->execute();
        return $stmt;
    }
}
