<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="float")
     */
    private $balance;

    /**
     * @var Receipt[]\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Receipt", mappedBy="user")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $receipts;

    /**
     * @return Receipt[]
     */
    public function getReceipts()
    {
        return $this->receits;
    }


    /**
     * @param Receipt $receipts
     * @return $this
     */
    public function AddReceipts(Receipt $receipts)
    {
        $this->receipts[] = $receipts;

        return $this;
    }

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->receipts = new ArrayCollection();
    }

    /**
     * @return float
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param float $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }
}