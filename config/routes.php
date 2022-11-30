<?php

use App\Controller\AlunoController;
use App\Controller\Api\AlunoApiController;
use App\Controller\Api\ProfessorApiController;
use App\Controller\Api\UsersApiController;
use App\Controller\AuthController;
use App\Controller\CursoController;
use App\Controller\CategoriaController;
use App\Controller\ProfessorController;
use App\Controller\SiteController;
use App\Controller\UserController;

function criarRota(string $controllerNome, string $methodNome): array
{
    return [
        'controller' => $controllerNome,
        'method' => $methodNome,
    ];
}

$rotas = [
    '/' => criarRota(SiteController::class, 'inicio'),
    
    '/alunos/listar' => criarRota(AlunoController::class, 'listar'),
    '/alunos/novo' => criarRota(AlunoController::class, 'novo'),
    '/alunos/editar' => criarRota(AlunoController::class, 'editar'),
    '/alunos/excluir' => criarRota(AlunoController::class, 'excluir'),
    '/alunos/gerandopdf' => criarRota(AlunoController::class, 'gerandoPDF'),

    '/usuarios/listar' => criarRota(UserController::class, 'list'),
    '/usuarios/novo' => criarRota(UserController::class, 'add'),
    '/usuarios/gerandopdf' => criarRota(UserController::class, 'gerandoPDF'),


    '/login' => criarRota(AuthController::class, 'login'),
    '/desconectar' => criarRota(AuthController::class, 'logout'),

    '/cursos/listar' => criarRota(CursoController::class, 'listar'),
    '/cursos/novo' => criarRota(CursoController::class, 'novo'),
    '/cursos/editar' => criarRota(CursoController::class, 'editar'),
    '/cursos/excluir' => criarRota(CursoController::class, 'excluir'),
    '/cursos/gerandopdf' => criarRota(CursoController::class, 'gerandoPDF'),


    '/categorias/listar' => criarRota(CategoriaController::class, 'listar'),
    '/categorias/novo' => criarRota(CategoriaController::class, 'novo'),
    '/categorias/editar' => criarRota(CategoriaController::class, 'editar'),
    '/categorias/excluir' => criarRota(CategoriaController::class, 'excluir'),
    '/categorias/gerandopdf' => criarRota(CategoriaController::class, 'gerandoPDF'),


    '/professores/listar' => criarRota(ProfessorController::class, 'listar'),
    '/professores/novo' => criarRota(ProfessorController::class, 'novo'),
    '/professores/editar' => criarRota(ProfessorController::class, 'editar'),
    '/professores/excluir' => criarRota(ProfessorController::class, 'excluir'),
    '/professores/gerandopdf' => criarRota(ProfessorController::class, 'gerandoPDF'),

    /*-----------Rotas-------------*/
    '/api/alunos' => criarRota(AlunoApiController::class, 'getAll'),
    '/api/usuarios' => criarRota(UsersApiController::class, 'getAll'),
    '/api/professores' => criarRota(ProfessorApiController::class, 'getAll'),


    /*----------------------------*/

];

return $rotas;