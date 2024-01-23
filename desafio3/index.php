<?php
//colar no cmd
//docker run -d -v /home/imply/Área\ de\ Trabalho/desafios/desafio3:/var/www/html --name desafiotres php:8.3.2-apache

if (php_sapi_name() === 'cli') { //checa se esta rondando no CLI(terminal)
     
    $pokemon = "vaporeon";
    $endpoint = "https://pokeapi.co/api/v2/pokemon/$pokemon"; //limit = quantos pokemon pegar da api
  
      // define onde vai salvar os dados em .txt tem q ser feito antes para checar se ja existe antes de solicitar
      $file_path = __DIR__ . "/$pokemon.txt";
  
     
  
      if (!file_exists($file_path)) {//teste se j'a tem o arquivo, o ideal seria fazer uma logica que substitui uma vez por dia ou algo assim se fosse em producao
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
      fwrite(STDOUT,"\n\nrequisicao executada para : $endpoint\n");
    }
  
    //fechar
    curl_close($cURL);
  
      
      // Decodifica a resposta JSON para array php    inicia salvar no arquivo---
      $dados = json_decode($resposta, true);
  
      /* PROVAVELMENTE N~AO VOU USAR, APAGAR DEPOIS
      //deixa só os nomes
      foreach ($dados['results'] as $pokemonn) 
      {
      // Adiciona diretamente o nome ao novo array
      $novoArrayNomes[] = $pokemonn['name'];
      }
      $dados = $novoArrayNomes;
      */
    
      
      //echo $test;
      var_dump($dados);
  
  
      // Verifica se a decodificação foi bem-sucedida
      if ($dados === null) {
          die('Erro ao decodificar JSON');//die mata a execução do script
      }
  
      
  
      //inicia salva arquivo
      $file = fopen($file_path, 'w');//write, cria arquivo e se existir apaga o que tem dentro
  
      // Escreve os dados no arquivo usando fwrite
      fwrite($file, json_encode($dados, JSON_PRETTY_PRINT));
      // Fecha o arquivo após a escrita
      fclose($file);
      
      echo "\n\nResposta JSON salva em : $file_path";   //termina salvar no arquivo---
      echo"\n\n";
  
    }//chave do if que checa se o arquivo j'a existe para apenas chamar uma vez
  
   $serverAddress = '0.0.0.0:8080';
  
    echo "Iniciando servidor web em http://$serverAddress\n";
      
    // Inicia o servidor web embutido
    exec("php -S $serverAddress " . __FILE__); //comando shell(terminal)
  }// essa chave marca final de tudo que 'e executado somente no terminal
  
  
  
  
  //apartir daqui aparece no webserver----------------------------------------------------------------------
  
    
  
  $nomePokemon = isset($_SERVER['REQUEST_URI']) ? ltrim($_SERVER['REQUEST_URI'], '/') : '';
   
  if (!empty($nomePokemon)) {
      $file_path = __DIR__ . '/' . $nomePokemon . '.txt';//at'e aqui ok
  
      if (file_exists($file_path)) {

        $file = fopen($file_path, 'r');//abre
        $conteudoArquivo = fread($file, filesize($file_path));
        fclose($file);

        // 
        $dadosJson = json_decode($conteudoArquivo, true);

      
        foreach ($dadosJson['stats'] as $base) 
        {
            $stats[] = array(
                'nome' => $base['stat']['name'],
                'valor' => $base['base_stat']
            );
        }//talvez iniciar o webserver no inicio para j'a salvar o nome e requisitar.

  
          // Define o cabeçalho para indicar para o navegador que o conteúdo é texto
          header('Content-Type: application/json; charset=utf-8');

          echo json_encode($stats, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);//formata e mantem caracteres especiais de boa

            
      } else {
          echo "Arquivo não encontrado para o Pokémon: $nomePokemon.";
      }
  } else {
      echo "Nome do Pokémon não foi fornecido na URL.";
  }
/* 
  */
  
  //exemplo de requisiçao: curl http://localhost:8080/vaporeon
  
   
  
  ?>