<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href='/css/bootstrap.min.css'>
    <title>Document</title>
</head>
<body>
    
<?php
include __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../../controllers/NewsAdminController.php';

// $controller = new NewsAdminController();
// $controller->seeAll();

?>
<h1>Gestión de noticias</h1>

<button class="btn btn-primary rounded-pill">Ver todas la noticias</button>

<section class="d-flex">
<div class="card" style="width: 18rem;">
  <ul class="list-group list-group-flush">
    <li class="list-group-item">noticia uno</li>
    <li class="list-group-item">noticia dos</li>
    <li class="list-group-item">noticia tres</li>
    <li class="list-group-item">noticia cuatro</li>
  </ul>
</div>
<div class="card" style="width: 18rem;">
  <ul class="list-group list-group-flush">
    <li class="list-group-item">noticia cinco</li>
    <li class="list-group-item">noticia seis</li>
    <li class="list-group-item">noticia siete</li>
    <li class="list-group-item">noticia ocho</li>
  </ul>
</div>

</section>

<script src="/js/bootstrap.bundle.min.js"></script>

<script>
    /*
    // Función para generar las tarjetas de noticias
    function renderNews(news) {
        const newsSection = document.getElementById('newsSection');
        newsSection.innerHTML = '';  // Limpiar cualquier contenido anterior

        news.forEach(noticia => {
            const card = document.createElement('div');
            card.className = 'card';
            card.style.width = '18rem';
            card.innerHTML = `
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Título:</strong> ${noticia.titulo}</li>
                    <li class="list-group-item">${noticia.texto}</li>
                </ul>
            `;
            newsSection.appendChild(card);
        });
    }

    // Función para obtener las noticias del servidor
    function fetchNews() {
        fetch('/newsAdmin', {  // La ruta a tu controlador que devuelve el JSON
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();  // Convertir la respuesta a JSON
        })
        .then(data => {
            console.log('Noticias:', data);  // Para depuración
            if (data.error) {
                alert('No se encontraron noticias');
            } else {
                renderNews(data);  // Renderizar las noticias en la página
            }
        })
        .catch(error => {
            console.error('Error al obtener las noticias:', error);
            alert('Hubo un error al obtener las noticias.');
        });
    }

    // Evento para el botón "Ver todas las noticias"
    document.getElementById('loadNewsBtn').addEventListener('click', fetchNews); */
</script>



</body>
</html>
