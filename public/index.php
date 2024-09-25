<link rel="stylesheet" href="/css/bootstrap.min.css">
<script src="/js/bootstrap.bundle.min.js"></script>

<?php
require_once '../app/router/Route.php';
require_once '../app/router/routes.php';
require_once '../app/models/NewsAdminModel.php';
//require_once '../app/controllers/NewsAdminController.php';


 //require_once '../app/models/Conexion.php';
 //NewsAdminModel::seeAllNews();
 /* $noticia = NewsAdminModel::seeNew();

if ($noticia) {
    
        echo "<h2>" . htmlspecialchars($noticia['titulo']) . "</h2>";
        echo "<p>" . htmlspecialchars($noticia['texto']) . "</p>"; // Asegúrate de que estos campos existan en tu tabla
    
} else {
    echo "No hay noticias disponibles.";
} 
    */
// require_once '../app/models/RegisterModel.php';
 Route::dispatch();
// RegisterModel::muestra();

//Conexion::connect();

/*
$noticias = NewsAdminModel::seeAllNews();
if ($noticias) {
    foreach ($noticias as $noticia) {
        // Muestra los datos de cada noticia
        echo "<h2>" . htmlspecialchars($noticia['titulo']) . "</h2>";
        echo "<p>" . htmlspecialchars($noticia['texto']) . "</p>"; // Asegúrate de que estos sean los campos correctos
    }
} else {
    echo "No hay noticias disponibles.";
}

$controller = new NewsAdminController();
$controller->seeAll(); */
?>


<script>
        // fetch('http://localhost:3000/newsAdmin', {
        //     method: 'GET',
        //     headers: {
        //         'Content-Type': 'application/json'
        //     }
        // })
        // .then(response => {
        //     if (!response.ok) {
        //         throw new Error('Error en la respuesta');
        //     }
        //     return response.json(); // Convertir la respuesta a JSON
        // })
        // .then(data => {
        //     console.log('Noticias:', data); // Manejar la respuesta JSON
        //     alert(JSON.stringify(data)); // Mostrar las noticias en una alerta
        // })
        // .catch(error => {
        //     console.error('Error al obtener las noticias:', error); // Manejar errores
        //     alert('Error al obtener las noticias');
        // });
    </script>