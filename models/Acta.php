<?php

namespace models;

class Acta extends DatabaseTable{
    public $codigo_acta;
    public $acta_archivo;
    public $fecha_creacion;
    public $cedula_receptor;
    public $cedula;
    

    public function __construct(
        string $table,
        string $primaryKey,
        $className = '\models\Acta',
        array $arguments = []
    )
    {
        parent::__construct($table,$primaryKey,$className,$arguments);
        
    }



    


}