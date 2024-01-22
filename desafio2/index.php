<?php
/*     

lembretes


abrir container com imagem teste
casa
docker run -dp 8080:80 -v C:\Users\ilsidonia\Desktop\estagioimply\desafios\desafio2:/var/www/html --name desafiodois php:8.3.1-apache

imply
docker run -dp 8080:80 -v /home/imply/Área\ de\ Trabalho/desafios/desafio2:/var/www/html --name desafiodois php:8.3.2-apache
//usar esse, abri ws no cod
docker run -d -v /home/imply/Área\ de\ Trabalho/desafios/desafio2:/var/www/html --name desafiodois php:8.3.2-apache


docker cp /home/imply/Área\ de\ Trabalho/desafios/desafio1 desafioum:/var/www/html/
  
docker exec -it desafioum php /var/www/html/desafio1/index.php
   */





  
if (php_sapi_name() === 'cli') { //checa se esta rondando no CLI(terminal)
    // Código de escape ANSI para limpar o terminal
    echo "\033[2J\033[H";
    

  $endpoint = 'https://pokeapi.co/api/v2/pokemon?limit=10000&offset=0';

  //iniciar
  $cURL = curl_init();

  //seta url
  curl_setopt($cURL, CURLOPT_URL, $endpoint);
  //diz q quero capturar resultado
  curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
  //executa requisição e armazena resposta
  $resposta = curl_exec($cURL);

  //se ocorrer erro
  if(curl_errno($cURL))
  {
      echo curl_errno($cURL);
  } else {
    fwrite(STDOUT,"\n\nrequisicao executada para : {$endpoint}\n");
  }

  //fechar
  curl_close($cURL);

    
    // Decodifica a resposta JSON para array php
    $dados = json_decode($resposta, true);

    // Verifica se a decodificação foi bem-sucedida
    if ($dados === null) {
        die('Erro ao decodificar JSON');
    }

    // Salva os dados em .txt
    $file_path = __DIR__ . '/resposta.json.txt';

    //MODIFICAR PARA FOPEN-----------------
    file_put_contents($file_path, json_encode($dados, JSON_PRETTY_PRINT));//JSON_PRETTY_PRINT formata .txt para ficar mais legivel

    fwrite(STDOUT, "\n\nResposta JSON salva em :" . $file_path);
    fwrite(STDOUT,"\n\n");

 $serverAddress = '0.0.0.0:8080';

  echo "Iniciando servidor web em http://{$serverAddress}\n";
    
  // Inicia o servidor web embutido
  exec("php -S {$serverAddress} " . __FILE__); 
}// essa chave marca final de tudo que 'e executado somente no terminal




//apartir daqui aparece no webserver----------------------------------------------------------------------

    echo "teste";

    // estudar abaixo essa parte de mandar os dados pode ser em arquivo separado talvez, se bem q vou receber junto com a solicitaç~ao
    
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Checa parâmetro, se não tiver, atribui 1
    $perPage = 15;

    
    $file = fopen(__DIR__ . '/resposta.json.txt', 'r');
    if ($file) {
    $savedData = fread($file, filesize(__DIR__ . '/resposta.json.txt'));
    fclose($file);
    $pokemonData = json_decode($savedData, true);

    // Paginação
    $startIndex = ($page - 1) * $perPage;
    $pagedData = array_slice($pokemonData['results'], $startIndex, $perPage);

    // Define o cabeçalho para indicar que o conteúdo é JSON
    header('Content-Type: application/json; charset=utf-8');

    // Retorna os dados paginados como JSON
    echo json_encode($pagedData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);// n~ao esta saindo formatdo
} else {
    echo "Não foi possível abrir o arquivo.";
}

//exemplo de requisiçao: curl http://localhost:8080/index.php?page=1

 

?>