<?php


$url = "PrintGuias.php?orden=122080&copias=1&guia_o=GE0005882&guia_f=GE0005882&sort=id&tipo_guia=GNE&fecha_i=2018-03-05&extquery=_SESSION&horprint=NO&nguia_o=&nguia_f=&printdocumento=NO";


echo $cadena = file_get_contents($url);

exit;
$im     = imagecreatefrompng("images/boton1.png");
$naranja = imagecolorallocate($im, 220, 210, 60);
$px     = (imagesx($im) - 7.5 * strlen($cadena)) / 2;
imagestring($im, 3, $px, 9, $cadena, $naranja);
imagepng($im);
imagedestroy($im);