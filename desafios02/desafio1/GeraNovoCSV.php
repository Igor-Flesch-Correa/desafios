<?php
class GeraNovoCSV 
{
    private $file1;
    private $file2;
    private $newFile;

    public function __construct($file1Path, $file2Path, $newFilePath) {
        $this->file1 = $file1Path;
        $this->file2 = $file2Path;
        $this->newFile = $newFilePath;
        $this->Gera();
    }

    private function readCSV($filename) {
        $data = [];
        if (($ponteiro = fopen($filename, "r")) !== FALSE) {
            fgetcsv($ponteiro);
            while (($lina = fgetcsv($ponteiro)) !== FALSE) {
                $data[] = $lina; // Armazena cada linha do CSV
            }
            fclose($ponteiro);
        }
        return $data;
    }
    //rewind($ponteiro); volta o ponteiro para primeira linha

    public function Gera() 
    {
        $file1Data = $this->readCSV($this->file1);
        $file2Data = $this->readCSV($this->file2);

        // Logica de filtragem. salvar todos arrais junto com id?
        $IdProdutos = array_column($file1Data, 0);

        $Precos = array_column($file1Data, 2);

        $UltimaData = [];
        foreach ($file2Data as $linha) {
            $id = $linha[1];
            $data = $linha[2];

            if (!isset($UltimaData[$id]) || strtotime($data) > strtotime($UltimaData[$id])) {
                $UltimaData[$id] = $data; //datas salvas com id como chave falta colocar em ordem
            } 
        }

        $QuantidadeSomada = [];
        foreach ($file2Data as $linha) {
            $id = $linha[1];
            $quantidade = $linha[3];

            if (!isset($QuantidadeSomada[$id])) 
            {
                $QuantidadeSomada[$id] = 0;
            }

            $QuantidadeSomada[$id] += $quantidade;
        }
        




        $ponteiro2 = fopen($this->newFile, "w");

        fputcsv($ponteiro2, ['Id Produto','Preços','Data ultima ordem','quantidade vendida','Valor total']);//escreve


        // pega os arrays e junta em linhas(array novo)
        for ($i = 0; $i < count($IdProdutos); $i++) {

            
            if (!isset($UltimaData[$IdProdutos[$i]])) 
            {
                $CloneUltimaData = "sem registro";
            }
            else 
            {
                $CloneUltimaData = $UltimaData[$IdProdutos[$i]];
            }

            
            if (!isset($QuantidadeSomada[$IdProdutos[$i]])) 
            {
                $CloneQuantidadeSomada = "sem registro";
            } 
            else
            {
                $CloneQuantidadeSomada = $QuantidadeSomada[$IdProdutos[$i]];  
            } 

            $ValorTotalVendido = floatval($Precos[$i]) * floatval($CloneQuantidadeSomada);

            

            // Combine o elemento atual de cada coluna em um array
            $linha = [$IdProdutos[$i], $Precos[$i], $CloneUltimaData, $CloneQuantidadeSomada, $ValorTotalVendido];//colocar o resto...
            
            fputcsv($ponteiro2, $linha);//escreve
        }

        fclose($ponteiro2);
    }

       
        
}



// Uso da classe
new GeraNovoCSV(__DIR__. '/products.csv',__DIR__.'/orders.csv',__DIR__.'/novo.csv');


?>