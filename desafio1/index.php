<?php
/*      
abrir container com imagem teste
docker run -dp 8080:80 -v C:\Users\ilsidonia\Desktop\estagioimply\desafios\desafio1:/var/www/html --name desafioum php:8.3.1-apache

docker cp /home/imply/Área\ de\ Trabalho/desafios/desafio1 compassionate_antonelli:/var/www/html/
  

docker exec -it compassionate_antonelli php /var/www/html/desafio1/index.php
   */
  require_once __DIR__.'/verificaFormato.php';



$pede = "Escreva as dimensoens da primeira matriz a ser multiplicada no formato 1x1:";
$dim_A = pedeDimensao($pede)."\n";//vem do verificaFormato.php tbm testa o formato
echo $dim_A;//ainda esta em string tem q converter

$pede = "Escreva as dimensoens da segunda matriz a ser multiplicada no formato 1x1:";
$dim_B = pedeDimensao($pede)."\n";//vem do verificaFormato.php
echo $dim_B;

//funcao explodir e linha cod testar se numcolunasA == numlinhasB,  se nao pedeDimensao 
echo "teste fim";
?>