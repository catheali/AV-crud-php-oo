<?php

declare(strict_types=1);

namespace App\Repository;

use App\Connection\DatabaseConnection;
use App\Model\Professor;
use PDO;

class ProfessorRepository implements RepositoryInterface
{
    public const TABLE = 'tb_professores';

    public PDO $pdo;

    public function __construct()
    {
        $this->pdo = DatabaseConnection::abrirConexao();
    }

    public function buscarTodos(): iterable
    {
        $conexao = DatabaseConnection::abrirConexao();
        $sql = 'SELECT * FROM '. self::TABLE;

        $query = $conexao->query(($sql));

        $query->execute();

    return $query->fetchAll(PDO::FETCH_CLASS, Professor::class);
    }

    public function buscarUm(string $id): ?object
    { 
         $sql = "SELECT * FROM " .self::TABLE." WHERE id ='{$id}'";
        $query = $this->pdo->query($sql);
        $query->execute();

        return $query ->fetchObject(Professor::class);
    }
    
    public function atualizar(object $novosDados, string $id): object
    {
        $sql = "UPDATE " . self::TABLE . 
        " SET 
            endereco='{$novosDados->endereco}',    
            formacao='{$novosDados->formacao}',
            status='{$novosDados->status}',
            nome='{$novosDados->nome}', 
            cpf='{$novosDados->cpf}' 
        WHERE id = '{$id}';";

    $this->pdo->query($sql);

    return $novosDados;
    }

    public function inserir(object $dados): object
    {
        $sql = "INSERT INTO " . self::TABLE .
        "(endereco, formacao, status, nome, cpf)" . 
        "VALUES ( '{$dados->endereco}' , '{$dados->formacao}' , 1 , '{$dados->nome}', '{$dados->cpf}');";

        $this->pdo->query($sql);
        return $dados;
    }

    public function excluir(string $id): void
    {

        $conexao = DatabaseConnection::abrirConexao();
        $sql = "DELETE FROM " .self::TABLE. " WHERE id = '{$id}'";

        $query = $conexao->query($sql);

        $query->execute();
    }

}

