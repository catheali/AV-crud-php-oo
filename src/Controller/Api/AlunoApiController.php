<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Repository\AlunoRepository;

class AlunoApiController
{
    public function getAll():void
    {
        $rep = new AlunoRepository();

        $alunos = $rep->buscarTodos(); 

        echo json_encode([$alunos]);
    }
}