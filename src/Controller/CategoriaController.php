<?php

declare(strict_types=1);

namespace App\Controller;
use App\Model\Categoria;
use App\Repository\CategoriaRepository;

class CategoriaController extends AbstractController
{
    public function __construct()
    {
        $this->repository = new CategoriaRepository();
    }

    public function listar(): void
    {
        $categorias = $this->repository->buscarTodos();

        $this->render("categoria/listar", [
            'categorias' => $categorias,
        ]);
    }

    public function novo(): void
    {   
        if ( true === empty($_POST)){
            $this->render('categoria/novo');
            return;
            }
    
            $categoria = new Categoria();
            $categoria->nome = $_POST['nome'];

            $this->repository->inserir($categoria);
               
            $this->redirect('/categorias/listar');
       
    }

    public function excluir(): void
    {
        $id = $_GET['id'];
        $this->repository->excluir($id);
        $this->redirect('/categorias/listar');
    }

    public function editar(): void
    {
        $id = $_GET['id'];
        $categoria = $this->repository->buscarUm($id);
        $this->render("categoria/editar", [
            'categoria' => $categoria]);
       
        if (false === empty($_POST)) {
            $categoria->nome = $_POST['nome'];
        
            try {
                $this->repository->atualizar($categoria, $id);
            } catch (Exception $exception) {
                if (true === str_contains($exception->getMessage(), 'nome')) {
                    die('Esta categoria já existe');
                }
    
                die('Vish, aconteceu um erro');
            }
            $this->redirect('/categorias/listar');
        }
    }

    public function gerandoPDF():void
    {
       $dados = $this->repository->buscarTodos();
       $this->relatorio("categoria", [
           'categorias' => $dados,
       ]);
    }
}