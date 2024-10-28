<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href='/css/bootstrap.min.css'>
    <title>Noticias Cliente</title>
</head>
<body>
    
<?php
include 'includes/navbar.php';
?>
<h2>Sección de noticias</h2>
<hr class="mb-4">

<!-- <button class="open-notices btn btn-warning">Abrir Noticias</button> -->

<div id="list-notices" class="container">
    <div class="row gx-4 gy-4" id="notices-row">
        <!-- Aquí se insertarán las tarjetas de forma dinámica -->
    </div>
</div>


<?php
include 'includes/footer.php';
?>
<script src="/js/bootstrap.bundle.min.js"></script>
<!-- <script type="module" src="/js/notices.js"></script> -->
<script src="/js/notices.js"></script>
</body>
</html>