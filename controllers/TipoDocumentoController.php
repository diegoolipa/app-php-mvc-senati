<?php
class TipoDocumentoController
{
    private $db;
    private $tipoDocumento;

    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");

        $datebase = new Database();
        $this->db = $datebase->connect();
        $this->tipoDocumento = new TipoDocumento($this->db);
    }

    public function mostrarInterfaz()
    {
        include 'views/layouts/header.php'; //Siempre
        include 'views/tipo-documento/interfaz.php';
        include 'views/layouts/footer.php'; //Siempre
    }


    public function listar()
    {
        header('Content-Type: application/json');
        try {
            $resultado = $this->tipoDocumento->listar();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode([
                'status' => 'success',
                'data' => $data
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function guardar()
    {
        header('Content-Type: application/json');

        try {
            if (empty($_POST['nombre']) || empty($_POST['sigla']) || empty($_POST['orden'])) {
                throw new Exception('Los campos son requeridos');
            }

            $this->tipoDocumento->nombre = $_POST['nombre'];
            $this->tipoDocumento->sigla = $_POST['sigla'];
            $this->tipoDocumento->orden = $_POST['orden'];

            if ($this->tipoDocumento->crear()) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Producto registrado correctamente',
                ]);
            } else {
                throw new Exception('Error al registrar Producto');
            };
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function eliminar() {
        header('Content-Type: application/json');
        try {

            $data = json_decode(file_get_contents("php://input"));
            
            if (!isset($data->id_tipoDocumento)) {
                throw new Exception('id_tipoDocumento no proporcionado');
            }
            $this->tipoDocumento->id_tipodocumento = $data->id_tipoDocumento;

            if ($this->tipoDocumento->eliminar()) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Producto eliminado exitosamente'
                ]);
            } else {
                throw new Exception('Error al eliminar');
            }

        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
    public function actualizar() {
        header('Content-Type: application/json');
        try {
            if (empty($_POST['nombre']) || empty($_POST['sigla']) || empty($_POST['orden'])) {
                throw new Exception('Los campos son requeridos');
            }

            $this->tipoDocumento->id_tipodocumento = $_POST['id'];
            $this->tipoDocumento->nombre = $_POST['nombre'];
            $this->tipoDocumento->sigla = $_POST['sigla'];
            $this->tipoDocumento->orden = $_POST['orden'];

            if ($this->tipoDocumento->actualizar()) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Tipo Documento actualizado exitosamente'
                ]);
            } else {
                throw new Exception('Error al actualizar el producto');
            }

        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
