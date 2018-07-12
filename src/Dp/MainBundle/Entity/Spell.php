<?php

namespace Dp\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Spell
 *
 * @ORM\Table(name="spell")
 * @ORM\Entity(repositoryClass="Dp\MainBundle\Entity\SpellRepository")
 */
class Spell
{
    /**
     * @ORM\OneToMany(targetEntity="Dp\MainBundle\Entity\Spellcharacteristic", mappedBy="spell")
     */
    private $spellcharacteristics;

    /**
     * @ORM\OneToMany(targetEntity="Dp\MainBundle\Entity\Spelldamage", mappedBy="spell")
     */
    private $spelldamages;

    /**
     * @ORM\OneToMany(targetEntity="Dp\MainBundle\Entity\Cast", mappedBy="spell")
     */
    private $casts;

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
     * @var integer
     *
     * @ORM\Column(name="required_lvl", type="smallint")
     */
    private $requiredLvl;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=TRUE, options={"default":NULL})
     */
    private $description;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->spellcharacteristics = new \Doctrine\Common\Collections\ArrayCollection();
        $this->spelldamages = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set requiredLvl
     *
     * @param integer $requiredLvl
     * @return Spell
     */
    public function setRequiredLvl($requiredLvl)
    {
        $this->requiredLvl = $requiredLvl;

        return $this;
    }

    /**
     * Get requiredLvl
     *
     * @return integer
     */
    public function getRequiredLvl()
    {
        return $this->requiredLvl;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Spell
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * Add spellcharacteristics
     *
     * @param \Dp\MainBundle\Entity\Spellcharacteristic $spellcharacteristics
     * @return Spell
     */
    public function addSpellcharacteristic(\Dp\MainBundle\Entity\Spellcharacteristic $spellcharacteristics)
    {
        $this->spellcharacteristics[] = $spellcharacteristics;
    
        return $this;
    }

    /**
     * Remove spellcharacteristics
     *
     * @param \Dp\MainBundle\Entity\Spellcharacteristic $spellcharacteristics
     */
    public function removeSpellcharacteristic(\Dp\MainBundle\Entity\Spellcharacteristic $spellcharacteristics)
    {
        $this->spellcharacteristics->removeElement($spellcharacteristics);
    }

    /**
     * Get spellcharacteristics
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSpellcharacteristics()
    {
        return $this->spellcharacteristics;
    }

    /**
     * Add spelldamages
     *
     * @param \Dp\MainBundle\Entity\Spelldamage $spelldamages
     * @return Spell
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

    /**
     * Set name
     *
     * @param string $name
     * @return Spell
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
     * Add casts
     *
     * @param \Dp\MainBundle\Entity\Cast $casts
     * @return Spell
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
}