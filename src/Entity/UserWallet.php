<?php

/** 
 * This file is part of the Energizee helper.
 *
 * @author Snayder Acero <helacer3@yahoo.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
// entities
use App\Entity\User;

/**
 * Clase con la información de la billetera
 * @author Snayder Acero
 * @ORM\Table(name="prb_wallet")
 * @ORM\Entity
 */
class UserWallet
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdUser", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="IdUser", referencedColumnName="IdUser")
     **/
    protected $idUser;

    /**
     * @var float
     *
     * @ORM\Column(name="Value", type="float", nullable=false)
     */
    protected $value;
   

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getIdUser():User
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     *
     * @return self
     */
    public function setIdUser(User $idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * @return float
     */
    public function getValue():float
    {
        return $this->value;
    }

    /**
     * @param float $value
     *
     * @return self
     */
    public function setValue(float $value)
    {
        $this->value = $value;

        return $this;
    }
}