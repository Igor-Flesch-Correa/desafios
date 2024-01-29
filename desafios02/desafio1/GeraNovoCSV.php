<?php
class GeraNovoCSV {
    private $file1;
    private $file2;

    public function __construct($file1Path, $file2Path) {
        $this->file1 = $file1Path;
        $this->file2 = $file2Path;
    }

    private function readCSV($filename) {
        $data = [];
        if (($ponteiro = fopen($filename, "r")) !== FALSE) {
            while (($row = fgetcsv($ponteiro)) !== FALSE) {
                $data[] = $row; // Armazena cada linha do CSV
            }
            fclose($ponteiro);
        }
        return $data;
    }
    //rewind($ponteiro); volta o ponteiro para primeira linha

    public function processCSVs() {
        $file1Data = $this->readCSV($this->file1);
        $file2Data = $this->readCSV($this->file2);

        // Processar apenas a primeira coluna do primeiro arquivo
        $firstColumnValues = array_column($file1Data, 0);

        // Aqui você pode adicionar lógica adicional para manipular os dados
        // Por exemplo, combiná-los com dados do segundo arquivo, etc.

        // Exemplo: Imprimir os valores da primeira coluna do primeiro arquivo
        foreach ($firstColumnValues as $value) {
            echo "Valor: $value\n";
        }

        // Adicione aqui mais lógica conforme necessário
    }
}

// Uso da classe
$GeraNovoCSV = new GeraNovoCSV('caminho/para/arquivo1.csv', 'caminho/para/arquivo2.csv');
$GeraNovoCSV->processCSVs();

?>