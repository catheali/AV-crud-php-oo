<?php

declare(strict_types=1);

namespace App\Controller\Api ;

use App\Repository\UserRepository;

class UsersApiController 
{
 public function getAll() : void
 {
    $rep = new UserRepository();

    $users = $rep->findAll();

    echo json_encode([$users]);

 } 
}