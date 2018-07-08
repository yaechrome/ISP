<?php

include_once 'BaseDao.php';

interface EmpleadoDao extends BaseDao{
    public function darDeBaja($rut);
}
