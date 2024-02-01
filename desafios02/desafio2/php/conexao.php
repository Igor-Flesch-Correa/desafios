<?php

class Conexao
{
    private $host;
    private $dbname;
    private $user;
    private $password;

    public function __construct($host, $dbname, $user, $password)
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;
    }

    public function conectar()
    {
        try {
            $conexao = new PDO(
                "pgsql:host=$this->host;dbname=$this->dbname",
                $this->user,
                $this->password
            );

            // Configura o modo de erro do PDO para exceção
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conexao;
        } catch (PDOException $e) {
            echo "Erro na conexão com o banco de dados: " . $e->getMessage();
        }
    }
}

?>
