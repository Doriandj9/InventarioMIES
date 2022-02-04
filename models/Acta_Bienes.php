<?php
namespace models;

class Acta_Bienes extends DatabaseTable{
    public $codigo_acta;
    public $codigo_bien;

    public function __construct(
        string $table,
        string $primaryKey,
        $className = '\models\Acta_Bienes',
        array $arguments = []
    )
    {
        parent::__construct($table,$primaryKey,$className,$arguments);
        
    }
}