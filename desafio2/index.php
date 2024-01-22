<?php
/*      
abrir container com imagem teste
casa
docker run -dp 8080:80 -v C:\Users\ilsidonia\Desktop\estagioimply\desafios\desafio2:/var/www/html --name desafiodois php:8.3.1-apache
imply
docker run -dp 8080:80 -v /home/imply/Área\ de\ Trabalho/desafios/desafio2:/var/www/html --name desafiodois php:8.3.2-apache


docker cp /home/imply/Área\ de\ Trabalho/desafios/desafio1 desafioum:/var/www/html/
  
docker exec -it desafioum php /var/www/html/desafio1/index.php
   */
  
   if (php_sapi_name() === 'cli') {
    // Código de escape ANSI para limpar o terminal
    echo "\033[2J\033[H";
    } 

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
      echo"\n\nrequisicao executada para : {$endpoint}\n";
  }

  //fechar
  curl_close($cURL);
//modificar daqui pra baixo
// Decodifica a resposta JSON
$dados = json_decode($resposta, true);

// Verifica se a decodificação foi bem-sucedida
if ($dados === null) {
    die('Erro ao decodificar JSON');
}

// Salva os dados em um arquivo .txt
$file_path = __DIR__ . '/resposta.json.txt';
file_put_contents($file_path, json_encode($dados, JSON_PRETTY_PRINT));

echo "\n\nResposta JSON salva em :" . $file_path;
echo "\n\n";

  ?>