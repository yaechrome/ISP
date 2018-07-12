<?php
include_once '../bd/ClasePDO.php';
include_once '../dto/Empleado.php';
include_once '../dto/AnalisisMuestras.php';
include_once '../dto/ResultadoAnalisis.php';
include_once '../dto/TipoAnalisis.php';
include_once '../dao/TipoAnalisisDaoImp.php';
include_once '../dao/AnalisisMuestraDaoImp.php';
include_once '../dao/EmpleadoDaoImp.php';
include_once 'BaseDao.php';
include_once 'ResultadoAnalisisDao.php';
include_once '../dto/AnalisisMuestras.php';
include_once '../dto/AnalisisXTecnico.php';

class ResultadoAnalisisDaoImp implements ResultadoAnalisisDao{
    
    public function buscarPorClavePrimaria($id) {
       $analisisMuestra = NULL;
        try {
            $pdo= new clasePDO();
            $stmt = $pdo->prepare("select analisismuestras.idAnalisisMuestras as id, analisismuestras.estado,"
                    . " resultadoanalisis.rutEmpleadoAnalista from resultadoanalisis join analisismuestras "
                    . "on(resultadoanalisis.idAnalisisMuestras=analisismuestras.idAnalisisMuestras) "
                    . "where analisismuestras.idAnalisisMuestras=?");
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            foreach ($resultado as $value) {
                $analisisMuestra =new AnalisisXTecnico();
                
                             
                $analisisMuestra->setId($value["id"]);
                $analisisMuestra->setEstado($value["estado"]);
                $analisisMuestra->setTecnico($value["rutEmpleadoAnalista"]);
                
            }
            $pdo=NULL;
        } catch (Exception $exc) {
            echo "Error dao al buscar Analisis de muestra por clave primaria ".$exc->getMessage();
        }
        return $analisisMuestra;
    }

    public function crear($dto) {
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("INSERT INTO resultadoanalisis(idTipoAnalisis, idAnalisisMuestras, rutEmpleadoAnalista) VALUES(?,?,?)");

            $stmt->bindValue(1, $dto->getTipoAnalisis()->getId());
            $stmt->bindValue(2, $dto->getAnalisisMuestra()->getId());
            $stmt->bindValue(3, $dto->getEmpleado()->getRut());
            
            $stmt->execute();
            if ($stmt->rowCount() > 0)
                return TRUE;
            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al agregar Resultado Analisis" . $exc->getMessage();
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
            $stmt = $pdo->prepare("select * from ResultadoAnalisis where idAnalisisMuestras=?");
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $registro = $stmt->fetchAll();
            $tipoAnalisis = new TipoAnalisis();
            $tipoAnalisisDao = new TipoAnalisisDaoImp();
            $analisisMuestra = new AnalisisMuestras();
            $analisisMuestraDao = new AnalisisMuestraDaoImp();
            $empleado = new Empleado();
            $empleadoDao = new EmpleadoDaoImp();
            foreach ($registro as $value) {
                
                $tipoAnalisis = $tipoAnalisisDao->buscarPorClavePrimaria($value["idTipoAnalisis"]);

                $analisisMuestra = $analisisMuestraDao->buscarPorClavePrimaria($value["idAnalisisMuestras"]);

                $empleado = $empleadoDao->buscarPorClavePrimaria($value["rutEmpleadoAnalista"]);
                
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
            echo "Error dao al listar Resultado analisis por ID de Muestra" . $exc->getMessage();
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

    public function reporteAnalisisXTecnico() {
        $lista = new ArrayObject();
        try {
            $pdo= new clasePDO();
            $stmt = $pdo->prepare("select rutEmpleadoAnalista, nombreEmpleado, count(rutEmpleadoAnalista) as cantidad from resultadoanalisis join empleado on (empleado.rutEmpleado = resultadoanalisis.rutEmpleadoAnalista)");
            
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            foreach ($resultado as $value) {
                $reporte = new Reporte();             
                $reporte->setRut($value["rutEmpleadoAnalista"]);
                $reporte->setNombre($value["nombreEmpleado"]);
                $reporte->setCantidad($value["cantidad"]);
                $lista->append($reporte);
            }
            $pdo=NULL;
        } catch (Exception $exc) {
            echo "Error dao al buscar reporte de analisis ".$exc->getMessage();
        }
        return $lista;
    }

    public function buscarAnalisisPorTecnico($rut) {
        try {
            $lista = new ArrayObject();
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("select Distinct resultadoanalisis.idAnalisisMuestras as id, analisismuestras.estado, "
                    . "resultadoanalisis.rutEmpleadoAnalista from resultadoanalisis join analisismuestras "
                    . "on(resultadoanalisis.idAnalisisMuestras=analisismuestras.idAnalisisMuestras) "
                    . "where rutEmpleadoAnalista = ?");

            $stmt->bindValue(1, $rut);
            $stmt->execute();
            $registro = $stmt->fetchAll();
            foreach ($registro as $value) {
                $analisis = new AnalisisXTecnico();
                $analisis->setId($value["id"]);
                $analisis->setEstado($value["estado"]);
                
                $lista->append($analisis);
            }

            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al listar telefonos por código de Particular" . $exc->getMessage();
        }
        return $lista;
    }

}
