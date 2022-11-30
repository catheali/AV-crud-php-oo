<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\User;
use App\Repository\UserRepository;

class UserController extends AbstractController
{
    private UserRepository $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function list(): void
    {
        $users = $this->repository->findAll();

        $this->render('user/list', [
            'users' => $users,
        ]);
    }

    public function add(): void
    {
        if (true === empty($_POST)) {
            $this->render('user/add');
            return;
        }

        //encriptação
        $password = password_hash($_POST['password'], PASSWORD_ARGON2I);

        $user = new User();
        $user->name = $_POST['name'];
        $user->email = $_POST['email'];
        $user->password = $password;
        $user->profile = $_POST['profile'];

        $this->repository->insert($user);

        $this->redirect('/usuarios/listar');
    }

    public function gerandoPDF():void
    {
       $dados = $this->repository->findAll();
       $this->relatorio("user", [
           'users' => $dados,
       ]);
    }
}