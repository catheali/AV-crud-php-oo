<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Aluno;
use App\Notification\WebNotification;
use App\Repository\AlunoRepository;

use Exception;

class AlunoController extends AbstractController
{
    private AlunoRepository $repository;

    public function __construct()
    {
        $this->repository = new AlunoRepository();
    }

    public function listar(): void
    {
        $this->checkLogin();

        $alunos = $this->repository->buscarTodos();

        $this->render('aluno/listar', [
            'alunos' => $alunos,
        ]);
    }

    public function novo(): void
    {
        if (true === empty($_POST)) {
            $this->render('aluno/novo');
            return;
        }

        $aluno = new Aluno();
        $aluno->nome = $_POST['nome'];
        $aluno->dataNascimento = $_POST['nascimento'];
        $aluno->cpf = $_POST['cpf'];
        $aluno->email = $_POST['email'];
        $aluno->genero = $_POST['genero'];

        try {
            $this->repository->inserir($aluno);
        } catch (Exception $exception) {
            if (true === str_contains($exception->getMessage(), 'cpf')) {
                WebNotification::add('CPF ja existe', 'danger');
                $this->redirect('/alunos/novo');
                return;
            }

            if (true === str_contains($exception->getMessage(), 'email')) {
                WebNotification::add('Email ja existe', 'danger');
                $this->redirect('/alunos/novo');
                return;
            }

            die('Vish, aconteceu um erro');
        }

        WebNotification::add('Aluno adicionado', 'success');
        $this->redirect('/alunos/listar');
    }

    public function editar(): void
    {
        $this->checkLogin();
        $id = $_GET['id'];
        $rep = new AlunoRepository();
        $aluno = $rep->buscarUm($id);
        $this->render('aluno/editar', [$aluno]);
        if (false === empty($_POST)) {
            $aluno->nome = $_POST['nome'];
            $aluno->dataNascimento = $_POST['nascimento'];
            $aluno->cpf = $_POST['cpf'];
            $aluno->email = $_POST['email'];
            $aluno->genero = $_POST['genero'];
    
            try {
                $rep->atualizar($aluno, $id);
            } catch (Exception $exception) {
                if (true === str_contains($exception->getMessage(), 'cpf')) {
                    WebNotification::add('CPF ja existe', 'danger');
                $this->redirect('/alunos/editar');
                return;
                }
    
                if (true === str_contains($exception->getMessage(), 'email')) {
                    WebNotification::add('Email ja existe', 'danger');
                    $this->redirect('/alunos/editar');
                    return;
                }
    
                die('Vish, aconteceu um erro');
            }
            WebNotification::add('Aluno Editado', 'success');

            $this->redirect('/alunos/listar');
        }
    }

    public function excluir(): void
    {
        $id = $_GET['id'];

        $this->repository->excluir($id);
        WebNotification::add('Aluno excluido com sucesso', 'sucess');

        $this->redirect('/alunos/listar');

    }

    public function gerandoPDF():void
     {
        $dados = $this->repository->buscarTodos();
        $this->relatorio("aluno", [
            'alunos' => $dados,
        ]);
     }
    
}