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
   

    private function Gera() 
    {
        $file1Data = $this->readCSV($this->file1);
        $file2Data = $this->readCSV($this->file2);

        
        $IdProdutos = array_column($file1Data, 0);

        $Precos = array_column($file1Data, 2);

        $UltimaData = [];
        foreach ($file2Data as $linha) {
            $id = $linha[1];
            $data = $linha[2];

            if (!isset($UltimaData[$id]) || strtotime($data) > strtotime($UltimaData[$id])) 
            {
                $UltimaData[$id] = $data; 
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

            

            
            $linha = [$IdProdutos[$i], $Precos[$i], $CloneUltimaData, $CloneQuantidadeSomada, $ValorTotalVendido];//colocar o resto...
            
            fputcsv($ponteiro2, $linha);
        }

        fclose($ponteiro2);
    }

       
        
}



