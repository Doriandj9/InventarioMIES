<?php

use aplication\RoutesAplication;
use models\Employe;
if(isset($_SESSION['ci'])){
    $routesWeb = new RoutesAplication;
    $user = $routesWeb->getAutentification()->getUser();
    if($user->verifyPermission(Employe::ADMIN)){
        header('location:/view/admin');
    }else{
        header('location: /list/actas');
    }
}

?>

<?php
    if(isset($error)):
?>
    <div class="error">
        <?= $error; ?>
    </div>

<?php endif; ?>

<div class="memu-login">
    <form  class="menu-login__form-layout" action="" method="post">
        <label for="ci">Ingrese su numero de cédula</label>
        <input type="text" name="cedula">
        <label for="password">Ingrese su clave</label>
        <input type="password" name="password" id="">
        <button type="submit">Ingresar</button>
    </form>
</div>