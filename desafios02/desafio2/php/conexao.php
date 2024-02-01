<?php //padrão Singleton só da pra modificar aqui e impede gerar objetos

class Conexao {
    private static $conexao = null;

    
    private function __construct() {}//impede essas coisas
    private function __clone() {}
    private function __wakeup() {}

    public static function conectar() {
        if (self::$conexao === null) {//::metodo de acessar funcoes ou etc(estáticas) de uma clase sem referenciar um objeto, já que não tem
            try {
                $host = "db"; // Nome do container, deve achar já q estou usando docker-compose
                $dbname = "dadosfuncionarios";
                $user = "usuario";
                $password = "senha";
                
                self::$conexao = new PDO(
                    "pgsql:host=$host;dbname=$dbname",
                    $user,
                    $password
                );

                // Configura o modo de erro do PDO para exceção
                self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                echo "Erro na conexão com o banco de dados: " . $e->getMessage();
            }
        }
        return self::$conexao;
    }
}
