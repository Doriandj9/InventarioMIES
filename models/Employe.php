<?php
namespace models;

use aplication\Utiles;
use DateTime;

class Employe extends DatabaseTable {
    public $ci;
    public $nombre;
    public $apellido;
    public $cargo;
    public $area;
    public $clave;
    public $permission;
    const ADMIN = 16;

    public function __construct(
        string $table,
        string $primaryKey,
        $className = '\stdClass',
        array $arguments = []
    )
    {
        parent::__construct($table,$primaryKey,$className,$arguments);
    }



    public function verifyPermission($permission){

        return $this->permission & $permission;
    }


    public function saveBienes(Employe $employe , Bienes $bienesTable, array $data){

        if($employe->verifyPermission(Employe::ADMIN)){
            $data['cedula'] = $employe->cedula;
            $bienesTable->insert($data);
            return true;
        }else{
            return false;
        }
    }

    public function generateActa(Employe $employe, Acta_Bienes $acta_Bienes, Acta $actaModels, array $bienesArray,Bienes $bienTable){
        if($employe->verifyPermission(Employe::ADMIN)){
            date_default_timezone_set('America/Guayaquil');
            //insertamos un trabajador que va tener a cargo una acta
            $trabajador= $this->selectFromColumn('cedula',$bienesArray['cedula']);
            if(count($trabajador) == 0){
                $dataTrabajador = [
                    'cedula' => $bienesArray['cedula'],
                    'nombre' => $bienesArray['nombre'],
                    'apellido' => $bienesArray['apellido'],
                    'cargo' => $bienesArray['cargo'],
                    'area' => $bienesArray['area'],
                    'clave' => password_hash($bienesArray['password'],PASSWORD_DEFAULT)
                ];
                $employe->insert($dataTrabajador);
            }
            
            
           // 
            // insertamos la acta con su nuevo codigo para la genracion del custodio
            $actas = $actaModels->selectArray();
            $numberCod = '2022-000'; 
            if(count($actas) != 0){
                $numberCod = $actas[count($actas)-1]['codigo_acta'];
                $cod_actas = Utiles::codigoActa($numberCod);
            }else{
                $cod_actas = Utiles::codigoActa($numberCod);
            }
            $date = new \DateTime();
            $dataActa= [
                'codigo_acta' => $cod_actas,
                'fecha_creacion' => $date->format('Y-m-d H:i:s'),
                'cedula' => $employe->cedula,
                'cedula_receptor' => $bienesArray['cedula']
            ];
            
            $actaModels->insert($dataActa);

            //insertamos el codigo de la acta con el codigo de los bienes
            

            foreach($bienesArray['bienes'] as $value ){
                $dataActa_Bienes = [
                    'codigo_acta' => $cod_actas,
                    'codigo_bien' => $value
                ];

                $acta_Bienes->insert($dataActa_Bienes);
            }
            

            // Restamos la cantidad ya que adquiere en los bienes de la acta

            for($i = 0 ; $i<count($bienesArray['cant']); $i++){
                $biendataUpdate = $bienTable->selectFromColumn('codigo',$bienesArray['bienes'][$i])[0];
                $numCanti = $biendataUpdate->cantidad - intval($bienesArray['cant'][$i]);
                $databienUP = [
                    'cantidad' => $numCanti,
                    'codigo' => $biendataUpdate->codigo
                ];

                $bienTable->update($databienUP);
            }

            return $cod_actas;
            
        }
    }

}
