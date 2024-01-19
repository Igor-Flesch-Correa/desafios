<?php
/*      
abrir container com imagem docker run -dp 8080:80 --name desafioum php:8.3.1-apache

docker cp /home/imply/Área\ de\ Trabalho/desafios/desafio1 compassionate_antonelli:/var/www/html/
  

docker exec -it compassionate_antonelli php /var/www/html/desafio1/index.php
   */
  require_once __DIR__.'/verificaFormato.php';



$pede = "Escreva as dimensoens da primeira matriz a ser multiplicada no formato 1x1:";
echo pedeDimensao($pede)."\n";//vem do verificaFormato.php tbm testa o formato
$pede = "Escreva as dimensoens da segunda matriz a ser multiplicada no formato 1x1:";
echo pedeDimensao($pede)."\n";//vem do verificaFormato.php


echo "teste fim";
?>