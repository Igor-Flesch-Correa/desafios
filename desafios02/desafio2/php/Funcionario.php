<?php

require_once 'Conexao.php';

class Funcionario
{
    private $id;
    private $nome;
    private $genero;
    private $idade;
    private $salario;

    public function __construct($nome = '', $genero = '', $idade = 0, $salario = 0.0, $id = null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->genero = $genero;
        $this->idade = $idade;
        $this->salario = $salario;
    }

    public function cadastrar()
    {
        $conexao = Conexao::conectar();
        $sql = "INSERT INTO public.funcionarios (nome, genero, idade, salario) VALUES (:nome, :genero, :idade, :salario)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':genero', $this->genero);
        $stmt->bindValue(':idade', $this->idade);
        $stmt->bindValue(':salario', $this->salario);
        return $stmt->execute();
    }

    public function atualizar()
    {
        $conexao = Conexao::conectar();
        $sql = "UPDATE public.funcionarios SET nome = :nome, genero = :genero, idade = :idade, salario = :salario WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $this->id);
        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':genero', $this->genero);
        $stmt->bindValue(':idade', $this->idade);
        $stmt->bindValue(':salario', $this->salario);
        return $stmt->execute();
    }

    public function excluir()
    {
        $conexao = Conexao::conectar();
        $sql = "DELETE FROM public.funcionarios WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $this->id);
        return $stmt->execute();
    }

    public function listarTodos()
    {
        $conexao = Conexao::conectar();
        $sql = "SELECT * FROM public.funcionarios";
        $stmt = $conexao->query($sql);
        $listaFuncionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($listaFuncionarios as $func) {
            echo "{$func['nome']}, {$func['genero']}, {$func['idade']}, {$func['salario']}\n";
        }
        
    }

    public function listarPorId($id)
    {
        $conexao = Conexao::conectar();
        $sql = "SELECT * FROM public.funcionarios WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function mudaNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }
    public function salvaId()
    {
        return $this->id;
    }

    public function aumentarSalario($percentual)
    {
        $this->salario += ($this->salario * $percentual) / 100;
        $this->atualizar();
    }

    public function construirPorId($id)
    {
        $conexao = Conexao::conectar();
        $sql = "SELECT * FROM public.funcionarios WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            $this->id = $resultado['id'];
            $this->nome = $resultado['nome'];
            $this->genero = $resultado['genero'];
            $this->idade = $resultado['idade'];
            $this->salario = $resultado['salario'];
            return $resultado;
        } else {
            echo "Funcionário não encontrado.\n";
            return null; // Retorna null para indicar que nenhum funcionário foi encontrado.
        }
    }
}
