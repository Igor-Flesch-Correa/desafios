<?php

require_once __DIR__ . '/../Controller/Controller.php';
require_once __DIR__ . '/../Model/APIClient.php';

class Router
{
    public function route(Request $request, Controlador $controller) {
        $uri = $request->getUri();


        //var_dump($uri); //linha para depuração

        //Aqui é verificado o que é passado na URl para rotear o resutado dos desafios.  

        if (preg_match('/\/\?page=[0-9]+/', $uri)) {
            $controller->Desafio2($request);
        } elseif (preg_match('/\/pokemon\/([^\/]+)/', $uri, $matches)) {
            $pokemonName = $matches[1];
            $requestWithPokemonName = new Request($request->getMethod(), $pokemonName);
            $controller->Desafio3($requestWithPokemonName);
        } else {
            // Lógica para lidar com rotas desconhecidas
            echo json_encode(['message' => 'Unknown route: ' . $uri]);
        }
    }
}

?>