<?php

namespace controllers;

use frame\Autentification;
use models\Employe;

class Login{
    private $employedTable;
    private $autentification;

    public function __construct(
        Employe $employedTable,
        Autentification $autentification
    )
    {
        $this->employedTable= $employedTable;
        $this->autentification= $autentification;
    }
    

    public function loadLogin(){
        $employedVerif = $this->autentification->startSession($_POST['cedula'],$_POST['password']);
        if($employedVerif){
           $user = $this->autentification->getUser();
           if($user->verifyPermission(Employe::ADMIN)){
                header('location: /view/admin');
           }else{
                header('location:/list/actas');
           }

            
           
            
        }else{
            return [
                'title' => 'MIES GUARANDA',
                'template'=> 'employed/home.html.php',
                'variables' => [
                    'error' => 'Error cédula y / o clave incorrectas'
                ]
            ];
        }
    }

    public function logOut(){
        unset($_SESSION);
        session_destroy();
        header('location: /');
    }
    public function errorSession(){
        return [
            'title' => 'Error de Sesion',
            'template' => 'employed/errorSession.html.php'
        ];
    }
    public function errorPermission(){
        return [
            'title' => 'Error de Sesion',
            'template' => 'employed/errorPermision.html.php'
        ];
    }
}