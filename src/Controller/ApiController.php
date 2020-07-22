<?php
namespace App\Controller;

use App\Controller\Base\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\KernelInterface;
// services
use App\Service\UserService;
// entities
use App\Entity\User;

/**
 * Controlador para la API
 * @author Snayder Acero
 */
class ApiController extends BaseController
{
    // class Vars
    protected $projectDir;
    
    /*
    * _construct
    */
    public function __construct(KernelInterface $kernel)
    {
        $this->projectDir = $kernel->getProjectDir();
    }

    /**
    * @Route("/generateWsdl", name="generate_wsdl")
    */
    public function generateWsdl()
    {
        $class = new UserService();
        $serviceURI = "http://www.myservice.com/registerUser";
        $wsdlGenerator = new \PHP2WSDL\PHPClass2WSDL($class, $serviceURI);
        // Generate the WSDL from the class adding only the public methods that have @soap annotation.
        $wsdlGenerator->generateWSDL(true);
        // Dump as string
        //$wsdlXML = $wsdlGenerator->dump();
        // Or save as file
        $wsdlXML = $wsdlGenerator->save($this->projectDir.'/src/Wsdl/soapsymfony.wsdl');
        die("generado");
    }

    /**
    * @Route("/testSoap", name="test_soap")
    */
    public function testSoap()
    {
        $soapClient = new \SoapClient('http://localhost/soapSymfony/public/registerUser?wsdl');
        $result = $soapClient->__soapCall("hello", array('name'=>'Jose'));
        dd($result);
    }

    /**
    * @Route("/registerUser", name="register_user")
    */  
    public function registerUser(UserService $userService)
    {
        $soapServer = new \SoapServer($this->projectDir.'/src/Wsdl/soapsymfony.wsdl');
        $soapServer->setObject($userService);

        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml; charset=ISO-8859-1');

        ob_start();
        $soapServer->handle();
        $response->setContent(ob_get_clean());

        return $response;
    }

    /**
    * @Route("/rechargeWallet", name="recharge_wallet")
    */
    public function rechargeWallet()
    {
        die("aa2");
    }

    /**
    * @Route("/buyProduct", name="buy_product")
    */
    public function buyProduct()
    {
        die("aa3");
    }

    /**
    * @Route("/buyConfirm", name="buy_confirm")
    */
    public function buyConfirm()
    {
        die("aa4");
    }

    /**
    * @Route("/checkBalance", name="check_balance")
    */
    public function checkBalance()
    {
        die("aa5");
    }
}