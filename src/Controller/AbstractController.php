<?php

declare(strict_types=1);

namespace App\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;

use App\Security\UserSecurity;

abstract class AbstractController
{
    public function render(string $view, ?array $dados = null, bool $navbar = true): void
    {
        if(isset($dados)){
            extract($dados);
        }

        include_once '../views/template/header.phtml';

        $navbar === true && include_once '../views/template/menu.phtml';

        include_once "../views/{$view}.phtml";

        include_once '../views/template/footer.phtml';
    }

    public function redirect(string $local):void
    {
        header('location: '. $local);
    }

     public function checkLogin()
     {
         if(UserSecurity::isLogged() === false){
             $this->redirect('/login');
         }
     }

     public function relatorio( string $onde, array $dados = [] ):void
    {
        extract($dados);
        ob_start();
        include_once ("../Views/{$onde}/relatorio.phtml");
        $pdf = ob_get_clean();
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
         $dompdf->loadHtml($pdf); // carrega o conteudo do PDF
         $dompdf->setPaper('A4', 'portrait'); //tamanho da pagina
         $dompdf->render(); //aqui renderiza
         $dompdf->stream('relatorio.pdf', ['Attachment'=> 0,]); //  é aqui que gera o pdf        
    }
}
