<?php
namespace App\Controller\Base;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Base Class
 *
 * @author Snayder Acero
 */
abstract class BaseController extends AbstractController
{    
    // contants Class
    const SUCCESS_RESPONSE = 200;
    const ERROR_RESPONSE   = 500;

    /**
     * Respuesta estandar para el error
     * @param  array $arrayData
     * @return JSON
     */
    protected function errorResponse($arrayData = array())
    {
        $arrayResponse = array(
            "result" => false,
            "data"   => $arrayData
        );
        return new JsonResponse($arrayResponse, self::ERROR_RESPONSE, array());
    }

    /**
     * Respuesta estandar cuando todo funciona OK
     * @param  array $arrayData
     * @return JSON
     */
    protected function successResponse($arrayData = array())
    {
        $arrayResponse = array(
            "result" => true,
            "data"   => $arrayData
        );
        return new JsonResponse($arrayResponse, self::SUCCESS_RESPONSE, array());
    }
}