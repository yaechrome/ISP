<?php
include_once '../bd/ClasePDO.php';
include_once '../dto/Telefono.php';
include_once '../dto/Usuario.php';
include_once 'UsuarioDaoImp.php';
include_once 'BaseDao.php';
include_once 'TelefonoDao.php';

class TelefonoDaoImp implements TelefonoDao{
    
    public function buscarPorClavePrimaria($id) {
        $telefono = new Telefono();
        try {
            $pdo= new clasePDO();
            $stmt = $pdo->prepare("SELECT * FROM telefono WHERE id=?");
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            foreach ($resultado as $value) {
                $particular = new Usuario();
                $particularDao = new UsuarioDaoImp();
                $particular = $particularDao->buscarPorClavePrimaria($value["codigoParticular"]);
                $telefono->setId($value["id"]);
                $telefono->setDescripcion($value["numeroTelefono"]);               
                $telefono->setParticular($particular);
            }
            $pdo=NULL;
        } catch (Exception $exc) {
            echo "Error dao al buscar telefono por clave primaria ".$exc->getMessage();
        }
        return $telefono;
    }

    public function crear($dto) {
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("INSERT INTO telefono(numeroTelefono, codigoParticular) VALUES(?,?)");

            $stmt->bindValue(1, $dto->getNumero());
            $stmt->bindValue(2, $dto->getParticular()->getCodigo());
            $stmt->execute();
            if ($stmt->rowCount() > 0)
                return TRUE;
            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al agregar " . $exc->getMessage();
        }
        return FALSE;
    }

    public function listar() {
        try {
            $lista = new ArrayObject();
            $pdo = new clasePDO();
            $stmt= $pdo->prepare("select * from telefono");
            $stmt->execute();
            
            $resultado= $stmt->fetchAll();
            foreach ($resultado as $value) {
                $particular = new Usuario();
                $particularDao = new UsuarioDaoImp();
                $particular->particularDao->buscarPorClavePrimaria($value["codigoParticular"]);
                $telefono->setId($value["id"]);
                $telefono->setDescripcion($value["numeroTelefono"]);               
                $telefono->setParticular($particular);

                $lista->append($telefono);
            }
            
            $pdo=NULL;     
            
        } catch (Exception $exc) {
            echo "Error dao al listar telefonos ".$exc->getMessage();
        }
        return $lista;
    }

    public function listarPorCodigoParticular($codigoParticular) {
        try {
            $lista = null;
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("select * from telefono where codigoParticular=?");
            $stmt->bindValue(1, $codigoParticular);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $lista = new ArrayObject();
            }
            $registro = $stmt->fetchAll();
            
            foreach ($registro as $value) {
                
                $telefono = new Telefono();
                $telefono->setId($value["id"]);
                $telefono->setNumero($value["numeroTelefono"]);               

                $lista->append($telefono);
            }

            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al listar telefonos por código de Particular" . $exc->getMessage();
        }
        return $lista;
    }

    public function modificar($dto) {
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("update telefono set numeroTelefono=?, "
                    . "codigoParticular=? where id=?");

            $stmt->bindValue(1, $dto->getnumero());
            $stmt->bindValue(2, $dto->getParticular()->getCodigo());
            $stmt->bindValue(3, $dto->getId());

            $stmt->execute();
            if ($stmt->rowCount() > 0)
                return TRUE;
            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al modificar telefono" . $exc->getMessage();
        }
        return FALSE;
    }

    public function eliminar($id) {
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("delete from telefono where id = ?");

            $stmt->bindValue(1, $id);
            $stmt->execute();
            if ($stmt->rowCount() > 0)
                return TRUE;
            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al eliminar " . $exc->getMessage();
        }
        return FALSE;
    }

}
