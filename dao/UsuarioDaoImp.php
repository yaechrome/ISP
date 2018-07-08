<?php
include_once '../bd/ClasePDO.php';
include_once '../dto/Usuario.php';
include_once 'UsuarioDao.php';
include_once 'BaseDao.php';


class UsuarioDaoImp implements UsuarioDao{
    
    public function buscarPorClavePrimaria($id) {
         try {
            $usuario = null;
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("select * from usuario where codigo=?");
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $registro = $stmt->fetchAll();
            foreach ($registro as $value) {
                $usuario = new Particular();
                $usuario->setCodigo($value["codigo"]);
                $usuario->setRut($value["rut"]);
                $usuario->setPassword($value["password"]);
                $usuario->setNombre($value["nombre"]);
                $usuario->setDireccion($value["direccion"]);
                $usuario->setEmail($value["email"]);
                $usuario->setPerfil($value["perfil"]);
                $usuario->setEstado($value["estado"]);

            }

            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al buscar usuario " . $exc->getMessage();
        }
        return $particular;
    }

    public function crear($dto) {
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("INSERT INTO usuario ( rut, password,"
                    . "nombre, direccion, email, perfil) VALUES(?,?,?,?,?,?");

            $stmt->bindValue(1, $dto->getRut());
            $stmt->bindValue(2, $dto->getPassword());
            $stmt->bindValue(3, $dto->getNombre());
            $stmt->bindValue(4, $dto->getDireccion());
            $stmt->bindValue(5, $dto->getEmail());
            $stmt->bindValue(6, $dto->getPerfil());

            
            $stmt->execute();
            if ($stmt->rowCount() > 0)
                return TRUE;
            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al agregar usuario " . $exc->getMessage();
        }
        return FALSE;
        
    }

    public function darDeBaja($codigoUsuario) {
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("update usuario set estado=Inactivo where codigo=?");

            $stmt->bindValue(1, $codigoUsuario);

            $stmt->execute();
            if ($stmt->rowCount() > 0)
                return TRUE;
            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al modificar estado de usuario" . $exc->getMessage();
        }
        return FALSE;
    }

    public function listar() {
        try {
            $lista = new ArrayObject();
            $pdo = new clasePDO();
            $stmt= $pdo->prepare("select * from usuario");
            $stmt->execute();
            
            $resultado= $stmt->fetchAll();
            foreach ($resultado as $value) {
                $usuario = new Usuario();
                $usuario->setCodigo($value["codigo"]);
                $usuario->setRut($value["rut"]);
                $usuario->setPassword($value["password"]);
                $usuario->setNombre($value["nombre"]);
                $usuario->setDireccion($value["direccion"]);
                $usuario->setEmail($value["email"]);
                $usuario->setPerfil($value["perfil"]);
                $usuario->setEstado($value["estado"]);

                $lista->append($usuario);
            }
            
            $pdo=NULL;     
            
        } catch (Exception $exc) {
            echo "Error dao al listar usuarios ".$exc->getMessage();
        }
        return $lista;
    }

    public function modificar($dto) {
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("update usuario set rut=?, password=?,"
                    . "nombre=?, direccion=?, email=?, perfil=? where codigo=?");
            
            $stmt->bindValue(1, $dto->getRut());
            $stmt->bindValue(2, $dto->getPassword());
            $stmt->bindValue(3, $dto->getNombre());
            $stmt->bindValue(4, $dto->getDireccion());
            $stmt->bindValue(5, $dto->getEmail());
            $stmt->bindValue(6, $dto->getPerfil());
            $stmt->bindValue(7, $dto->getCodigo());

            $stmt->execute();
            if ($stmt->rowCount() > 0)
                return TRUE;
            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al modificar usuario" . $exc->getMessage();
        }
        return FALSE;
    }

    public function buscarPorRutCliente($rut) {
        try {
            $usuario = null;
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("select * from usuario where rut=?");
            $stmt->bindValue(1, $rut);
            $stmt->execute();
            $registro = $stmt->fetchAll();
            foreach ($registro as $value) {
                $usuario = new Usuario();
                $usuario->setCodigo($value["codigo"]);
                $usuario->setRut($value["rut"]);
                $usuario->setPassword($value["password"]);
                $usuario->setNombre($value["nombre"]);
                $usuario->setDireccion($value["direccion"]);
                $usuario->setEmail($value["email"]);
                $usuario->setPerfil($value["perfil"]);
                $usuario->setEstado($value["estado"]);
            }

            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al buscar cliente " . $exc->getMessage();
        }
        return $usuario;
    }
    
    public function existeRegistro($key) {
        try {
            $pdo = new clasePDO();
            $stmt= $pdo->prepare("SELECT RUT FROM usuario WHERE rut=?");
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
