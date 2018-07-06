<?php
include_once '../bd/ClasePDO.php';
include_once '../dto/AnalisisMuestras.php';
include_once 'BaseDao.php';
include_once 'AnalisisMuestraDao.php';

class AnalisisMuestraDaoImp implements AnalisisMuestraDao{
    
    public function buscarPorClavePrimaria($id) {
        $analisisMuestra = NULL;
        try {
            $pdo= new clasePDO();
            $stmt = $pdo->prepare("SELECT * FROM analisismuestras WHERE idAnalisisMuestras=?");
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            foreach ($resultado as $value) {
                $analisisMuestra =new AnalisisMuestras();
                
                $particular = new Particular();
                $particularDao = new ParticularDaoImp();
                $particular = $particularDao->buscarPorClavePrimaria($value["Particular_codigoParticular"]);
                if($particular!=null){
                    $analisisMuestra->setParticular($particular);
                }
                
                $empresa = new Empresa();
                $empresaDao = new EmpresaDaoImp();
                $empresa = $empresaDao->buscarPorClavePrimaria($value["Empresa_codigoEmpresa"]);
                if($empresa!=null){
                    $analisisMuestra->setEmpresa($empresa);
                }
                
                $empleado = new Empleado();
                $empleadoDao = new EmpleadoDaoImp();
                $empleado = $empleadoDao->buscarPorClavePrimaria($value["rutEmpleadoRecibe"]);
                if($empleado!=null){
                    $analisisMuestra->setEmpleado($empleado);
                }
                
                $analisisMuestra->setId($value["idAnalisisMuestra"]);
                $analisisMuestra->setFechaRecepcion($value["fechaRecepcion"]);               
                $analisisMuestra->setTemperaturaRecepcion($value["temperaturaMuestra"]);
                $analisisMuestra->setCantidadMuestra($value["cantidadMuestra"]);
                
            }
            $pdo=NULL;
        } catch (Exception $exc) {
            echo "Error dao al buscar Analisis de muestra por clave primaria ".$exc->getMessage();
        }
        return $analisisMuestra;
    }


    public function buscarPorRutCliente($rut) {
        $analisisMuestra = NULL;
        try {
            $pdo= new clasePDO();
            $stmt = $pdo->prepare("SELECT * FROM analisismuestras WHERE ?=?");
            
            $particular = new Particular();
            $particularDao = new ParticularDaoImp();
            $particular = $particularDao->buscarPorClavePrimaria($rut);
            if($particular!=null){
                $stmt->bindParam(1, "Particular_codigoParticular");
            }else{
                $empresa = new Empresa();
                $empresaDao = new EmpresaDaoImp();
                $empresa = $empresaDao->buscarPorClavePrimaria($rut);
                if($empresa!=null){
                    $stmt->bindParam(1, "Empresa_codigoEmpresa");
                }
            }   
            $stmt->bindParam(2, $rut);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            foreach ($resultado as $value) {
                $analisisMuestra =new AnalisisMuestras();
                
                $particular = new Particular();
                $particularDao = new ParticularDaoImp();
                $particular = $particularDao->buscarPorClavePrimaria($value["Particular_codigoParticular"]);
                if($particular!=null){
                    $analisisMuestra->setParticular($particular);
                }
                
                $empresa = new Empresa();
                $empresaDao = new EmpresaDaoImp();
                $empresa = $empresaDao->buscarPorClavePrimaria($value["Empresa_codigoEmpresa"]);
                if($empresa!=null){
                    $analisisMuestra->setEmpresa($empresa);
                }
                
                $empleado = new Empleado();
                $empleadoDao = new EmpleadoDaoImp();
                $empleado = $empleadoDao->buscarPorClavePrimaria($value["rutEmpleadoRecibe"]);
                if($empleado!=null){
                    $analisisMuestra->setEmpleado($empleado);
                }
                
                $analisisMuestra->setId($value["idAnalisisMuestra"]);
                $analisisMuestra->setFechaRecepcion($value["fechaRecepcion"]);               
                $analisisMuestra->setTemperaturaRecepcion($value["temperaturaMuestra"]);
                $analisisMuestra->setCantidadMuestra($value["cantidadMuestra"]);
                
            }
            $pdo=NULL;
        } catch (Exception $exc) {
            echo "Error dao al buscar Analisis de muestras por cliente ".$exc->getMessage();
        }
        return $analisisMuestra;
        
    }

