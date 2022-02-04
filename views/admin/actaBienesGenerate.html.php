<div class="frame-acta" id="acta-final">
    <div class="acta-header">
        <img src="/public/img/mies_ecuador.jpg" alt="mies">
    </div>
    <div class="acta-title">
        Acta de Entrega Recepción Nª <?= $datos['codigo'] ?>
    </div>
    <div class="acta-notificacion">
        En la cuidad de Guaranda a los <?= $datos['day'] ?> dias del mes de <?= $datos['mount'] ?> del <?= $datos['year'] ?> se procede a la suscripción 
        de la presente Acta Entrega-Recepción entre las siguientes personas:
    </div>
    <div class="acta-items">
        <li> <b>ENTREGADO POR: </b><?= $datos['nombre']?>
                <p><?= $datos['cargo1'] ?></p>
        </li>
        <li> <b>RECIBIDO POR: </b><?= $datos['receptor']?>
                <P><?= $datos['cargo2'] ?></p>
        </li>
    </div>
    <div class="acta-detalle">
        De los bienes que a continuación se detalla:
    </div>
    <div class="acta-tabla">
        <table>
            <thead>
                <tr>
                    <th class="acta-tabla-cantidad">CANTIDAD</th>
                    <th class="acta-tabla-descrip ">DESCRIPCIÓN</th>
                    <th class="acta-tabla-marca ">MARCA</th>
                    <th class="acta-tabla-modelo ">MODELO</th>
                    <th class="acta-tabla-serie ">SERIE</th>
                    <th class="acta-tabla-estado ">ESTADO</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($datos['bienes'] as $value): ?>
                    <tr class="td-altura">
                        <td> <?= $value->cantidad ?? '' ?>  </td>
                        <td> <?= $value->descripcion ?? '' ?>  </td>
                        <td> <?= $value->marca ?? '' ?>  </td>
                        <td> <?= $value->modelo ?? '' ?>  </td>
                        <td> <?= $value->serie ?? '' ?>  </td>
                        <td> <?= $value->estado ?? '' ?>  </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="acta-notificacion-final">
        Para constancia que la entrega se realizó conforme a lo descrito, firman original 
        y una copia las personas anteriores indicadas 
    </div>
    <div class="acta-firmas">
        <section>
            <header> ENTREGUE CONFORME </header>
            <p>
                <?= $datos['nombre'] ?>
                <br>
                CI:<?= $datos['cedula'] ?>
            </p>
        </section>
        <section>
            <header> RECIBE CONFORME </header>
            <p>
                <?= $datos['receptor'] ?>
                <br>
                <?= $datos['cargo2'] ?>
            </p>
        </section>
    </div>
</div>

<div class="">
    <button  class="button-generate-acta-final" id="button-generate-acta-final">
        Generar PDF
    </button>
</div>