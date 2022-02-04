
<?php if(isset($bien)): ?>

<div class="detalle-bien">
    <table>
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Serie</th>
                <th>Color</th>
                <th>Fecha de Fabricación</th>
                <th>Estado</th>
                <th>Observaciones</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td> <?= $bien->descripcion ?> </td>
                <td> <?= $bien->marca ?> </td>
                <td> <?= $bien->modelo ?> </td>
                <td> <?= $bien->serie ?> </td>
                <td> <?= $bien->color ?> </td>
                <td> <?= $bien->fecha_fabricacion ?> </td>
                <td> <?= $bien->estado ?> </td>
                <td> <?= $bien->observacion ?> </td>
                <td> <?= $bien->cantidad ?> </td>
            </tr>
        </tbody>
    </table>
</div>

<?php endif; ?>

<?php if(isset($error)): ?>

    <div class="error">
        <?= $error ?>
    </div>

<?php endif; ?>