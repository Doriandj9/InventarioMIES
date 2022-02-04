<?php

namespace controllers;

use models\Employe;

class Employed{

    private $employedTable;

    public function __construct(
        Employe $employedTable
    )
    {
        $this->employedTable= $employedTable;
    }

    public function home(){
        // $claveEncrp = password_hash('54321',PASSWORD_DEFAULT);
        // $params = [
        //     'cedula' => '0123456789',
        //     'nombre' => 'Pedro',
        //     'apellido' => 'Marquez',
        //     'cargo' => 'Doctor',
        //     'area' => 'Salud',
        //     'clave' => $claveEncrp,
        //     'permission' => 16
        // ];

        // $this->employedTable->insert($params);
        return [
            'title' => 'MIES GUARANDA',
            'template'=> 'employed/home.html.php'
        ];
    }

    public function viewAdmin(){
        return [
            'title' => 'Vista del Adminstrado',
            'template' => 'admin/start.html.php'
        ];
    }

    public function listActas(){
        return [
            'title' => 'Lista de actas',
            'template' => 'employed/actas.html.php'
        ];
    }

    public function addCustodio(){
        return [
            'title' => 'Nuevo Custodio',
            'template' => 'admin/custodio.html.php'
        ];
    }
    
}