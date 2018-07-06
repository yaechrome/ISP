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
                    . "nombreEmpleado, passwordEmpleado, categoria) VALUES(?,?,?,?");

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
            $stmt= $pdo->prepare("select * from empleado");
            $stmt->execute();
            
            $resultado= $stmt->fetchAll();
            foreach ($resultado as $value) {
                $empleado = new Empleado();
                $empleado->setRut($value["rutEmpleado"]);
                $empleado->setNombre($value["nombreEmpleado"]);
                $empleado->setPassword($value["passwordEmpleado"]);
                $empleado->setCategoria($value["categoria"]);
   

                $lista->append($empleado);
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
            $stmt = $pdo->prepare("update particular set nombreEmpleado=?,"
                    . " passwordEmpleado=?, categoria=? where rutEmpleado=?");
            
            $stmt->bindValue(4, $dto->getRut());
            $stmt->bindValue(1, $dto->getNombre());
            $stmt->bindValue(2, $dto->getPassword());
            $stmt->bindValue(3, $dto->getCategoria());


            $stmt->execute();
            if ($stmt->rowCount() > 0)
                return TRUE;
            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al modificar Empleado" . $exc->getMessage();
        }
        return FALSE;
    }

}
