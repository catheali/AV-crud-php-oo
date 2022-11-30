<?php

declare(strict_types=1);

namespace App\Controller;

use App\Notification\WebNotification;
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
                WebNotification::add('Email não existe', 'danger');
                $this->redirect('/login');
                return;
            }

            if (false === password_verify($password, $user->password)) {
                WebNotification::add('Senha incorreta','danger');
                $this->redirect('/login');
                return;
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