<?php
/*
$filename = 'test.jpeg'; // Nombre del archivo que quieres mostrar
$filePath = __DIR__ . '/../uploads/' . $filename; // Ruta al archivo

echo $filePath . '<br>';

// Verifica si el archivo existe
if (file_exists($filePath)) {
    //header('Content-Type: image/jpeg'); // Cambia esto si tu imagen no es JPEG
    $mimeType = mime_content_type($filePath);
    header('Content-Type: ' . $mimeType);
    readfile($filePath); // Muestra el archivo
    exit;
} else {
    echo "Archivo no encontrado.";
} */
?>

<?php
$filename = '1727773296_fondos-de-pantalla-hd-juegos-xbox.jpg'; // Nombre del archivo que quieres mostrar
//$filePath = __DIR__ . '/../uploads/' . $filename; // Ruta al archivo
$filePath = realpath(__DIR__ . '/../uploads/' . $filename);


 //Imprimir la ruta para depuración
echo "Buscando archivo en: $filePath <br>";

// Verifica si el archivo existe
if (file_exists($filePath)) {
    ob_clean();
    header('Content-Type: image/jpeg'); // Este encabezado debe ser lo primero que se envía
    readfile($filePath); // Lee el archivo y lo envía directamente al navegador
    echo "Archivo encontrado. Puedes encontrar la imagen en la ruta mostrada arriba.<br>";
    exit; // Detener el script aquí para verificar la ruta
} else {
    echo "Archivo no encontrado.";
    exit;
}

