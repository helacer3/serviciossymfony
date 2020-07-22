<?php
// src/Service/ProductService.php
namespace App\Service;
// services
use Doctrine\ORM\EntityManagerInterface;
// entities
use App\Entity\User;
use App\Entity\Order;

/**
 * Product Service
*/
class ProductService
{
	// class Var
	protected $em;

    /*
    * _construct
    */
    public function __construct(EntityManagerInterface $em)
    {
    	$this->em = $em;
    }

    /**
    * buy User Product
    * @param  Array   $arrData     User Data Array
    * @return Boolean $booValidate Boolen Flag Response
    */
    public function buyUserProduct(array $arrData)
    {
        // default Vars
        $booValidate = true;
        try {
        	// load User
        	$usrData = $this->em->getRepository('App\Entity\User')->findBy(
        		array(
        			'document' => array_key_exists('usrDocument', $arrData) ? $arrData['usrDocument'] : ''
        		)
        	);
        	// validate User Object
        	if (count($usrData) > 0) {
	        	// instance User Object
	        	$newOrder = new Order();
	        	$newOrder->setIdUser($usrData[0]);
	        	$newOrder->setIdProduct(array_key_exists('usrProduct', $arrData) ? $arrData['usrProduct'] : '');
	        	$newOrder->setValue(array_key_exists('usrValue', $arrData) ? (float)$arrData['usrValue'] : '');
	        	$newOrder->setIdSession(array_key_exists('usrSession', $arrData) ? $arrData['usrSession'] : '');
	        	$newOrder->setToken(uniqid());
	        	$newOrder->setStatus("PENDING");
	        	// persist Object
	        	$this->em->persist($newOrder);
	        	// flush
	        	$this->em->flush();
        	}
        } catch (\Exception $ex) {
        	echo "Error: ".$ex->getMessage();die;
   			// set Boolean Validate
       		$booValidate = true;
        }
        // default Return
        return $booValidate;
    }
}