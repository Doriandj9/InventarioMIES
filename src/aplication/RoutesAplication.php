<?php 
namespace aplication;

use controllers\Acta;
use controllers\Bienes as ControllersBienes;
use frame\Routes;
use controllers\Employed;
use controllers\Login;
use frame\Autentification;
use models\Acta as ModelsActa;
use models\Acta_Bienes;
use models\Bienes;
use models\Employe;

class RoutesAplication implements  Routes {

    private $employeModels;
    private $bienesModels;
    private $actaModels;
    private $autentificaction;
    private $acta_bienesModels;

    public function __construct()
    {
        $this->employeModels= new Employe('trabajador','cedula','\models\Employe',[
            'trabajador','cedula'
        ]);
        $this->bienesModels = new Bienes('bienes','codigo', '\models\Bienes', [
            'bienes','codigo'
        ]);
        $this->actaModels= new ModelsActa('acta','codigo_acta','\models\Acta',[
            'acta','codigo_acta'
        ]);
        $this->autentificaction= new Autentification($this->employeModels,'cedula','clave');
        $this->acta_bienesModels= new Acta_Bienes('acta_bienes','codigo_acta','\models\Acta_Bienes',[
            'acta_bienes','codigo_acta'
        ]);
    }

    function getRoutesAplication(): array
    {
        $employedController = new Employed($this->employeModels);
        $loginController = new Login($this->employeModels,$this->autentificaction);
        $bienesController = new ControllersBienes($this->employeModels,$this->bienesModels,$this->autentificaction);
        $actaController = new Acta($this->employeModels,$this->bienesModels,$this->acta_bienesModels,$this->actaModels,$this->autentificaction);
        return [
            '' =>[
                'GET' => [
                    'controller' => $employedController,
                    'action' => 'home'
                ],
                'POST'=> [
                    'controller' => $loginController,
                    'action' => 'loadLogin'
                ]
                ],
            'view/admin' => [
                'GET' => [
                    'controller' => $employedController,
                    'action' => 'viewAdmin',
                ],
                'login' => true,
                'permission' => Employe::ADMIN
            ],
            'logout' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'logOut'
                ],
            ],
            'error/session' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'errorSession'
                ],
            ],
            'no/permission' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'errorPermission'
                ],
            ],
            'list/actas' => [
                'GET' => [
                    'controller' => $employedController,
                    'action' => 'listActas'
                ],
            ],
            'add/bienes' => [
                'GET' => [
                    'controller' => $bienesController,
                    'action' => 'formBienes'
                ],
                'POST'=> [
                    'controller' => $bienesController,
                    'action' => 'saveBienes'
                ],
                'login' => true,
                'permission' => Employe::ADMIN
                ],
            'add/custodio' => [
                'GET' => [
                    'controller' => $employedController,
                    'action' => 'addCustodio'
                ],
                'POST'=> [
                    'controller' => $actaController,
                    'action' => 'saveCustodio'
                ]
                ],
            'print/bienes' => [
                'GET' => [
                    'controller' => $bienesController,
                    'action' => 'printBienes'
                ],
                
            ],
            'bienes/detalle'=> [
                'GET' => [
                    'controller' => $bienesController,
                    'action' => 'getBienes'
                ]
                ],
        ];
    }

    public function getAutentification(): Autentification
    {
       
        return $this->autentificaction;
    }

    public function hashPermission($permission): bool
    {        
        $employed = $this->autentificaction->getUser();
        // if($employed){
        //     return false;
        // }
        return $employed->verifyPermission($permission) ? true: false;
    }
}