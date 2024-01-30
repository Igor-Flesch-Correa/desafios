<?php
//docker run -dp 8080:80 -v /home/imply/Área\ de\ Trabalho/desafios/desafios02/desafio1:/var/www/html  --name desafioum php:8.3.2-apache

//docker run -dp 8080:80 -v C:\Users\ilsidonia\Desktop\estagioimply\desafios\desafio02/desafio1:/var/www/html --name desafioum php:8.3.2-apache

include_once 'GeraNovoCSV.php';
include_once 'MandaEmailCSV.php';


$productsFilePath =__DIR__. '/products.csv';
$ordersFilePath =__DIR__.'/orders.csv';
$NewCSVFilePath =__DIR__.'/novo.csv';

new GeraNovoCSV($productsFilePath, $ordersFilePath, $NewCSVFilePath );


?>


