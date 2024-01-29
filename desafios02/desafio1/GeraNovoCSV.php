<?php
class GeraNovoCSV {
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

    public function Gera() {
        $file1Data = $this->readCSV($this->file1);
        $file2Data = $this->readCSV($this->file2);

        // Processar apenas a primeira coluna do primeiro arquivo
        $IdProdutos = array_column($file1Data, 0);
        $Preco = array_column($file1Data, 2);


        // Aqui você pode adicionar lógica adicional para manipular os dados
        // Por exemplo, combiná-los com dados do segundo arquivo, etc.

        $ponteiro2 = fopen($this->newFile, "w");

        
    

      
        

        // Exemplo: Imprimir os valores da primeira coluna do primeiro arquivo
        foreach ($IdProdutos as $value) {
            echo "Valor: $value\n";
            fputcsv($ponteiro2, [$value]);

        }

       
        fclose($ponteiro2);
    }
}

// Uso da classe
new GeraNovoCSV(__DIR__. '/products.csv',__DIR__.'/orders.csv',__DIR__.'/novo.csv');


?>