<?php

namespace Dp\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Effectglobaltype
 *
 * @ORM\Table(name="effectglobaltype")
 * @ORM\Entity(repositoryClass="Dp\MainBundle\Entity\EffectglobaltypeRepository")
 */
class Effectglobaltype
{
    /**
     * @ORM\OneToMany(targetEntity="Dp\MainBundle\Entity\Effecttype", mappedBy="effectglobaltype")
     */
    private $effecttypes;

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

    public function __construct(){
        $this->effecttypes = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Effectglobaltype
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
     * Add effecttypes
     *
     * @param \Dp\MainBundle\Entity\Effecttype $effecttypes
     * @return Effectglobaltype
     */
    public function addEffecttype(\Dp\MainBundle\Entity\Effecttype $effecttypes)
    {
        $this->effecttypes[] = $effecttypes;

        return $this;
    }

    /**
     * Remove effecttypes
     *
     * @param \Dp\MainBundle\Entity\Effecttype $effecttypes
     */
    public function removeEffecttype(\Dp\MainBundle\Entity\Effecttype $effecttypes)
    {
        $this->effecttypes->removeElement($effecttypes);
    }

    /**
     * Get effecttypes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEffecttypes()
    {
        return $this->effecttypes;
    }
}