    public function crear($dto) {
        try {
            
            $pdo = new clasePDO();
            $stmt = null;
            $stmt = $pdo->prepare("INSERT INTO analisismuestras(fechaRecepcion, temperaturaMuestra,"
                        . "cantidadMuestra,?,rutEmpleadoRecibe) VALUES(now(),?,?,?,?");
            if($dto->getEmpresa()!=null){
                
                $stmt->bindValue(1, "Empresa_codigoEmpresa");
                $stmt->bindValue(4, $dto->getEmpresa()->getCodigo());
            }else{
                $stmt->bindValue(1, "Particular_codigoParticular");
                $stmt->bindValue(4, $dto->getParticular()->getCodigo());
            }
            $stmt->bindValue(2, $dto->getTemperaturaMuestra());
            $stmt->bindValue(3, $dto->getCantidadMuestra());
            $stmt->bindValue(5, $dto->getEmpleado()->getRut());
            
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
        $analisisMuestra = NULL;
        try {
            $pdo= new clasePDO();
            $stmt = $pdo->prepare("SELECT * FROM analisismuestras");
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            foreach ($resultado as $value) {
                $analisisMuestra =new AnalisisMuestras();
                
                $mParticular = $value["Particular_codigoParticular"];
                if($mParticular!=null){
                    $particular = new Particular();
                    $particularDao = new ParticularDaoImp();
                    $particular = $particularDao->buscarPorClavePrimaria($value["Particular_codigoParticular"]);
                    if($particular!=null){
                    $analisisMuestra->setParticular($particular);
                }
                }else{
                    $empresa = new Empresa();
                    $empresaDao = new EmpresaDaoImp();
                    $empresa = $empresaDao->buscarPorClavePrimaria($value["Empresa_codigoEmpresa"]);
                    if($empresa!=null){
                        $analisisMuestra->setEmpresa($empresa);
                    }
                }
                
                $empleado = new Empleado();
                $empleadoDao = new EmpleadoDaoImp();
                $empleado = $empleadoDao->buscarPorClavePrimaria($value["rutEmpleadoRecibe"]);
                if($empleado!=null){
                    $analisisMuestra->setEmpleado($empleado);
                }
                
                $analisisMuestra->setId($value["idAnalisisMuestra"]);
                $analisisMuestra->setFechaRecepcion($value["fechaRecepcion"]);               
                $analisisMuestra->setTemperaturaRecepcion($value["temperaturaMuestra"]);
                $analisisMuestra->setCantidadMuestra($value["cantidadMuestra"]);
                
            }
            $pdo=NULL;
        } catch (Exception $exc) {
            echo "Error dao al buscar Analisis de muestras ".$exc->getMessage();
        }
        return $analisisMuestra;
    }

    public function modificar($dto) {
        try {
            
            $pdo = new clasePDO();
            $stmt = null;
            $stmt = $pdo->prepare("update analisismuestras(temperaturaMuestra=?,"
                        . "cantidadMuestra=?,?=?,rutEmpleadoRecibe=? where idAnalisisMuestras=?");
            if($dto->getEmpresa()!=null){
                
                $stmt->bindValue(3, "Empresa_codigoEmpresa");
                $stmt->bindValue(4, $dto->getEmpresa()->getCodigo());
            }else{
                $stmt->bindValue(3, "Particular_codigoParticular");
                $stmt->bindValue(4, $dto->getParticular()->getCodigo());
            }
            $stmt->bindValue(1, $dto->getTemperaturaMuestra());
            $stmt->bindValue(2, $dto->getCantidadMuestra());
            $stmt->bindValue(5, $dto->getEmpleado()->getRut());
            $stmt->bindValue(6, $dto->getId());
            $stmt->execute();
            if ($stmt->rowCount() > 0)
                return TRUE;
            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al modificar analisis " . $exc->getMessage();
        }
        return FALSE;
    }

    public function buscarPorRutReceptor($rut) {
        $analisisMuestra = NULL;
        try {
            $pdo= new clasePDO();
            $stmt = $pdo->prepare("SELECT * FROM analisismuestras WHERE rutEmpleadoRecibe=?");
            $stmt->bindParam(1, $rut);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            foreach ($resultado as $value) {
                $analisisMuestra =new AnalisisMuestras();
                
                $particular = new Particular();
                $particularDao = new ParticularDaoImp();
                $particular = $particularDao->buscarPorClavePrimaria($value["Particular_codigoParticular"]);
                if($particular!=null){
                    $analisisMuestra->setParticular($particular);
                }
                
                $empresa = new Empresa();
                $empresaDao = new EmpresaDaoImp();
                $empresa = $empresaDao->buscarPorClavePrimaria($value["Empresa_codigoEmpresa"]);
                if($empresa!=null){
                    $analisisMuestra->setEmpresa($empresa);
                }
                
                $empleado = new Empleado();
                $empleadoDao = new EmpleadoDaoImp();
                $empleado = $empleadoDao->buscarPorClavePrimaria($value["rutEmpleadoRecibe"]);
                if($empleado!=null){
                    $analisisMuestra->setEmpleado($empleado);
                }
                
                $analisisMuestra->setId($value["idAnalisisMuestra"]);
                $analisisMuestra->setFechaRecepcion($value["fechaRecepcion"]);               
                $analisisMuestra->setTemperaturaRecepcion($value["temperaturaMuestra"]);
                $analisisMuestra->setCantidadMuestra($value["cantidadMuestra"]);
                
            }
            $pdo=NULL;
        } catch (Exception $exc) {
            echo "Error dao al buscar Analisis de muestras por receptor ".$exc->getMessage();
        }
        return $analisisMuestra;
        
    }

    public function buscarPorCodigoClienteEmpresa($codigo) {
        $analisisMuestra = NULL;
        try {
            $pdo= new clasePDO();
            $stmt = $pdo->prepare("SELECT * FROM analisismuestras WHERE Empresa_codigoEmpresa=?");
            $stmt->bindParam(1, $codigo);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            foreach ($resultado as $value) {
                $analisisMuestra =new AnalisisMuestras();
                
                $particular = new Particular();
                $particularDao = new ParticularDaoImp();
                $particular = $particularDao->buscarPorClavePrimaria($value["Particular_codigoParticular"]);
                if($particular!=null){
                    $analisisMuestra->setParticular($particular);
                }
                
                $empresa = new Empresa();
                $empresaDao = new EmpresaDaoImp();
                $empresa = $empresaDao->buscarPorClavePrimaria($value["Empresa_codigoEmpresa"]);
                if($empresa!=null){
                    $analisisMuestra->setEmpresa($empresa);
                }
                
                $empleado = new Empleado();
                $empleadoDao = new EmpleadoDaoImp();
                $empleado = $empleadoDao->buscarPorClavePrimaria($value["rutEmpleadoRecibe"]);
                if($empleado!=null){
                    $analisisMuestra->setEmpleado($empleado);
                }
                
                $analisisMuestra->setId($value["idAnalisisMuestra"]);
                $analisisMuestra->setFechaRecepcion($value["fechaRecepcion"]);               
                $analisisMuestra->setTemperaturaRecepcion($value["temperaturaMuestra"]);
                $analisisMuestra->setCantidadMuestra($value["cantidadMuestra"]);
                
            }
            $pdo=NULL;
        } catch (Exception $exc) {
            echo "Error dao al buscar Analisis de muestras por Empresa ".$exc->getMessage();
        }
        return $analisisMuestra;
        
    }

    public function buscarPorCodigoClienteParticular($codigo) {
        $analisisMuestra = NULL;
        try {
            $pdo= new clasePDO();
            $stmt = $pdo->prepare("SELECT * FROM analisismuestras WHERE Particuar_codigoParticular=?");
            $stmt->bindParam(1, $codigo);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            foreach ($resultado as $value) {
                $analisisMuestra =new AnalisisMuestras();
                
                $particular = new Particular();
                $particularDao = new ParticularDaoImp();
                $particular = $particularDao->buscarPorClavePrimaria($value["Particular_codigoParticular"]);
                if($particular!=null){
                    $analisisMuestra->setParticular($particular);
                }
                
                $empresa = new Empresa();
                $empresaDao = new EmpresaDaoImp();
                $empresa = $empresaDao->buscarPorClavePrimaria($value["Empresa_codigoEmpresa"]);
                if($empresa!=null){
                    $analisisMuestra->setEmpresa($empresa);
                }
                
                $empleado = new Empleado();
                $empleadoDao = new EmpleadoDaoImp();
                $empleado = $empleadoDao->buscarPorClavePrimaria($value["rutEmpleadoRecibe"]);
                if($empleado!=null){
                    $analisisMuestra->setEmpleado($empleado);
                }
                
                $analisisMuestra->setId($value["idAnalisisMuestra"]);
                $analisisMuestra->setFechaRecepcion($value["fechaRecepcion"]);               
                $analisisMuestra->setTemperaturaRecepcion($value["temperaturaMuestra"]);
                $analisisMuestra->setCantidadMuestra($value["cantidadMuestra"]);
                
            }
            $pdo=NULL;
        } catch (Exception $exc) {
            echo "Error dao al buscar Analisis de muestras por Particular ".$exc->getMessage();
        }
        return $analisisMuestra;
    }

}
