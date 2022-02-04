<?php

namespace models;

class Bienes extends DatabaseTable{
    public $codigo;
    public $descripcion;
    public $marca;
    public $modelo;
    public $serie;
    public $color;
    public $fecha_fabricacion;
    public $estado;
    public $observacion;

    public function __construct(
        string $table,
        string $primaryKey,
        $className = '\models\Bienes',
        array $arguments = []
    )
    {
        parent::__construct($table,$primaryKey,$className,$arguments);
    }

    public function selectEspecial(string $column, $condition){
        $bien = new Bienes('bienes','codigo', '\models\Bienes', [
            'bienes','codigo']);

        $result = $bien->selectFromColumn($column, $condition);
        return $result;
    }

}