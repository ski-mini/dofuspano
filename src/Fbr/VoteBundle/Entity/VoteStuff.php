<?php

namespace Fbr\VoteBundle\Entity;

use Fbr\VoteBundle\Model\Vote as BaseVote;
use Doctrine\ORM\Mapping as ORM;

/**
 * VoteStuff
 *
 * @ORM\Table(name="vote_stuff")
 * @ORM\Entity(repositoryClass="Fbr\VoteBundle\Entity\VoteStuffRepository")
 */
class VoteStuff extends BaseVote
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Dp\MainBundle\Entity\Stuff", inversedBy="votestuffs")
     * @ORM\JoinColumn(name="stuff_id", referencedColumnName="id")
     */
    protected $stuff;

    public function __construct()
    {

    }

    /**
     * Set stuff
     *
     * @param integer $stuff
     * @return VoteElement
     */
    public function setStuff($stuff)
    {
        $this->stuff = $stuff;

        return $this;
    }

    /**
     * Get stuff
     *
     * @return integer
     */
    public function getStuff()
    {
        return $this->stuff;
    }

}