<?php
session_start();
function randomText($length) {
    $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
    for($i=0;$i<$length;$i++) {
      $key .= $pattern{rand(0,35)};
    }
    return $key;
}

$_SESSION['tmptxt'] = randomText(7);
// Establecer el tipo de contenido
// Crear la imagen
$im = imagecreatefromgif("captcha.gif");
// Crear algunos colores
$negro = imagecolorallocate($im, 0, 0, 0);
// El texto a dibujar
$texto = $_SESSION['tmptxt'];
// Reemplace la ruta por la de su propia fuente
$fuente = 'FT91.TTF';
// Añadir el texto
imagettftext($im, 33, 0, 5, 45, $negro, $fuente, $texto);

// Usar imagepng() resultará en un texto más claro comparado con imagejpeg()
header('Content-Type: image/png');
imagepng($im);
imagedestroy($im);
?>