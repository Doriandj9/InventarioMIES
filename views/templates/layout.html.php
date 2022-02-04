<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/main.css">
    <title> <?= $title ?> </title>
</head>
<body>
    <div class="container">

        <div class="header">
              <a href="/" > 
                   <img class="header__img-sin-fondo __img-tam" src="/public/img/mies_ecuador.jpg" alt="Imagen MIES ECUADOR">
              </a>
              <?php if(isset($_SESSION['ci'])): ?>
              <a class="logout" href="/logout">Cerrar Session</a>
              <?php endif; ?>
        </div>
        <main class="main"><?= $content ?></main>
        <footer class="footer">
            &copy; Derechos reservados 2022 
        </footer>
    </div>
    <script src="/public/js/modules/html2pdf.js/dist/html2pdf.bundle.min.js"></script>
    <script src="/public/js/main.js" type="module"></script>
</body>
</html>