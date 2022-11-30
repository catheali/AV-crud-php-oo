<?php

    declare(strict_types=1);

    namespace App\Controller;
    
use App\Model\Professor;
use App\Repository\ProfessorRepository;
use Exception;

class ProfessorController extends AbstractController
{

    private ProfessorRepository $repository;
    public function __construct()
    {
        $this->repository = new ProfessorRepository();
    }

    public function listar(): void
    {
        $professores = $this->repository->buscarTodos();

        $this->render("professor/listar", ['professores'=> $professores,]);

    }

    public function novo(): void
    {

        if ( true === empty($_POST)){
            $this->render('professor/novo');
            return;
            }

            $professor = new Professor();
            $professor->nome = $_POST['nome'];
            $professor->cpf= $_POST['cpf'];
            $professor->formacao= $_POST['formacao'];
            $professor->endereco= $_POST['endereco'];

            try {
                $this->repository->inserir($professor);
            } catch (Exception $exception) {
                if (true === str_contains($exception->getMessage(), 'cpf')) {
                    die('CPF ja existe');
                }
    
                die('Vish, aconteceu um erro');
            }
    
        $this->redirect("/professores/listar");
    }

    public function editar(): void
    {
        $id = $_GET['id'];
        $professor = $this->repository->buscarUm($id);
        $this->render('professor/editar', [$professor]);
        if (false === empty($_POST)) {

            $professor->nome = $_POST['nome'];
            $professor->cpf= $_POST['cpf'];
            $professor->formacao= $_POST['formacao'];
            $professor->endereco= $_POST['endereco'];
    
            try {
                $this->repository->atualizar($professor, $id);
            } catch (Exception $exception) {
                if (true === str_contains($exception->getMessage(), 'cpf')) {
                    die('CPF ja existe');
                }
    
                if (true === str_contains($exception->getMessage(), 'email')) {
                    die('Email ja existe');
                }
    
                die('Vish, aconteceu um erro');
            }
            $this->redirect('/professores/listar');
        }
    }

    public function excluir(): void
    {
        $id = $_GET['id'];
        $this->repository->excluir($id);
        $this->redirect("/professores/listar");
    }

    public function gerandoPDF():void
    {
       $dados = $this->repository->buscarTodos();
       $this->relatorio("professor", [
        'professores' => $dados,
    ] );
    }

}