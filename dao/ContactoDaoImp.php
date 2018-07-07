<?php
include_once '../bd/ClasePDO.php';
include_once '../dto/Contacto.php';
include_once 'BaseDao.php';
include_once 'ContactoDao.php';

class ContactoDaoImp implements ContactoDao{
    
    public function buscarPorClavePrimaria($id) {
        $contacto = new Contacto();
        try {
            $pdo= new clasePDO();
            $stmt = $pdo->prepare("SELECT * FROM contacto WHERE rutContacto=?");
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            foreach ($resultado as $value) {
                $empresa = new Usuario();
                $empresaDao = new UsuarioDaoImp();
                $empresa = $empresaDao->buscarPorClavePrimaria($value["codigoEmpresa"]);
                $contacto->setRut($value["rutContacto"]);
                $contacto->setNombre($value["nombreContacto"]);               
                $contacto->setEmail($value["emailContacto"]);
                $contacto->setTelefono($value["telefonoCotacto"]);
                $contacto->setEmpresa($empresa);
            }
            $pdo=NULL;
        } catch (Exception $exc) {
            echo "Error dao al buscar contacto por rut de contacto ".$exc->getMessage();
        }
        return $contacto;
    }

    public function crear($dto) {
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("INSERT INTO contacto(rutContacto, nombreContacto,"
                    . "emailContacto, telefonoContacto, codigoEmpresa) VALUES(?,?,?,?,?");

            $stmt->bindValue(1, $dto->getRut());
            $stmt->bindValue(2, $dto->getNombre());
            $stmt->bindValue(3, $dto->getEmail());
            $stmt->bindValue(4, $dto->getTelefono());
            $stmt->bindValue(5, $dto->getEmpresa()->getCodigo());
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
            $stmt= $pdo->prepare("select * from contacto");
            $stmt->execute();
            
            $resultado= $stmt->fetchAll();
            foreach ($resultado as $value) {
                $empresa = new Usuario();
                $empresaDao = new UsuarioDaoImp();
                $empresa = $empresaDao->buscarPorClavePrimaria($value["codigoEmpresa"]);
                $contacto->setRut($value["rutContacto"]);
                $contacto->setNombre($value["nombreContacto"]);               
                $contacto->setEmail($value["emailContacto"]);
                $contacto->setTelefono($value["telefonoCotacto"]);
                $contacto->setEmpresa($empresa);

                $lista->append($contacto);
            }
            
            $pdo=NULL;     
            
        } catch (Exception $exc) {
            echo "Error dao al listar contactos ".$exc->getMessage();
        }
        return $lista;
    }

    public function listarPorCodigoEmpresa($codigoEmpresa) {
        try {
            $lista = new ArrayObject();
            $pdo = new clasePDO();
            $stmt= $pdo->prepare("select * from contacto where codigoEmpresa =?");
            $stmt->bindValue(1, $codigoEmpresa);
            $stmt->execute();
            
            $resultado= $stmt->fetchAll();
            foreach ($resultado as $value) {
                $empresa = new Usuario();
                $empresaDao = new UsuarioDaoImp();
                $empresa = $empresaDao->buscarPorClavePrimaria($value["codigoEmpresa"]);
                $contacto->setRut($value["rutContacto"]);
                $contacto->setNombre($value["nombreContacto"]);               
                $contacto->setEmail($value["emailContacto"]);
                $contacto->setTelefono($value["telefonoCotacto"]);
                $contacto->setEmpresa($empresa);

                $lista->append($contacto);
            }
            
            $pdo=NULL;     
            
        } catch (Exception $exc) {
            echo "Error dao al listar contactos ".$exc->getMessage();
        }
        return $lista;
    }

    public function modificar($dto) {
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("update telefono set nombreContacto,"
                    . "emailContacto, telefonoContacto, codigoEmpresa where rutContacto=?");

            $stmt->bindValue(5, $dto->getRut());
            $stmt->bindValue(1, $dto->getNombre());
            $stmt->bindValue(2, $dto->getEmail());
            $stmt->bindValue(3, $dto->getTelefono());
            $stmt->bindValue(4, $dto->getEmpresa()->getCodigo());

            $stmt->execute();
            if ($stmt->rowCount() > 0)
                return TRUE;
            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al modificar contacto" . $exc->getMessage();
        }
        return FALSE;
    }

}
