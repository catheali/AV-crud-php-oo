<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Curso;
use App\Repository\CategoriaRepository;
use App\Repository\CursoRepository;
use Exception;

class CursoController extends AbstractController
{

    private CursoRepository $repository;

    public function __construct()
    {
        $this->repository = new CursoRepository();
    }

    public function listar(): void
    {
        $this->checkLogin();
        
        $cursos = $this->repository->buscarTodos();

        $this->render("curso/listar", [
            'cursos' => $cursos,
        ]);
    }

    public function novo(): void
    {
        $rep = new CategoriaRepository();
        if (true === empty($_POST)) {
            $categorias = $rep->buscarTodos();
            $this->render("curso/novo", ['categorias' => $categorias]);
            return;
        }

        $curso = new Curso();
        $curso->nome = $_POST['nome'];
        $curso->descricao = $_POST['descricao'];
        $curso->cargaHoraria = intval($_POST['cargaHoraria']);
        $curso->categoria_id = intval($_POST['categoria']);

       
    try { $this->repository->inserir($curso);
         } catch (Exception $exception) {
             var_dump($exception->getMessage());
         if (true === str_contains($exception->getMessage(), 'descricao')) {
             die('Descrição ja existe');
         }

         if (true === str_contains($exception->getMessage(), 'nome')) {
             die('Curso ja existe');
         }

         die('Vish, aconteceu um erro');
        }

        $this->redirect('/cursos/listar');
    }

    public function excluir(): void
    {
        $id = $_GET['id'];
        $this->repository->excluir($id);
        $this->redirect('/cursos/listar');
    }

    public function editar(): void
    {
        $id = $_GET['id'];
        $rep = new CategoriaRepository();
        $categorias = $rep->buscarTodos();
        $curso = $this->repository->buscarUm($id);
        $this->render("curso/editar", [
            'categorias' => $categorias,
            'curso' => $curso
        ]);
        if (false === empty($_POST)) {
            $curso = new Curso();
            $curso->nome = $_POST['nome'];
            $curso->descricao = $_POST['descricao'];
            $curso->cargaHoraria = intval($_POST['cargaHoraria']);
            $curso->categoria_id = intval($_POST['categoria']);
            $this->repository->atualizar($curso, $id);
            $this->redirect('/cursos/listar');
        }
    }

    public function gerandoPDF():void
    {
       $dados = $this->repository->buscarTodos();
       $this->relatorio("curso", [
           'cursos' => $dados,
       ]);
    }
}