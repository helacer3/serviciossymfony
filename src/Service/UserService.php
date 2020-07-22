<?php
// src/Service/UsersService.php
namespace App\Service;
// services
use Doctrine\ORM\EntityManagerInterface;
// entities
use App\Entity\User;

/**
 * Users Service
*/
class UserService
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
    * save User
    * @param  Array   $arrData     User Data Array
    * @return Boolean $booValidate Boolen Flag Response
    */
    public function saveUser(array $arrData)
    {
        // default Vars
        $booValidate = true;
        try {
        	// instance User Object
        	$newUser = new User();
        	$newUser->setDocument(array_key_exists('usrDocument', $arrData) ? $arrData['usrDocument'] : '');
        	$newUser->setName(array_key_exists('usrName', $arrData) ? $arrData['usrName'] : '');
        	$newUser->setEmail(array_key_exists('usrEmail', $arrData) ? $arrData['usrEmail'] : '');
        	$newUser->setPhone(array_key_exists('usrPhone', $arrData) ? $arrData['usrPhone'] : '');
        	$newUser->setEnabled(true);
        	// persist Object
        	$this->em->persist($newUser);
        	// flush
        	$this->em->flush();
        } catch (\Exception $ex) {
        	echo "<br />Error: ".$ex->getMessage(); die;
   			// set Boolean Validate
       		$booValidate = true;
        }
        // default Return
        return $booValidate;
    }
}