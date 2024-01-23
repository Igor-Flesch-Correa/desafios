<?php
/*     

lembretes


abrir container com imagem teste
casa
docker run -d -v C:\Users\ilsidonia\Desktop\estagioimply\desafios\desafio2:/var/www/html --name desafiodois php:8.3.2-apache

imply
docker run -dp 8080:80 -v /home/imply/Área\ de\ Trabalho/desafios/desafio2:/var/www/html --name desafiodois php:8.3.2-apache
//usar esse, abri ws no cod
docker run -d -v /home/imply/Área\ de\ Trabalho/desafios/desafio2:/var/www/html --name desafiodois php:8.3.2-apache


docker cp /home/imply/Área\ de\ Trabalho/desafios/desafio1 desafioum:/var/www/html/
  
docker exec -it desafioum php /var/www/html/desafio1/index.php
   */





  
if (php_sapi_name() === 'cli') { //checa se esta rondando no CLI(terminal)
     

  $endpoint = 'https://pokeapi.co/api/v2/pokemon?limit=150&offset=0'; //limit = quantos pokemon pegar da api

  //iniciar
  $cURL = curl_init();

  //seta url
  curl_setopt($cURL, CURLOPT_URL, $endpoint);
  //diz q quero capturar resultado
  curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
  //executa requisição e armazena resposta JSON
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

    
    // Decodifica a resposta JSON para array php    inicia salvar no arquivo---
    $dados = json_decode($resposta, true);

    
    //deixa só os nomes
    foreach ($dados['results'] as $pokemonn) 
    {
    // Adiciona diretamente o nome ao novo array
    $novoArrayNomes[] = $pokemonn['name'];
    }
    $dados = $novoArrayNomes;
    
  
    
    //echo $test;
    var_dump($dados);


    // Verifica se a decodificação foi bem-sucedida
    if ($dados === null) {
        die('Erro ao decodificar JSON');//die mata a execução do script
    }

    // define onde vai salvar os dados em .txt
    $file_path = __DIR__ . '/resposta.json.txt';

    //MODIFICAR PARA FOPEN-----------------
    $file = fopen($file_path, 'w');

    // Escreve os dados no arquivo usando fwrite
    fwrite($file, json_encode($dados, JSON_PRETTY_PRINT));
    // Fecha o arquivo após a escrita
    fclose($file);
    
    echo "\n\nResposta JSON salva em : {$file_path}";   //termina salvar no arquivo---
    echo"\n\n";

 $serverAddress = '0.0.0.0:8080';

  echo "Iniciando servidor web em http://{$serverAddress}\n";
    
  // Inicia o servidor web embutido
  exec("php -S {$serverAddress} " . __FILE__); //comando shell(terminal)
}// essa chave marca final de tudo que 'e executado somente no terminal




//apartir daqui aparece no webserver----------------------------------------------------------------------

    

    // estudar abaixo essa parte de mandar os dados pode ser em arquivo separado talvez, se bem q vou receber junto com a solicitaç~ao
    
    $pagAtual = isset($_GET['page']) ? intval($_GET['page']) : 1; // Checa parâmetro foi passado(isset), transforma em int, se não , atribui 1,
    $porPagina = 15;

    
    $file = fopen(__DIR__ . '/resposta.json.txt', 'r');
    if ($file) {
    $arquivo = fread($file, filesize(__DIR__ . '/resposta.json.txt'));
    fclose($file);
    $dadosArquivoJson = json_decode($arquivo, true);

    // Paginação
    $inicPagina = ($pagAtual - 1) * $porPagina;
    $dadosCortados = array_slice($dadosArquivoJson, $inicPagina, $porPagina);//corta pedaço dos dados do arquivo que viraram Json de volta

    // Define o cabeçalho para indicar que o conteúdo é JSON
    header('Content-Type: application/json; charset=utf-8');

    // Retorna os dados paginados como JSON
    echo json_encode($dadosCortados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);//formata e mantem caracteres especiais de boa
} else {
    echo "Não foi possível abrir o arquivo.";
}

//exemplo de requisiçao: curl http://localhost:8080/index.php?page=1

 

?>