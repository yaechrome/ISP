<?php
include_once '../bd/ClasePDO.php';
include_once '../dto/Empresa.php';
include_once 'BaseDao.php';
include_once 'EmpresaDao.php';

class EmpresaDaoImp implements EmpresaDao{
    
    public function buscarPorClavePrimaria($id) {
        try {
            $empresa = null;
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("select * from empresa where codigoEmpresa=?");
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $registro = $stmt->fetchAll();
            foreach ($registro as $value) {
                $empresa = new Empresa();
                $empresa->setCodigo($value["codigoEmpresa"]);
                $empresa->setRut($value["rutEmpresa"]);
                $empresa->setPassword($value["passwordEmpresa"]);
                $empresa->setNombre($value["nombreEmpresa"]);
                $empresa->setDireccion($value["direccionEmpresa"]);
                $empresa->setEstado($value["estado"]);

            }

            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al buscar empresa " . $exc->getMessage();
        }
        return $empresa;
    }

    public function buscarPorRutEmpresa($rut) {
        try {
            $particular = null;
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("select * from empresa where rutEmpresa=?");
            $stmt->bindValue(1, $rut);
            $stmt->execute();
            $registro = $stmt->fetchAll();
            foreach ($registro as $value) {
                $empresa = new Empresa();
                $empresa->setCodigo($value["codigoEmpresa"]);
                $empresa->setRut($value["rutEmpresa"]);
                $empresa->setPassword($value["passwordEmpresa"]);
                $empresa->setNombre($value["nombreEmpresa"]);
                $empresa->setDireccion($value["direccionEmpresa"]);
                $empresa->setEstado($value["estado"]);

            }

            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al buscar empresa " . $exc->getMessage();
        }
        return $empresa;
    }

    public function crear($dto) {
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("INSERT INTO empresa ( rutEmpresa, passwordEmpresa,"
                    . "nombreEmpresa, direccionEmpresa) VALUES(?,?,?,?");

            $stmt->bindValue(1, $dto->getRut());
            $stmt->bindValue(2, $dto->getPassword());
            $stmt->bindValue(3, $dto->getNombre());
            $stmt->bindValue(4, $dto->getDireccion());

            $stmt->execute();
            if ($stmt->rowCount() > 0)
                return TRUE;
            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al agregar " . $exc->getMessage();
        }
        return FALSE;
    }

    public function darDeBaja($codigoEmpresa) {
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("update empresa set estado=Inactivo where codigoEmpresa=?");

            $stmt->bindValue(1, $codigoEmpresa);

            $stmt->execute();
            if ($stmt->rowCount() > 0)
                return TRUE;
            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al modificar estado de Empresa" . $exc->getMessage();
        }
        return FALSE;
    }

    public function listar() {
        try {
            $lista = new ArrayObject();
            $pdo = new clasePDO();
            $stmt= $pdo->prepare("select * from empresa");
            $stmt->execute();
            
            $resultado= $stmt->fetchAll();
            foreach ($resultado as $value) {
                $empresa = new Empresa();
                $empresa->setCodigo($value["codigoEmpresa"]);
                $empresa->setRut($value["rutEmpresa"]);
                $empresa->setPassword($value["passwordEmpresa"]);
                $empresa->setNombre($value["nombreEmpresa"]);
                $empresa->setDireccion($value["direccionEmpresa"]);
                $empresa->setEstado($value["estado"]);

                $lista->append($empresa);
            }
            
            $pdo=NULL;     
            
        } catch (Exception $exc) {
            echo "Error dao al listar Empresas ".$exc->getMessage();
        }
        return $lista;
    }

    public function modificar($dto) {
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("update particular set rutEmpresa=?, passwordEmpresa=?,"
                    . "nombreEmpresa=?, direccionEmpresa=? where codigoEmpresa=?");
            
            $stmt->bindValue(1, $dto->getRut());
            $stmt->bindValue(2, $dto->getPassword());
            $stmt->bindValue(3, $dto->getNombre());
            $stmt->bindValue(4, $dto->getDireccion());
            $stmt->bindValue(5, $dto->getCodigo());

            $stmt->execute();
            if ($stmt->rowCount() > 0)
                return TRUE;
            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al modificar Empresa" . $exc->getMessage();
        }
        return FALSE;
    }

}
