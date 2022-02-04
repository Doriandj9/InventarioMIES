
<?php if(isset($error)): ?>
<div class="errors">
        <?= $error ?>
</div>
<?php endif ?>

<?php if(isset($exito)): ?>
    <div class="exito">
        <?= $exito ?>
    </div>
<?php endif;?>    

<div class="memu-login">
    <form action="" class="menu-login__form-layout" method="POST">
        <div>Ingrese una descripción 
            <textarea name="bien[descripcion]" id="" cols="50" rows="5" required></textarea>
        </div>
        <div>Ingrese la marca: <input type="text" name="bien[marca]" required></div>
        <div>Ingrese el modelo: <input type="text" name="bien[modelo]" required></div>
        <div>Ingrese la serie: <input type="text" name="bien[serie]" required></div>
        <div>Ingrese el color: <input type="text" name="bien[color]" required></div>
        <div>Ingrese fecha de fabricación: <input type="date" name="bien[fecha_fabricacion]" required></div>
        <div>Selecione el estado <select name="bien[estado]" required>
            <option value="bueno">Bueno</option>
            <option value="malo">Malo</option>
        </select> </div>
        <div>Ingrese una cantidad: <input type="number" name="bien[cantidad]" value="1" min="1" id=""></div>
        <div>Ingrese las observaciones <textarea name="bien[observacion]" id="" cols="50" rows="5">Sin observaciones</textarea></div>
        <button type="submit">Guardar</button>
    </form>
</div>