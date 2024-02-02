<?php

require_once __DIR__ . '/../Request/Request.php';
require_once __DIR__ . '/../Model/APIClient.php';



class Controlador
{
    private $ApiClient;

    public function __construct(ApiClient $ApiClient)
    {
        $this->ApiClient = $ApiClient;
    }

    public function Desafio2(Request $request)
    {
        $message = 'Read from file.';

        // Aqui verificamos se o arquivo que salva os dados existe.
        if (!file_exists('all.txt')) {
            // Define o número de registros que queremos trazer da API do pokémon.
            $limit = 150;

            // Atualizando a mensagem para sabermos que a sub-rotina de busca da API rodou.
            $message = 'Fetched from API.';

            // Chamando o método que faz a consulta à API, passando o limite que definimos.
            $response = $this->ApiClient->get("pokemon?limit=$limit");

            // Função utilizada para formatar os dados que obtivemos da API para um retorno mais próximo do desejado.
            $data = array_map(function ($data) {
                return $data["name"];
            }, $response['results']);

            // Escrevendo o nosso arquivo com todos os pokémon.
            file_put_contents('all.txt', json_encode($data));
        }

        // Buscando os dados do nosso arquivo criado.
        $PegarArquivo = file_get_contents('all.txt');

        // Convertendo os dados para um array.
        $todos = json_decode($PegarArquivo, true, JSON_PRETTY_PRINT);

        $page = (int)$_GET['page'] ?? 1;

        // Definição de quantos resultados queremos por página.
        $resultsPerPage = 15;

        // Validação para uma página mínima.
        if ($page < 1) {
            $page = 1;
        }

        // Validação para uma página máxima.
        if ($page * $resultsPerPage > count($todos)) {
            // Se não, é calculada a página máxima que teria resultados e é definida como a página escolhida.
            $page = ceil(count($todos) / $resultsPerPage);
        }

        // Função para pegar o subconjunto de dados da página informada pelo usuário.
        $retorno = array_slice($todos, ($page - 1) * $resultsPerPage, $resultsPerPage);

        // Aqui são impressos os dados que coletamos no formato JSON.
        
        
        echo "<pre>";
        echo json_encode([
            'message' => $message,
            'page' => $page,
            'data' => $retorno,
        ], JSON_PRETTY_PRINT);
        echo "</pre>";
        
        exit;
    }

    public function Desafio3(Request $request)
    {
        $message = 'Read from file.';

        // Extrai o nome do Pokémon da rota.
        $searched = $request->getUri(1);

        // Aqui verificamos se o arquivo que salva os dados existe.
        if (!file_exists("$searched.txt")) {
            // Atualizando a mensagem para sabermos que a sub-rotina de busca da API rodou.
            $message = 'Fetched from API.';

            // Chamando o método que faz a consulta à API, passando o nome do pokémon desejado.
            $response = $this->ApiClient->get("pokemon/$searched");

            // Criação do formato base que desejamos que nossos dados sejam salvos.
            $formatted = [
                'name' => $response['name'],
                'stats' => []
            ];

            // Percorremos os stats retornados pela API e populamos as chaves dos stats do nosso conteúdo formatado.
            foreach ($response['stats'] as $stat) {
                $formatted['stats'][$stat['stat']['name']] = $stat['base_stat'];
            }

            // Gravamos o arquivo com o nome do pokémon pesquisado e os dados formatados.
            file_put_contents("$searched.txt", json_encode($formatted, JSON_PRETTY_PRINT));
        }

        // Buscando os dados do nosso arquivo criado.
        $fileContent = file_get_contents("$searched.txt");

        // Aqui são impressos os dados que coletamos no formato JSON.
        
        echo "<pre>";
        echo json_encode([
            'message' => $message,
            'pokemon' => json_decode($fileContent),
        ], JSON_PRETTY_PRINT);
        echo "</pre>";

        exit;
    }
}

?>
