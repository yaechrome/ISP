<?php
include_once '../bd/ClasePDO.php';
include_once '../dto/Particular.php';
include_once 'BaseDao.php';
include_once 'ParticularDao.php';

class ParticularDaoImp implements ParticularDao{
    
    public function buscarPorClavePrimaria($id) {
         try {
            $particular = null;
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("select * from particular where codigoParticular=?");
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $registro = $stmt->fetchAll();
            foreach ($registro as $value) {
                $particular = new Particular();
                $particular->setCodigo($value["codigoParticular"]);
                $particular->setRut($value["rutParticular"]);
                $particular->setPassword($value["passwordParticular"]);
                $particular->setNombre($value["nombreParticular"]);
                $particular->setDireccion($value["direccionParticular"]);
                $particular->setEmail($value["emailParticular"]);
                $particular->setEstado($value["estado"]);

            }

            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al buscar particular " . $exc->getMessage();
        }
        return $particular;
    }

    public function buscarPorRutParticular($rut) {
        try {
            $particular = null;
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("select * from particular where rutParticular=?");
            $stmt->bindValue(1, $rut);
            $stmt->execute();
            $registro = $stmt->fetchAll();
            foreach ($registro as $value) {
                $particular = new Particular();
                $particular->setCodigo($value["codigoParticular"]);
                $particular->setRut($value["rutParticular"]);
                $particular->setPassword($value["passwordParticular"]);
                $particular->setNombre($value["nombreParticular"]);
                $particular->setDireccion($value["direccionParticular"]);
                $particular->setEmail($value["emailParticular"]);
                $particular->setEstado($value["estado"]);

            }

            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al buscar particular " . $exc->getMessage();
        }
        return $particular;
    }

    public function crear($dto) {
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("INSERT INTO particular ( rutParticular, passwordParticular,"
                    . "nombreParticular, direccionParticular, emailParticular) VALUES(?,?,?,?,?");

            $stmt->bindValue(1, $dto->getRut());
            $stmt->bindValue(2, $dto->getPassword());
            $stmt->bindValue(3, $dto->getNombre());
            $stmt->bindValue(4, $dto->getDireccion());
            $stmt->bindValue(5, $dto->getEmail());

            
            $stmt->execute();
            if ($stmt->rowCount() > 0)
                return TRUE;
            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al agregar " . $exc->getMessage();
        }
        return FALSE;
        
    }

    public function darDeBaja($codigoParticular) {
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("update particular set estado=Inactivo where codigoParticular=?");

            $stmt->bindValue(1, $codigoParticular);

            $stmt->execute();
            if ($stmt->rowCount() > 0)
                return TRUE;
            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al modificar estado de Particular" . $exc->getMessage();
        }
        return FALSE;
    }

    public function listar() {
        try {
            $lista = new ArrayObject();
            $pdo = new clasePDO();
            $stmt= $pdo->prepare("select * from particular");
            $stmt->execute();
            
            $resultado= $stmt->fetchAll();
            foreach ($resultado as $value) {
                $particular = new Particular();
                $particular->setCodigo($value["codigoParticular"]);
                $particular->setRut($value["rutParticular"]);
                $particular->setPassword($value["passwordParticular"]);
                $particular->setNombre($value["nombreParticular"]);
                $particular->setDireccion($value["direccionParticular"]);
                $particular->setEmail($value["emailParticular"]);
                $particular->setEstado($value["estado"]);

                $lista->append($particular);
            }
            
            $pdo=NULL;     
            
        } catch (Exception $exc) {
            echo "Error dao al listar particulares ".$exc->getMessage();
        }
        return $lista;
    }

    public function modificar($dto) {
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("update particular set rutParticular=?, passwordParticular=?,"
                    . "nombreParticular=?, direccionParticular=?, emailParticular=? where codigoParticular=?");
            
            $stmt->bindValue(1, $dto->getRut());
            $stmt->bindValue(2, $dto->getPassword());
            $stmt->bindValue(3, $dto->getNombre());
            $stmt->bindValue(4, $dto->getDireccion());
            $stmt->bindValue(5, $dto->getEmail());
            $stmt->bindValue(6, $dto->getCodigo());

            $stmt->execute();
            if ($stmt->rowCount() > 0)
                return TRUE;
            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al modificar Particular" . $exc->getMessage();
        }
        return FALSE;
    }

}
