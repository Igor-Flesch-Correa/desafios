<?php


include_once 'GeraNovoCSV.php';
include_once 'EmailSender.php';


$productsFilePath =__DIR__. '/products.csv';
$ordersFilePath =__DIR__.'/orders.csv';
$NewCSVFilePath =__DIR__.'/novo.csv';

new GeraNovoCSV($productsFilePath, $ordersFilePath, $NewCSVFilePath );

$emailSender = new EmailSender();
$emailSender->sendEmail('icorrea@imply.com', 'Assunto teste', 'Bom dia', __DIR__ . '/novo.csv');


?>


