<?php
namespace App\Controller;

use App\Controller\Base\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
// services
use App\Service\UserService;
use App\Service\WalletService;
use App\Service\ProductService;

/**
 * Controlador principal
 * @author Snayder Acero
 */
class IndexController extends BaseController
{
    /*
    * _construct
    */
    public function __construct()
    {
    }

    /**
    * @Route("/", name="home")
    */  
    public function home()
    {
        return $this->render('index.html.twig');
    }
}