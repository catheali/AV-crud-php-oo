<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\UserRepository;
use App\Security\UserSecurity;

class AuthController extends AbstractController
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

   public function login(): void
    {
        if (false === empty($_POST)) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userRepository->findOneByEmail($email);

            if (false === $user) {
                die('Email não existe');
            }

            if (false === password_verify($password, $user->password)) {
                die('Senha incorreta');
            }

            UserSecurity::connect($user);

            $this->redirect('/alunos/listar');

            return;
        }
        $this->render('auth/login', navbar: false);
    }

    public function logout(): void
    {
        UserSecurity::disconnect();

        $this->redirect('/login');
    }
}