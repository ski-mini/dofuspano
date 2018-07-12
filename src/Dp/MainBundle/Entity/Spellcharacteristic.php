<?php

namespace Dp\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Spellcharacteristic
 *
 * @ORM\Table(name="spellcharacteristic")
 * @ORM\Entity(repositoryClass="Dp\MainBundle\Entity\SpellcharacteristicRepository")
 */
class Spellcharacteristic
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Dp\MainBundle\Entity\Spell", inversedBy="spellcharacteristics", fetch="EAGER")
     * @ORM\JoinColumn(name="spell_id", referencedColumnName="id")
     */
    private $spell;

    /**
     * @var integer
     *
     * @ORM\Column(name="lvl", type="integer")
     */
    private $lvl;

    /**
     * @var integer
     *
     * @ORM\Column(name="pa", type="smallint", nullable=TRUE, options={"default":NULL})
     */
    private $pa;

    /**
     * @var string
     *
     * @ORM\Column(name="po", type="string", nullable=TRUE, length=255, options={"default":NULL})
     */
    private $po;

    /**
     * @var integer
     *
     * @ORM\Column(name="cc", type="smallint", nullable=TRUE, options={"default":NULL})
     */
    private $cc;

    /**
     * @var integer
     *
     * @ORM\Column(name="relaunch", type="smallint", nullable=TRUE, options={"default":NULL})
     */
    private $relaunch;

    /**
     * @var integer
     *
     * @ORM\Column(name="zone", type="smallint", nullable=TRUE, options={"default":NULL})
     */
    private $zone;

    /**
     * @var integer
     *
     * @ORM\Column(name="castbytarget", type="smallint", nullable=TRUE, options={"default":NULL})
     */
    private $castbytarget;

    /**
     * @var integer
     *
     * @ORM\Column(name="castbyturn", type="smallint", nullable=TRUE, options={"default":NULL})
     */
    private $castbyturn;

    /**
     * @var boolean
     *
     * @ORM\Column(name="straightlineonly", type="boolean", nullable=TRUE, options={"default":NULL})
     */
    private $straightlineonly;

    /**
     * @var boolean
     *
     * @ORM\Column(name="lineofsight", type="boolean", nullable=TRUE, options={"default":NULL})
     */
    private $lineofsight;

    /**
     * @var boolean
     *
     * @ORM\Column(name="modifiablerange", type="boolean", nullable=TRUE, options={"default":NULL})
     */
    private $modifiablerange;

    /**
     * @var integer
     *
     * @ORM\Column(name="accumulationbytarget", type="smallint", nullable=TRUE, options={"default":NULL})
     */
    private $accumulationbytarget;


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
     * Set lvl
     *
     * @param integer $lvl
     * @return Spellcharacteristic
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;

        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Set pa
     *
     * @param integer $pa
     * @return Spellcharacteristic
     */
    public function setPa($pa)
    {
        $this->pa = $pa;

        return $this;
    }

    /**
     * Get pa
     *
     * @return integer
     */
    public function getPa()
    {
        return $this->pa;
    }

    /**
     * Set po
     *
     * @param integer $po
     * @return Spellcharacteristic
     */
    public function setPo($po)
    {
        $this->po = $po;

        return $this;
    }

    /**
     * Get po
     *
     * @return integer
     */
    public function getPo()
    {
        return $this->po;
    }

    /**
     * Set cc
     *
     * @param integer $cc
     * @return Spellcharacteristic
     */
    public function setCc($cc)
    {
        $this->cc = $cc;

        return $this;
    }

    /**
     * Get cc
     *
     * @return integer
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * Set relaunch
     *
     * @param integer $relaunch
     * @return Spellcharacteristic
     */
    public function setRelaunch($relaunch)
    {
        $this->relaunch = $relaunch;

        return $this;
    }

    /**
     * Get relaunch
     *
     * @return integer
     */
    public function getRelaunch()
    {
        return $this->relaunch;
    }

    /**
     * Set zone
     *
     * @param integer $zone
     * @return Spellcharacteristic
     */
    public function setZone($zone)
    {
        $this->zone = $zone;

        return $this;
    }

    /**
     * Get zone
     *
     * @return integer
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * Set castbytarget
     *
     * @param integer $castbytarget
     * @return Spellcharacteristic
     */
    public function setCastbytarget($castbytarget)
    {
        $this->castbytarget = $castbytarget;

        return $this;
    }

    /**
     * Get castbytarget
     *
     * @return integer
     */
    public function getCastbytarget()
    {
        return $this->castbytarget;
    }

    /**
     * Set castbyturn
     *
     * @param integer $castbyturn
     * @return Spellcharacteristic
     */
    public function setCastbyturn($castbyturn)
    {
        $this->castbyturn = $castbyturn;

        return $this;
    }

    /**
     * Get castbyturn
     *
     * @return integer
     */
    public function getCastbyturn()
    {
        return $this->castbyturn;
    }

    /**
     * Set straightlineonly
     *
     * @param boolean $straightlineonly
     * @return Spellcharacteristic
     */
    public function setStraightlineonly($straightlineonly)
    {
        $this->straightlineonly = $straightlineonly;

        return $this;
    }

    /**
     * Get straightlineonly
     *
     * @return boolean
     */
    public function getStraightlineonly()
    {
        return $this->straightlineonly;
    }

    /**
     * Set lineofsight
     *
     * @param boolean $lineofsight
     * @return Spellcharacteristic
     */
    public function setLineofsight($lineofsight)
    {
        $this->lineofsight = $lineofsight;

        return $this;
    }

    /**
     * Get lineofsight
     *
     * @return boolean
     */
    public function getLineofsight()
    {
        return $this->lineofsight;
    }

    /**
     * Set modifiablerange
     *
     * @param boolean $modifiablerange
     * @return Spellcharacteristic
     */
    public function setModifiablerange($modifiablerange)
    {
        $this->modifiablerange = $modifiablerange;

        return $this;
    }

    /**
     * Get modifiablerange
     *
     * @return boolean
     */
    public function getModifiablerange()
    {
        return $this->modifiablerange;
    }

    /**
     * Set accumulationbytarget
     *
     * @param integer $accumulationbytarget
     * @return Spellcharacteristic
     */
    public function setAccumulationbytarget($accumulationbytarget)
    {
        $this->accumulationbytarget = $accumulationbytarget;

        return $this;
    }

    /**
     * Get accumulationbytarget
     *
     * @return integer
     */
    public function getAccumulationbytarget()
    {
        return $this->accumulationbytarget;
    }

    /**
     * Set spell
     *
     * @param \Dp\MainBundle\Entity\Spell $spell
     * @return Spellcharacteristic
     */
    public function setSpell(\Dp\MainBundle\Entity\Spell $spell = null)
    {
        $this->spell = $spell;

        return $this;
    }

    /**
     * Get spell
     *
     * @return \Dp\MainBundle\Entity\Spell
     */
    public function getSpell()
    {
        return $this->spell;
    }
}