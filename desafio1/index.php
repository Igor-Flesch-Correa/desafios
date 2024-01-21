<?php
/*      
abrir container com imagem teste
docker run -dp 8080:80 -v C:\Users\ilsidonia\Desktop\estagioimply\desafios\desafio1:/var/www/html --name desafioum php:8.3.1-apache

docker cp /home/imply/Área\ de\ Trabalho/desafios/desafio1 compassionate_antonelli:/var/www/html/
  

docker exec -it compassionate_antonelli php /var/www/html/desafio1/index.php
   */
  require_once __DIR__.'/pedeDimensao.php';
  require_once __DIR__.'/testaSeMultiplica.php';
  require_once __DIR__.'/pedeNumeros.php';
  require_once __DIR__.'/mostraMatriz.php';
  require_once __DIR__.'/multiplicaMatriz.php';


//pega dimensão primeira matriz
$pede = "Escreva as dimensoens da primeira matriz a ser multiplicada no formato 1x1:";
$dim_A = pedeDimensao($pede);


//pega dimensão segunda matriz
$pede = "Escreva as dimensoens da segunda matriz a ser multiplicada no formato 1x1:";
$dim_B = pedeDimensao($pede);
while(!testaSeMultiplica($dim_A["coluna"],$dim_B["linha"]))
{
  $pede = " 
  \nMas infelizmente não da para multiplicar essa matriz pela primeira, 
  \no numero de colunas da primeira é diferente do numero de linhas da segunda
  \nescreva outra dimensão para a segunda matriz:\n";

  $dim_B = pedeDimensao($pede);
}

//inserir dados na matriz, mostrar grade for,função pega,função mostra fim, loop
$matrizA = pedeNumeros($dim_A,"primeira");
$matrizB = pedeNumeros($dim_B,"segunda");

echo "\n------------------------------------------------------\n";
mostraMatriz($matrizA);
echo "\n------------------------------------------------------\n";
mostraMatriz($matrizB);

//calcula, só funciona pq checa se o numero de colunasA é igual a numero de linhasB na entrada
$resultado = multiplicaMatriz($matrizA,$matrizB);
echo "\n\n Resultado:\n";
mostraMatriz($resultado);
echo "\n\n";
?>