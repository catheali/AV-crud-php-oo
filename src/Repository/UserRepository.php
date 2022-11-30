<?php

declare(strict_types=1);

namespace App\Repository;

use App\Connection\DatabaseConnection;
use App\Model\User;
use PDO;

class UserRepository 
{
    private PDO $pdo;
    public const TABLE = 'tb_user'; 

    public function __construct()
    {
        $this->pdo = DatabaseConnection::abrirConexao();
    }

    //encontre um usuario por email
    public function findOneByEmail(string $email): User|bool
    {
        $sql = "SELECT * FROM ".self::TABLE." WHERE email='{$email}'";

        $query = $this->pdo->query($sql);
        $query->execute();

        return $query->fetchObject(User::class);
    }

    public function findAll(): iterable
    {
        $sql = 'SELECT id, name, email, profile, profile FROM '.self::TABLE;

        $query = $this->pdo->query($sql);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, User::class);
    }

    public function insert(User $user): User
    {
        $sql = "INSERT INTO ".self::TABLE."(name, email, password, profile)";
        $sql .= " VALUES ('{$user->name}', '{$user->email}', '{$user->password}', '{$user->profile}')";

        $this->pdo->query($sql);

        return $user;
    }
}