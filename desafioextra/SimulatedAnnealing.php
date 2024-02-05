<?php
//dependencia:Mochila.php, é chamada no index nesse caso
class SimulatedAnnealing {
    private $temperaturaInicial;
    private $taxaDeResfriamento;
    private $temperaturaFinal;
    private $numInteracoes;

    public function __construct(float $temperaturaInicial, float $taxaDeResfriamento, int $numInteracoes, float $temperaturaFinal) {
        $this->temperaturaInicial = $temperaturaInicial;
        $this->taxaDeResfriamento = $taxaDeResfriamento;
        $this->temperaturaFinal = $temperaturaFinal;
        $this->numInteracoes = $numInteracoes;
    }

    public function resolver(array $itens,$capacidade) 
    {   
        $temperatura = $this->temperaturaInicial;

        $mochilaAtual = new Mochila($capacidade);
        $mochilaVizinha = new Mochila($capacidade);
        $mochilaMelhor = new Mochila($capacidade);

        while($temperatura > $this->temperaturaFinal)//loop principal
        {
            for($cont = 0; $cont < $this->numInteracoes; $cont++)//loop secundario
            {

                // pega item aleatoriamente
                $ItemAleatorio = $itens[array_rand($itens)];//array_rand($itens) retorna chave aleatória

                //adiciona item testa se repete e se passa do peso da mochila
                // se não da pra adicionar retorna fase e tenta add de novo
                //gera numero inteiro aleatório entre 1 e 3
                $numero = rand(1,3);
                if (empty($mochilaVizinha->getItens())){//não sei o que acontece se a lista esvaziar então coloquei isso
                    $numero = 1;
                }

                switch ($numero) {
                    case '1':
                        $mochilaVizinha->adicionaItem($ItemAleatorio);
                        break;
                    case '2':
                        $mochilaVizinha->removeItemAleatorio();
                        break;
                    case '3':
                        $mochilaVizinha->removeItemAleatorio();
                        $mochilaVizinha->adicionaItem($ItemAleatorio);
                        break;
                }

            
                //passa itens da mochila vizinha para a mochila atual com base em aceitação ou probabilidade variavel
                $util_somado_atual = $mochilaAtual->getTotalUtilidade();
                $util_somado_vizinha = $mochilaVizinha->getTotalUtilidade();

                if ($util_somado_vizinha > $util_somado_atual) {
                    $mochilaAtual = clone $mochilaVizinha;

                } else {
                    // Fórmula probabilística de aceitação
                    $delta = $util_somado_vizinha - $util_somado_atual;
                    $x = mt_rand() / mt_getrandmax();
                    if ($x < exp(-$delta / $temperatura)) {
                        $mochilaAtual = clone $mochilaVizinha;
                    }
                }


                    echo "mochila atual: \n";
                    $mochilaAtual->mostrarItens();
                    
                //verifica se a mochila atual é melhor que a melhor
                if($mochilaAtual->getTotalUtilidade() > $mochilaMelhor->getTotalUtilidade())
                {
                    $mochilaMelhor = clone $mochilaAtual;
                }

            }

            
          //diminui temperatura
          echo"\ntemperatura: ".$temperatura."\n";
          $temperatura *= $this->taxaDeResfriamento;  
        }

        echo "mochila melhor: \n";
        $mochilaMelhor->mostrarItens();
        echo "\n utilidade: " . $mochilaMelhor->getTotalUtilidade() . "\n";
        echo " peso: " . $mochilaMelhor->getTotalPeso() . "\n";
    
    }
        


}