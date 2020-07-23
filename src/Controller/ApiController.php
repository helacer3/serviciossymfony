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
            // get Content
            $data    = $request->getContent();
            // json Decode
            $data    = json_decode($data);
            // request Data
            $arrData = array(
                "usrName"     => $data->params->usrName,//$request->request->get("usrName"),
                "usrEmail"    => $data->params->usrEmail,//$request->request->get("usrEmail"),
                "usrDocument" => $data->params->usrDocument,//$request->request->get("usrDocument"),
                "usrPhone"    => $data->params->usrPhone//$request->request->get("usrPhone"),
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
            // get Content
            $data    = $request->getContent();
            // json Decode
            $data    = json_decode($data);
            // request Data
            $arrData = array(
                "usrDocument" => $data->params->usrDocument,//$request->request->get("usrDocument"),
                "usrPhone"    => $data->params->usrPhone,//$request->request->get("usrPhone"),
                "usrValue"    => $data->params->usrValue,//$request->request->get("usrValue"),
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
    public function buyProduct(Request $request, WalletService $walletService, ProductService $productService)
    {   
        // default Vars
        $jsnResponse = $this->errorResponse(array('message' => 'No fué posible generar la compra'));
        try {
            // request Data
            $arrData = array(
                "usrDocument" => $request->request->get("usrDocument"),
                "usrProduct"  => $request->request->get("usrProduct"),
                "usrValue"    => $request->request->get("usrValue"),
                "usrSession"  => $request->request->get("usrSession"),
            );
            // Actual User Wallet Amount
            $amtWallet = $walletService->userWalletAmount($request->request->get("usrDocument"));
            // validate Amount Wallet
            if ((float)$amtWallet >= (float)$request->request->get("usrValue")) { 
                // buy User Product
                if ($productService->buyUserProduct($arrData)) {
                    // success Response
                    $jsnResponse = $this->successResponse($arrData);
                }
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
                $request->request->get("usrSession"),
                $request->request->get("usrToken")
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
    * @Route("/checkBalance", name="check_balance", methods={"POST"})
    */
    public function checkBalance(Request $request, WalletService $walletService)
    {   
        // default Vars
        $jsnResponse = $this->errorResponse(array('message' => 'No fué posible consultar su saldo'));
        try {
            // buy User Product
            $wltAmount = $walletService->userWalletAmount(
                $request->request->get("usrDocument"), $request->request->get("usrPhone")
            );
            // success Response
            $jsnResponse = $this->successResponse(array('amount' => $wltAmount));
        } catch (\Exception $ex) {
            // set Json Response - For Debug
            $jsnResponse = $this->errorResponse(array('message' => $ex->getMessage()));
        }
        // default Return
        return $jsnResponse;
    }
}