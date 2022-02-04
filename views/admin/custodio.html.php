<div class="memu-login">
    <form  class="menu-login__form-layout" action="" method="post">
        <label for="ci">Ingrese el numero de cédula del receptor</label>
        <input type="text" name="cedula" required>
        <label for="nombre">Ingrese el nombre del receptor</label>
        <input type="text" name="nombre" required>
        <label for="apellido">Ingrese el apellido del receptor</label>
        <input type="text" name="apellido" required>
        <label for="cargo">Ingrese el cargo del  receptor</label>
        <input type="text" name="cargo" required>
        <label for="area">Ingrese el areá al que pertence el receptor</label>
        <input type="text" name="area" required>
        <label for="password">Ingrese clave para el receptor</label>
        <input type="password" name="password" id="" required>
        <div class="selection" id="selection-bienes"> Seleccionar-Bienes </div>
        <div class="lista-bienes"></div>
        <button type="submit" id="ingresar-custodio">Generar Acta</button>
    </form>
</div>
