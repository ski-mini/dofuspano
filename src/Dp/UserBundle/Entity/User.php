<?php

namespace Dp\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="dp_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        $this->stuffs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->votestuffs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="Dp\MainBundle\Entity\Stuff", mappedBy="user")
     */
    private $stuffs;

    /**
     * @ORM\OneToMany(targetEntity="Fbr\VoteBundle\Entity\VoteStuff", mappedBy="user")
     */
    private $votestuffs;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add stuffs
     *
     * @param \Dp\MainBundle\Entity\Stuff $stuffs
     * @return User
     */
    public function addStuff(\Dp\MainBundle\Entity\Stuff $stuffs)
    {
        $this->stuffs[] = $stuffs;

        return $this;
    }

    /**
     * Remove stuffs
     *
     * @param \Dp\MainBundle\Entity\Stuff $stuffs
     */
    public function removeStuff(\Dp\MainBundle\Entity\Stuff $stuffs)
    {
        $this->stuffs->removeElement($stuffs);
    }

    /**
     * Get stuffs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStuffs()
    {
        return $this->stuffs;
    }
}