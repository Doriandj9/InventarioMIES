<?php 

namespace controllers;

use frame\Autentification;
use models\Acta as ModelsActa;
use models\Acta_Bienes;
use models\Bienes;
use models\Employe;

class Acta{
    private $employedTable;
    private $bienesTable;
    private $acta_bienesTable;
    private $actaModels;
    private $autentification;
    public function __construct(
        Employe $employedTable,
        Bienes $bienesTable,
        Acta_Bienes $acta_bienesTable,
        ModelsActa $actaModels,
        Autentification $autentification
    )
    {
        $this->employedTable= $employedTable;
        $this->bienesTable= $bienesTable;
        $this->acta_bienesTable = $acta_bienesTable;
        $this->actaModels= $actaModels;
        $this->autentification= $autentification;
    }

    public function saveCustodio(){
        
       $employe = $this->autentification->getUser();
       $actaFront = $this->employedTable->generateActa($employe,$this->acta_bienesTable,$this->actaModels, $_POST,$this->bienesTable); 
       $actaUltimate  = $this->actaModels->selectFromColumn('codigo_acta',$actaFront)[0];
       $Actarelacion = $this->acta_bienesTable->selectFromColumn('codigo_acta',$actaFront);
       $binesDeActa = [];
       $index = 0;
       foreach($Actarelacion as $value){
            array_push($binesDeActa,$this->bienesTable->selectFromColumn('codigo',$value->codigo_bien)[0]);
            $binesDeActa[$index]->cantidad = $_POST['cant'][$index];
            $index++;
       }
       $date = new \DateTime($actaUltimate->fecha_creacion);
        $year = $date->format('Y');
        $mount = $date->format('m');
        $day = $date->format('d');
        $tableMountYear = [
            '01' => 'Enero',
            '02' => 'Febrero',
            '03' => 'Marzo',
            '04' => 'Abril',
            '05' => 'Mayo',
            '06' => 'Junio',
            '07' => 'Julio',
            '08' => 'Agosto',
            '09' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre'
        ];
        $dataActaGenerate = [
            'codigo' => $actaUltimate->codigo_acta,
            'year' => $year,
            'mount' => $tableMountYear[$mount],
            'day' => $day,
            'nombre' => $employe->nombre .' '. $employe->apellido,
            'cargo1' => $employe->cargo,
            'receptor' => $_POST['nombre'] .' '. $_POST['apellido'],
            'cargo2' => $_POST['cargo'],
            'bienes' => $binesDeActa,
            'cedula' => $employe->cedula,
        ];
        
        return[
            'title'=>'Acta de Bienes',
            'template' => 'admin/actaBienesGenerate.html.php',
            'variables' => [
                'datos' => $dataActaGenerate
            ]
        ];
        
    }
}