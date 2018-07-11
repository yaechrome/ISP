<?php
include_once '../bd/ClasePDO.php';
include_once '../dto/Empleado.php';
include_once 'BaseDao.php';
include_once 'EmpleadoDao.php';

class EmpleadoDaoImp implements EmpleadoDao{
    
    public function buscarPorClavePrimaria($id) {
        try {
            $empleado = null;
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("select * from empleado where rutEmpleado=?");
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $registro = $stmt->fetchAll();
            foreach ($registro as $value) {
                $empleado = new Empleado();
                $empleado->setRut($value["rutEmpleado"]);
                $empleado->setNombre($value["nombreEmpleado"]);
                $empleado->setPassword($value["passwordEmpleado"]);
                $empleado->setCategoria($value["categoria"]);
                $empleado->setEstado($value["estado"]);
            }

            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al buscar empleado " . $exc->getMessage();
        }
        return $empleado;
    }

    public function crear($dto) {
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("INSERT INTO empleado ( rutEmpleado,"
                    . "nombreEmpleado, passwordEmpleado, categoria) VALUES(?,?,?,?)");

            $stmt->bindValue(1, $dto->getRut());
            $stmt->bindValue(2, $dto->getNombre());
            $stmt->bindValue(3, $dto->getPassword());
            $stmt->bindValue(4, $dto->getCategoria());
            
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
            $stmt= $pdo->prepare("select * from empleado where Estado='Activo'");
            $stmt->execute();
            
            $resultado= $stmt->fetchAll();
            foreach ($resultado as $value) {
                $empleado = new Empleado();
                $empleado->setRut($value["rutEmpleado"]);
                $empleado->setNombre($value["nombreEmpleado"]);
                $empleado->setPassword($value["passwordEmpleado"]);
                $empleado->setCategoria($value["categoria"]);
                $empleado->setEstado($value["Estado"]);
   

                $lista->append($empleado);
            }
            
            $pdo=NULL;     
            
        } catch (Exception $exc) {
            echo "Error dao al listar empleados ".$exc->getMessage();
        }
        return $lista;
    }

    public function modificar($dto) {
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("update empleado set nombreEmpleado=?,"
                    . " passwordEmpleado=?, categoria=?, estado=? where rutEmpleado=?");
            
            $stmt->bindValue(5, $dto->getRut());
            $stmt->bindValue(1, $dto->getNombre());
            $stmt->bindValue(2, $dto->getPassword());
            $stmt->bindValue(3, $dto->getCategoria());
            $stmt->bindValue(4, $dto->getEstado());


            $stmt->execute();
            if ($stmt->rowCount() > 0)
                return TRUE;
            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al modificar Empleado" . $exc->getMessage();
        }
        return FALSE;
    }


    public function buscarPorRut($rut) {
        try {
            $empleado = null;
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("select * from empleado where rutEmpleado=? and estado='Activo'");
            $stmt->bindValue(1, $rut);
            $stmt->execute();
            $registro = $stmt->fetchAll();
            foreach ($registro as $value) {
                $empleado = new Empleado();
                $empleado->setRut($value["rutEmpleado"]);
                $empleado->setNombre($value["nombreEmpleado"]);
                $empleado->setPassword($value["passwordEmpleado"]);
                $empleado->setCategoria($value["categoria"]);
                $empleado->setEstado($value["estado"]);
            }

            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al buscar empleado " . $exc->getMessage();
        }
        return $empleado;
    }

    public function buscarPorPerfil($categoria) {
        try {
            $lista = new ArrayObject();
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("select * from empleado where categoria=? and estado='Activo'");
            $stmt->bindValue(1, $categoria);
            $stmt->execute();
            $registro = $stmt->fetchAll();
            foreach ($registro as $value) {
                $empleado = new Empleado();
                $empleado->setRut($value["rutEmpleado"]);
                $empleado->setNombre($value["nombreEmpleado"]);
                $empleado->setPassword($value["passwordEmpleado"]);
                $empleado->setCategoria($value["categoria"]);
                $empleado->setEstado($value["estado"]);

                $lista->append($empleado);
            }

            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al buscar empleado por perfil " . $exc->getMessage();
        }
        return $lista;
    }

    public function darDeBaja($rut) {
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("update empleado set estado='Inactivo' where rutEmpleado=?");
            
            $stmt->bindValue(1, $rut);


            $stmt->execute();
            if ($stmt->rowCount() > 0)
                return TRUE;
            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al modificar Empleado" . $exc->getMessage();
        }
        return FALSE;
    }
    
    public function existeRegistro($key) {
        try {
            $pdo = new clasePDO();
            $stmt= $pdo->prepare("SELECT rutEmpleado FROM empleado WHERE rutEmpleado=?");
            $stmt->bindParam(1, $key);
            $stmt->execute();
            
            if(count($stmt->fetchAll())>0){
                return TRUE;
            }
            $pdo=NULL;            
        } catch (Exception $exc) {
            echo "Error dao al validar rut ".$exc->getMessage();
        }
        return FALSE;
    }

}
