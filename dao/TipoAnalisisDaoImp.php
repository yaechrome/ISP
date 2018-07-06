<?php
include_once '../bd/ClasePDO.php';
include_once '../dto/TipoAnalisis.php';
include_once 'BaseDao.php';
include_once 'TipoAnalisisDao.php';

class TipoAnalisisDaoImp implements TipoAnalisisDao{
    
    public function buscarPorClavePrimaria($id) {
        try {
            $tipoAnalisis = new TipoAnalisis();
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("select * from tipoanalisis where idTipoAnalisis=?");
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $registro = $stmt->fetchAll();
            foreach ($registro as $value) {
                
                $tipoAnalisis->setId($value["idTipoAnalisis"]);
                $tipoAnalisis->setNombre($value["nombre"]);

            }

            $pdo = NULL;
        } catch (Exception $exc) {
            echo "Error dao al buscar Tipo de analisis " . $exc->getMessage();
        }
        return $tipoAnalisis;
    }

    public function listar() {
        try {
            $lista = new ArrayObject();
            $pdo = new clasePDO();
            $stmt= $pdo->prepare("select * from tipoanalisis");
            $stmt->execute();
            
            $tipos= $stmt->fetchAll();
            foreach ($tipos as $value) {
                $tipoAnalisis = new TipoAnalisis();
                $tipoAnalisis->setId($value["idTipoAnalisis"]);
                $tipoAnalisis->setNombre("nombre");

                $lista->append($tipoAnalisis);
            }
            
            $pdo=NULL;     
            
        } catch (Exception $exc) {
            echo "Error dao al listar tipos de analisis ".$exc->getMessage();
        }
        return $lista;
        
    }

}
