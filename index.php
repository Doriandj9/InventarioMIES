<?php

include __DIR__ . '/vendor/autoload.php';
use frame\EntryPoint;
use aplication\RoutesAplication;

$route = ltrim(strtok($_SERVER['REQUEST_URI'],'?'),'/');

try{

    $entryPoint = new EntryPoint($route,$_SERVER['REQUEST_METHOD'],new RoutesAplication);
    $entryPoint->run();

}catch(\PDOException $e){
    $title = 'Errro BaseDatos';
    $content = 'Error: ' .  $e->getMessage() . ' in ' . $e->getFile() . ' : ' . $e->getLine();

    include __DIR__ . '/views/templates/layout.html.php';
}