<?php

include_once '../bd/ClasePDO.php';
include_once '../dto/TipoAnalisis.php';
include_once 'TipoAnalisisDao.php';

class TipoAnalisisDaoImp implements TipoAnalisisDao {

    public function buscarPorClavePrimaria($id) {
        $tipoAnalisis = new TipoAnalisis();
        try {

            $pdo = new clasePDO();
            $stmt = $pdo->prepare("select * from tipoanalisis where idTipoAnalisis=?");
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $registro = $stmt->fetchAll();

            echo $registro;
            foreach ($registro as $value) {

           echo json_encode($value);
           echo json_encode($value["idTipoAnalisis"]);
                $tipoAnalisis->setId($value["idTipoAnalisis"]);
                
                $tipoAnalisis->setNombre($value["nombre"]);
            }

            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al buscar Tipo de analisis " . $exc->getMessage();
        }
        return $tipoAnalisis;
    }

    public function listar() {
        try {
            $lista = new ArrayObject();
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("select * from tipoanalisis");
            $stmt->execute();

            $tipos = $stmt->fetchAll();
            foreach ($tipos as $value) {
                $tipoAnalisis = new TipoAnalisis();
                $tipoAnalisis->setId($value["idTipoAnalisis"]);
                $tipoAnalisis->setNombre($value["nombre"]);

                $lista->append($tipoAnalisis);
            }

            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al listar tipos de analisis " . $exc->getMessage();
        }
        return $lista;
    }

    public function eliminar($id) {
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("delete from tipoanalisis where idTipoAnalisis = ?");

            $stmt->bindValue(1, $id);
            $stmt->execute();
            if ($stmt->rowCount() > 0)
                return TRUE;
            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al eliminar Tipo de analisis" . $exc->getMessage();
        }
        return FALSE;
    }

    public function existeRegistro($nombre) {
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("SELECT * FROM tipoanalisis WHERE nombre=?");
            $stmt->bindParam(1, $nombre);
            $stmt->execute();

            if (count($stmt->fetchAll()) > 0) {
                return TRUE;
            }
            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al validar tipo de analisis " . $exc->getMessage();
        }
        return FALSE;
    }

    public function crear($nombre) {
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("INSERT INTO tipoanalisis (nombre) VALUES(?)");

            $stmt->bindValue(1, $nombre);

            $stmt->execute();
            if ($stmt->rowCount() > 0)
                return TRUE;
            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al agregar tipo de analisis " . $exc->getMessage();
        }
        return FALSE;
    }

}
