<?php
include_once '../bd/ClasePDO.php';
include_once '../dto/AnalisisMuestras.php';
include_once 'BaseDao.php';
include_once 'AnalisisMuestraDao.php';

class AnalisisMuestraDaoImp implements AnalisisMuestraDao{

    public function buscarPorCodigoCliente($codigo) {
        $analisisMuestra = NULL;
        try {
            $pdo= new clasePDO();
            $stmt = $pdo->prepare("SELECT * FROM analisismuestras WHERE codigoCliente=?");

            $stmt->bindParam(1, $codigo);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            foreach ($resultado as $value) {
                $analisisMuestra =new AnalisisMuestras();
                
                $usuario = new Usuario();
                $usuarioDao = new UsuarioDaoImp();
                $usuario = $usuarioDao->buscarPorClavePrimaria($value["codigoCliente"]);
                
                $analisisMuestra->setUsuario($usuario);
                
                
                $empleado = new Empleado();
                $empleadoDao = new EmpleadoDaoImp();
                $empleado = $empleadoDao->buscarPorClavePrimaria($value["rutEmpleadoRecibe"]);
               
                $analisisMuestra->setEmpleado($empleado);
                
                
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
                        . "cantidadMuestra,codigoCliente,rutEmpleadoRecibe) VALUES(now(),?,?,?,?");
            
            $stmt->bindValue(3, $dto->getCliente()->getCodigo());
            $stmt->bindValue(1, $dto->getTemperaturaMuestra());
            $stmt->bindValue(2, $dto->getCantidadMuestra());
            $stmt->bindValue(4, $dto->getEmpleado()->getRut());
            
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
                
                $usuario = new Usuario();
                $usuarioDao = new UsuarioDaoImp();
                $usuario = $usuarioDao->buscarPorClavePrimaria($value["codigoCliente"]);

                $analisisMuestra->setUsuario($usuario);
                
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
                        . "cantidadMuestra=?,codigoCliente=?,rutEmpleadoRecibe=? where idAnalisisMuestras=?");
              
            
            $stmt->bindValue(3, $dto->getUsuario()->getCodigo());
            
            $stmt->bindValue(1, $dto->getTemperaturaMuestra());
            $stmt->bindValue(2, $dto->getCantidadMuestra());
            $stmt->bindValue(4, $dto->getEmpleado()->getRut());
            $stmt->bindValue(5, $dto->getId());
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

                $usuario = new Usuario();
                $usuarioDao = new UsuarioDaoImp();
                $usuario = $usuarioDao->buscarPorClavePrimaria($value["codigoCliente"]);
                
                $analisisMuestra->setUsuario($usuario);
                
                
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
                
                $usuario = new Usuario();
                $usuarioDao = new UsuarioDaoImp();
                $usuario = $usuarioDao->buscarPorClavePrimaria($value["codigoCliente"]);
                $analisisMuestra->setUsuario($usuario);
                
                
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

    public function buscarEnProceso() {
        
    }

    public function reporteRecepcionXReceptor($rut) {
        
    }

}
