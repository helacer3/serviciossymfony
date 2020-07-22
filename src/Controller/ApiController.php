<?php
namespace App\Controller;

use App\Controller\Base\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
// services
use App\Service\UserService;
use App\Service\WalletService;
use App\Service\ProductService;
// entities
use App\Entity\User;

/**
 * Controlador para la API
 * @Route("/api")
 * @author Snayder Acero
 */
class ApiController extends BaseController
{
    /*
    * _construct
    */
    public function __construct()
    {
    }

    /**
    * @Route("/registerUser", name="register_user", methods={"POST"})
    */  
    public function registerUser(Request $request, UserService $userService): JsonResponse
    {   
        // default Vars
        $jsnResponse = $this->errorResponse(array('message' => 'No fué posible guardar el usuario'));
        try {
            // request Data
            $arrData = array(
                $request->request->get->("usrName"),
                $request->request->get->("usrEmail"),
                $request->request->get->("usrDocument"),
                $request->request->get->("usrPhone"),
            );
            // save User Info
            if ($userService->saveUser($arrData)) {
                // success Response
                $jsnResponse = $this->successResponse($arrData);
            }
        } catch (\Exception $ex) {
            // set Json Response - For Debug
            $jsnResponse = $this->errorResponse(array('message' => $ex->getMessage()));
        }
        // default Return
        return $jsnResponse;
    }

    /**
    * @Route("/rechargeWallet", name="recharge_wallet", methods={"POST"})
    */
    public function rechargeWallet(Request $request, WalletService $walletService)
    {   
        // default Vars
        $jsnResponse = $this->errorResponse(array('message' => 'No fué posible cargar la billetera'));
        try {
            // request Data
            $arrData = array(
                $request->request->get->("usrDocument"),
                $request->request->get->("usrPhone"),
                $request->request->get->("usrValue"),
            );
            // charge User Wallet
            if ($walletService->chargeUserWallet($arrData)) {
                // success Response
                $jsnResponse = $this->successResponse($arrData);
            }
        } catch (\Exception $ex) {
            // set Json Response - For Debug
            $jsnResponse = $this->errorResponse(array('message' => $ex->getMessage()));
        }
        // default Return
        return $jsnResponse;
    }

    /**
    * @Route("/buyProduct", name="buy_product", methods={"POST"})
    */
    public function buyProduct(Request $request, ProductService $productService)
    {   
        // default Vars
        $jsnResponse = $this->errorResponse(array('message' => 'No fué posible generar la compra'));
        try {
            // request Data
            $arrData = array(
                $request->request->get->("usrDocument"),
                $request->request->get->("usrProduct"),
                $request->request->get->("usrValue")
            );
            // buy User Product
            if ($walletService->buyUserProduct($arrData)) {
                // success Response
                $jsnResponse = $this->successResponse($arrData);
            }
        } catch (\Exception $ex) {
            // set Json Response - For Debug
            $jsnResponse = $this->errorResponse(array('message' => $ex->getMessage()));
        }
        // default Return
        return $jsnResponse;
    }

    /**
    * @Route("/buyConfirm", name="buy_confirm", methods={"POST"})
    */
    public function buyConfirm(Request $request, ProductService $productService)
    {
        // default Vars
        $jsnResponse = $this->errorResponse(array('message' => 'No fué posible confirmar la compra'));
        try {
            // request Data
            $arrData = array(
                $request->request->get->("usrSession"),
                $request->request->get->("usrToken")
            );
            // buy User Product
            if ($walletService->buyUserProductConfirm($arrData)) {
                // success Response
                $jsnResponse = $this->successResponse($arrData);
            }
        } catch (\Exception $ex) {
            // set Json Response - For Debug
            $jsnResponse = $this->errorResponse(array('message' => $ex->getMessage()));
        }
        // default Return
        return $jsnResponse;
    }

    /**
    * @Route("/checkBalance", name="check_balance")
    */
    public function checkBalance(Request $request, WalletService $walletService)
    {   
        // default Vars
        $jsnResponse = $this->errorResponse(array('message' => 'No fué posible consultar su saldo'));
        try {
            // request Data
            $arrData = array(
                $request->request->get->("usrDocument"),
                $request->request->get->("usrPhone")
            );
            // buy User Product
            if ($walletService->walletUserBalance($arrData)) {
                // success Response
                $jsnResponse = $this->successResponse($arrData);
            }
        } catch (\Exception $ex) {
            // set Json Response - For Debug
            $jsnResponse = $this->errorResponse(array('message' => $ex->getMessage()));
        }
        // default Return
        return $jsnResponse;
    }
}