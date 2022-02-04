<?php
namespace controllers;

use frame\Autentification;
use models\Bienes as ModelsBienes;
use models\Employe;

class Bienes{
    private $employeTable;
    private $bienesTable;
    private $autentication;

    public function __construct(
        Employe $employeTable,
        ModelsBienes $bienesTable,
        Autentification $autentification
    )
    {
        $this->employeTable= $employeTable;
        $this->bienesTable= $bienesTable;
        $this->autentication= $autentification;
    }

    public function formBienes(){
        return [
            'title' => 'Ingresar Bienes',
            'template' => 'employed/addBienes.hmtl.php'
        ];
    }

    public function saveBienes(){
        $data = $_POST['bien'];
        $employe = $this->autentication->getUser();
        if($this->employeTable->saveBienes($employe,$this->bienesTable,$data)){
            return [
                'title' => 'Ingresar Bienes',
                'template' => 'employed/addBienes.hmtl.php',
                'variables' => [
                    'exito' => 'Se guardo correctamente'
                ]
            ];
        }else{
            return [
                'title' => 'Ingresar Bienes',
                'template' => 'employed/addBienes.hmtl.php',
                'variables' => [
                    'error' => 'No se guardo el bien ya que no es administrador'
                ]
            ];
        }
    }

    public function printBienes(){
        header('Access-Control-Allow-Origin: *');
        $bienes = $this->bienesTable->select(null,null,true,'marca');
        echo json_encode($bienes,JSON_UNESCAPED_UNICODE);
        die;
    }

    public function getBienes(){
        if(isset($_GET['id'])){
            $bien= $this->bienesTable->selectFromColumn('codigo',$_GET['id'])[0];
            return [
                'title'  => 'Bien en detalle',
                'template'=>'admin/bienDetalle.html.php',
                'variables' => [
                    'bien' => $bien
                ]
            ];
        }else{
            return [
                'title'  => 'Bien en detalle',
                'template'=>'admin/bienDetalle.html.php',
                'variables' => [
                    'error' => 'No hay un bien por mostrar'
                ]
            ];
        }
    }
}