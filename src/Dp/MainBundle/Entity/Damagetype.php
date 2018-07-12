<?php

namespace Dp\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Damagetype
 *
 * @ORM\Table(name="damagetype")
 * @ORM\Entity(repositoryClass="Dp\MainBundle\Entity\DamagetypeRepository")
 */
class Damagetype
{
    /**
     * @ORM\OneToMany(targetEntity="Dp\MainBundle\Entity\Spelldamage", mappedBy="damagetype")
     */
    private $spelldamages;

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
     * @return Damagetype
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
        $this->spelldamages = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add spelldamages
     *
     * @param \Dp\MainBundle\Entity\Spelldamage $spelldamages
     * @return Damagetype
     */
    public function addSpelldamage(\Dp\MainBundle\Entity\Spelldamage $spelldamages)
    {
        $this->spelldamages[] = $spelldamages;
    
        return $this;
    }

    /**
     * Remove spelldamages
     *
     * @param \Dp\MainBundle\Entity\Spelldamage $spelldamages
     */
    public function removeSpelldamage(\Dp\MainBundle\Entity\Spelldamage $spelldamages)
    {
        $this->spelldamages->removeElement($spelldamages);
    }

    /**
     * Get spelldamages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSpelldamages()
    {
        return $this->spelldamages;
    }
}