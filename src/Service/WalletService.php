<?php
// src/Service/WalletService.php
namespace App\Service;
// services
use Doctrine\ORM\EntityManagerInterface;
// entities
use App\Entity\User;
use App\Entity\UserWallet;

/**
 * Wallet Service
*/
class WalletService
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
    * charge User Wallet Service
    * @param Array $arrData User Data Information
    * @return Boolean $booValidate Boolen Flag Response
    */
    public function chargeUserWallet(array $arrData): bool
    {
        // default Vars
        $booValidate = true;
        try {
        	// instance User Wallet Object
        	$newUserWallet = new UserWallet();
        	// load User
        	$usrData       = $this->em->getRepository('App\Entity\User')->findBy(
        		array(
        			'phone'    => array_key_exists('usrPhone', $arrData) ? $arrData['usrPhone'] : '',
        			'document' => array_key_exists('usrDocument', $arrData) ? $arrData['usrDocument'] : ''
        		)
        	);
        	// validate User Object
        	if (count($usrData) > 0) {
        		// set User Wallet
	        	$newUserWallet->setIdUser($usrData[0]);
	        	$newUserWallet->setValue(array_key_exists('usrValue', $arrData) ? $arrData['usrValue'] : '');
	        	// persist Object
	        	$this->em->persist($newUserWallet);
	        	// flush
	        	$this->em->flush();
        	}
        } catch (\Exception $ex) {
   			// set Boolean Validate
       		$booValidate = true;
        }
        // default Return
        return $booValidate;
    }

    /**
	 * user Wallet Amount
	 * @param  String $usrDocument user Document
	 * @param  String $usrPhone    user Phone
	 * @return Float  $wltAmount   wallet Amount
    */
    public function userWalletAmount(string $usrDocument = "", string $usrPhone = ""): float
    {
        // default Vars
        $wltAmount = 0;
        try {
        	// create Query Builder 
        	$qb        = $this->em->createQueryBuilder();
        	// create Query
        	$usrWallet = $qb->select('uw')
			   ->from(User::class, 'u')
			   ->leftJoin(UserWallet::class, 'uw', 'WITH', 'u.id = uw.idUser')
			   ->where('u.document = :usrDocument')
			   ->setParameter('usrDocument', $usrDocument)
			   ->getQuery()
			   ->getOneOrNullResult();
		   	// set User Wallet
			$wltAmount = ($usrWallet != null) ? $usrWallet->getValue(): 0;
        } catch (\Exception $ex) {
    	echo "<br /> Document ".$ex->getMessage();die;
        }
        // default Return
        return $wltAmount;
    }
}