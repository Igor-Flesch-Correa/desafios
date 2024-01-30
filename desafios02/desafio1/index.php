<?php
//docker run -dp 8080:80 -v /home/imply/Área\ de\ Trabalho/desafios/desafios02/desafio1:/var/www/html/projeto  --name desafioum emailsender

<<<<<<< HEAD
//docker run -dp 8080:80 -v C:\Users\ilsidonia\Desktop\estagioimply\desafios\desafios02\desafio1:/var/www/html --name desafioum php:8.3.2-apache
=======
//docker run -dp 8080:80 -v C:\Users\ilsidonia\Desktop\estagioimply\desafios\desafio02/desafio1:/var/www/html/projeto --name desafioum emailsender
//composer require phpmailer/phpmailer 
include_once 'GeraNovoCSV.php';
include_once 'EmailSender.php';
>>>>>>> 0d8b1993bd7e592094b9bd8b694168f7d021c332


$productsFilePath =__DIR__. '/products.csv';
$ordersFilePath =__DIR__.'/orders.csv';
$NewCSVFilePath =__DIR__.'/novo.csv';

new GeraNovoCSV($productsFilePath, $ordersFilePath, $NewCSVFilePath );


?>


