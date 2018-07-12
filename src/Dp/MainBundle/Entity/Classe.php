<?php

namespace Dp\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classe
 *
 * @ORM\Table(name="classe")
 * @ORM\Entity(repositoryClass="Dp\MainBundle\Entity\ClasseRepository")
 */
class Classe
{
    /**
     * @ORM\OneToMany(targetEntity="Dp\MainBundle\Entity\Cast", mappedBy="classe")
     */
    private $casts;

    /**
     * @ORM\OneToMany(targetEntity="Dp\MainBundle\Entity\Stuff", mappedBy="classe")
     */
    private $stuffs;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


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
     * Set name
     *
     * @param string $name
     * @return Classe
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->casts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->stuffs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add casts
     *
     * @param \Dp\MainBundle\Entity\Cast $casts
     * @return Classe
     */
    public function addCast(\Dp\MainBundle\Entity\Cast $casts)
    {
        $this->casts[] = $casts;

        return $this;
    }

    /**
     * Remove casts
     *
     * @param \Dp\MainBundle\Entity\Cast $casts
     */
    public function removeCast(\Dp\MainBundle\Entity\Cast $casts)
    {
        $this->casts->removeElement($casts);
    }

    /**
     * Get casts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCasts()
    {
        return $this->casts;
    }

    /**
     * Add stuffdetails
     *
     * @param \Dp\MainBundle\Entity\Stuffdetail $stuffdetails
     * @return Classe
     */
    public function addStuffdetail(\Dp\MainBundle\Entity\Stuffdetail $stuffdetails)
    {
        $this->stuffdetails[] = $stuffdetails;

        return $this;
    }

    /**
     * Remove stuffdetails
     *
     * @param \Dp\MainBundle\Entity\Stuffdetail $stuffdetails
     */
    public function removeStuffdetail(\Dp\MainBundle\Entity\Stuffdetail $stuffdetails)
    {
        $this->stuffdetails->removeElement($stuffdetails);
    }

    /**
     * Get stuffdetails
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStuffdetails()
    {
        return $this->stuffdetails;
    }

    /**
     * Add stuffs
     *
     * @param \Dp\MainBundle\Entity\Stuff $stuffs
     * @return Classe
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