<?php

namespace Dp\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Effecttype
 *
 * @ORM\Table(name="effecttype")
 * @ORM\Entity(repositoryClass="Dp\MainBundle\Entity\EffecttypeRepository")
 */
class Effecttype
{
    /**
     * @ORM\OneToMany(targetEntity="Dp\MainBundle\Entity\Effect", mappedBy="effecttype")
     */
    private $effects;

    /**
     * @ORM\OneToMany(targetEntity="Dp\MainBundle\Entity\Bonuspanoply", mappedBy="effecttype")
     */
    private $bonuspanoplys;

    /**
     * @ORM\OneToMany(targetEntity="Dp\MainBundle\Entity\Stuffcharacteristic", mappedBy="effecttype")
     */
    private $stuffcharacteristics;

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
     * @ORM\ManyToOne(targetEntity="Dp\MainBundle\Entity\Effectglobaltype", inversedBy="effecttypes", fetch="EAGER")
     * @ORM\JoinColumn(name="effectglobaltype_id", referencedColumnName="id")
     */
    private $effectglobaltype;

    public function __construct(){
        $this->effects = new \Doctrine\Common\Collections\ArrayCollection();
        $this->bonuspanoplys = new \Doctrine\Common\Collections\ArrayCollection();
        $this->stuffcharacteristics = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Effecttype
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
     * Add effects
     *
     * @param \Dp\MainBundle\Entity\Effect $effects
     * @return Effecttype
     */
    public function addEffect(\Dp\MainBundle\Entity\Effect $effects)
    {
        $this->effects[] = $effects;

        return $this;
    }

    /**
     * Remove effects
     *
     * @param \Dp\MainBundle\Entity\Effect $effects
     */
    public function removeEffect(\Dp\MainBundle\Entity\Effect $effects)
    {
        $this->effects->removeElement($effects);
    }

    /**
     * Get effects
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEffects()
    {
        return $this->effects;
    }

    /**
     * Set effectglobaltype
     *
     * @param \Dp\MainBundle\Entity\Effectglobaltype $effectglobaltype
     * @return Effecttype
     */
    public function setEffectglobaltype(\Dp\MainBundle\Entity\Effectglobaltype $effectglobaltype = null)
    {
        $this->effectglobaltype = $effectglobaltype;

        return $this;
    }

    /**
     * Get effectglobaltype
     *
     * @return \Dp\MainBundle\Entity\Effectglobaltype
     */
    public function getEffectglobaltype()
    {
        return $this->effectglobaltype;
    }

    /**
     * Add bonuspanoplys
     *
     * @param \Dp\MainBundle\Entity\Bonuspanoply $bonuspanoplys
     * @return Effecttype
     */
    public function addBonuspanoply(\Dp\MainBundle\Entity\Bonuspanoply $bonuspanoplys)
    {
        $this->bonuspanoplys[] = $bonuspanoplys;

        return $this;
    }

    /**
     * Remove bonuspanoplys
     *
     * @param \Dp\MainBundle\Entity\Bonuspanoply $bonuspanoplys
     */
    public function removeBonuspanoply(\Dp\MainBundle\Entity\Bonuspanoply $bonuspanoplys)
    {
        $this->bonuspanoplys->removeElement($bonuspanoplys);
    }

    /**
     * Get bonuspanoplys
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBonuspanoplys()
    {
        return $this->bonuspanoplys;
    }

    /**
     * Add stuffcharacteristics
     *
     * @param \Dp\MainBundle\Entity\Stuffcharacteristic $stuffcharacteristics
     * @return Effecttype
     */
    public function addStuffcharacteristic(\Dp\MainBundle\Entity\Stuffcharacteristic $stuffcharacteristics)
    {
        $this->stuffcharacteristics[] = $stuffcharacteristics;

        return $this;
    }

    /**
     * Remove stuffcharacteristics
     *
     * @param \Dp\MainBundle\Entity\Stuffcharacteristic $stuffcharacteristics
     */
    public function removeStuffcharacteristic(\Dp\MainBundle\Entity\Stuffcharacteristic $stuffcharacteristics)
    {
        $this->stuffcharacteristics->removeElement($stuffcharacteristics);
    }

    /**
     * Get stuffcharacteristics
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStuffcharacteristics()
    {
        return $this->stuffcharacteristics;
    }
}