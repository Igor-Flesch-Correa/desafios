<?php
// docker run -d -v C:\Users\Master\Desktop\imply\desafios\desafioextra:/var/www/html --name desafioextra php:8.3.2-apache

require_once __DIR__ . "/Item.php";
require_once __DIR__ . "/Mochila.php";
require_once __DIR__ . "/LeitorDadosCSV.php";
require_once __DIR__ . "/SimulatedAnnealing.php";

$ObjetoDadosCSV = new LeitorDadosCSV(__DIR__."/dados.csv");

echo "Capacidade da mochila: ";
echo $capacidade = $ObjetoDadosCSV->retornarCapacidade();

echo "\n\nItens: \n";
$Itens = $ObjetoDadosCSV->retornarItens();//dados array de objetos item


foreach ($Itens as $item) {
    $item->mostrarDados();
}
//fim do print inicial
//inicio do programa

$temperaturaInicial = 100;
$taxaDeResfriamento = 0.99;
$temperaturaFinal = 0.2;
$numInteracoes = 20;

$programa = new SimulatedAnnealing($temperaturaInicial, $taxaDeResfriamento, $numInteracoes, $temperaturaFinal);
//recebe itens e capacidade e cria e muda as mochilas aqui dentro
$programa->resolver($Itens,$capacidade);

?>