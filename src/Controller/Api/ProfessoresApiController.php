<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Repository\ProfessorRepository;

class ProfessorApiController
{
    public function getAll():void
    {
        $rep = new ProfessorRepository();

        $professor = $rep->buscarTodos(); 

        echo json_encode([$professor]);
    }
}