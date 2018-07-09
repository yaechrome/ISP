<?php
include_once '../bd/ClasePDO.php';
include_once '../dto/ResultadoAnalisis.php';
include_once 'BaseDao.php';
include_once 'ResultadoAnalisisDao.php';

class ResultadoAnalisisDaoImp implements ResultadoAnalisisDao{
    
    public function buscarPorClavePrimaria($id) {
       //se reemplaza por listarPorIdAnalisisMuestra
    }

    public function crear($dto) {
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("INSERT INTO resultadoanalisis(idTipoAnalisis, idAnalisisMuestra) VALUES(?,?");

            $stmt->bindValue(1, $dto->getTipoAnalisis()->getId());
            $stmt->bindValue(2, $dto->getAnalisisMuestra()->getId());
            
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
            $stmt= $pdo->prepare("select * from resultadoanalisis");
            $stmt->execute();
            
            $resultado= $stmt->fetchAll();
            foreach ($resultado as $value) {
                $tipoAnalisis = new TipoAnalisis();
                $tipoAnalisisDao = new TipoAnalisisDaoImp();
                $tipoAnalisis = $tipoAnalisisDao->buscarPorClavePrimaria($value["idTipoAnalisis"]);
                
                $analisisMuestra = new AnalisisMuestras();
                $analisisMuestraDao = new AnalisisMuestraDaoImp();
                $analisisMuestra = $analisisMuestraDao->buscarPorClavePrimaria($value["idAnalisisMuestra"]);
               
                $empleado = new Empleado();
                $empleadoDao = new EmpleadoDaoImp();
                $empleado->$empleadoDao->buscarPorClavePrimaria($value["rutEmpleadoAnalista"]);
                
                $resultadoAnalisis = new ResultadoAnalisis();
                $resultadoAnalisis->setTipoAnalisis($tipoAnalisis);
                $resultadoAnalisis->setAnalisisMuestra($analisisMuestra);               
                $resultadoAnalisis->setFechaRegistro($value["fechaRegistro"]);
                $resultadoAnalisis->setPpm($value["PPM"]);
               
                $resultadoAnalisis->setEmpleado($empleado);

                $lista->append($resultadoAnalisis);
            }
            
            $pdo=NULL;     
            
        } catch (Exception $exc) {
            echo "Error dao al listar resultados de analisis ".$exc->getMessage();
        }
        return $lista;
    }

    public function listarPorIdAnalisisMuestra($id) {
        try {
            $lista = new ArrayObject();
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("select * from resultadoanalisis where idAnalisisMuestra=?");
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $registro = $stmt->fetchAll();
            foreach ($registro as $value) {
                $tipoAnalisis = new TipoAnalisis();
                $tipoAnalisisDao = new TipoAnalisisDaoImp();
                $tipoAnalisis = $tipoAnalisisDao->buscarPorClavePrimaria($value["idTipoAnalisis"]);
                
                $analisisMuestra = new AnalisisMuestras();
                $analisisMuestraDao = new AnalisisMuestraDaoImp();
                $analisisMuestra = $analisisMuestraDao->buscarPorClavePrimaria($value["idAnalisisMuestra"]);
               
                $empleado = new Empleado();
                $empleadoDao = new EmpleadoDaoImp();
                $empleado->$empleadoDao->buscarPorClavePrimaria($value["rutEmpleadoAnalista"]);
                
                $resultadoAnalisis = new ResultadoAnalisis();
                $resultadoAnalisis->setTipoAnalisis($tipoAnalisis);
                $resultadoAnalisis->setAnalisisMuestra($analisisMuestra);               
                $resultadoAnalisis->setFechaRegistro($value["fechaRegistro"]);
                $resultadoAnalisis->setPpm($value["PPM"]);
                
                $resultadoAnalisis->setEmpleado($empleado);

                $lista->append($resultadoAnalisis);
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
            $stmt = $pdo->prepare("update resultadoanalisis set fechaRegistro=now(), rutEmpleadoAnalista=?  where idAnalisisMuestra=? and idTipoAnalisis =?");

            
            $stmt->bindValue(1, $dto->getEmpleado()->getRut());
            $stmt->bindValue(2, $dto->getAnalisisMuestra()->getId());
            $stmt->bindValue(2, $dto->getTipoAnalisis()->getId());
            

            $stmt->execute();
            if ($stmt->rowCount() > 0)
                return TRUE;
            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al modificar estado de resultado de analisis" . $exc->getMessage();
        }
        return FALSE;
    }

    public function reporteAnalisisXTecnico($rut) {
        
    }

}
