<?php
//docker run -dp 8080:80 -v /home/imply/Área\ de\ Trabalho/desafios/desafios02/desafio1:/var/www/html/projeto  --name desafioum emailsender

//docker run -dp 8080:80 -v C:\Users\ilsidonia\Desktop\estagioimply\desafios\desafios02/desafio1:/var/www/html/projeto --name desafioum emailsender
//composer require phpmailer/phpmailer 
include_once 'GeraNovoCSV.php';
include_once 'EmailSender.php';


$productsFilePath =__DIR__. '/products.csv';
$ordersFilePath =__DIR__.'/orders.csv';
$NewCSVFilePath =__DIR__.'/novo.csv';

new GeraNovoCSV($productsFilePath, $ordersFilePath, $NewCSVFilePath );


?>


