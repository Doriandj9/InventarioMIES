<?php
namespace models\conection;
include __DIR__ . '/../../config.php';
class Conection{


    public static function getConection(){
        $dbConect = new \PDO('pgsql:host=localhost;port=5432;dbname='.DBNAME,USER,PASSWORD);
        $dbConect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $dbConect;
    }
}