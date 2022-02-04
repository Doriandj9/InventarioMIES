<?php

namespace frame;
use models\Employe;

class Autentification{
    private $employedTable;
    private $ci;
    private $clave;

    public function __construct(
        Employe $employedTable,
        string $ci,
        string $clave
    )
    {
        $this->employedTable= $employedTable;
        $this->ci=$ci;
        $this->clave= $clave;
        session_start();
    }

    public function startSession(string $ci, string $clave): bool
    {

        $employe = $this->employedTable->selectFromColumn('cedula',$ci);
        if($employe && password_verify($clave, $employe[0]->{$this->clave}) ){
            session_regenerate_id();
            $_SESSION['ci'] = $ci;
            $_SESSION['password'] = $employe[0]->{$this->clave};

            return true;
        }else{
            return false;
        }

    }

    public function validationAll(){

        if(empty($_SESSION['ci'])){
            return false;
        }
        
        $result = $this->employedTable->selectFromColumn('cedula', $_SESSION['ci'])[0];

        
        if($result->{$this->clave} == $_SESSION['password']){
            return true;
        }else{
            return false;
        }
    }

    public function getUser(){

        if($this->validationAll()){
            return $this->employedTable->selectFromColumn('cedula', $_SESSION['ci'])[0];
        }else{
            return false;
        }
        
    }

}