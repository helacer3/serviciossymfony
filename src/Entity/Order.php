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
 * Clase con la información de la Orden
 * @author Snayder Acero
 * @ORM\Table(name="prb_order")
 * @ORM\Entity
 */
class Order
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
    protected User $idUser;

    /**
     * @var int
     *
     * @ORM\Column(name="IdProduct", type="string", nullable=false)
     */
    protected string $idProduct;

    /**
     * @var string
     *
     * @ORM\Column(name="IdSession", type="string", nullable=false)
     */
    protected string $idSession;

    /**
     * @var string
     *
     * @ORM\Column(name="Token", type="string", nullable=false)
     */
    protected string $token;

    /**
     * @var float
     *
     * @ORM\Column(name="Value", type="float", nullable=false)
     */
    protected float $value;

    /**
     * @var string
     *
     * @ORM\Column(name="Status", type="string", nullable=false)
     */
    protected string $status;

    /**
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
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
     * @return int
     */
    public function getIdProduct():string
    {
        return $this->idProduct;
    }

    /**
     * @param int $idProduct
     *
     * @return self
     */
    public function setIdProduct(string $idProduct)
    {
        $this->idProduct = $idProduct;

        return $this;
    }

    /**
     * @return string
     */
    public function getIdSession(): string
    {
        return $this->idSession;
    }

    /**
     * @param string $idSession
     *
     * @return self
     */
    public function setIdSession(string $idSession)
    {
        $this->idSession = $idSession;

        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     *
     * @return self
     */
    public function setToken(string $token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return float
     */
    public function getValue(): float
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

    /**
     * @return string
     */
    public function getStatus():string
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return self
     */
    public function setStatus(string $status)
    {
        $this->status = $status;

        return $this;
    }
}