<?php

namespace Dp\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bonuspanoply
 *
 * @ORM\Table(name="bonuspanoply")
 * @ORM\Entity(repositoryClass="Dp\MainBundle\Entity\BonuspanoplyRepository")
 */
class Bonuspanoply
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
     * @ORM\ManyToOne(targetEntity="Dp\MainBundle\Entity\Panoply", inversedBy="bonuspanoplys")
     * @ORM\JoinColumn(name="panoply_id", referencedColumnName="id")
     */
    private $panoply;

    /**
     * @var integer
     *
     * @ORM\Column(name="bonuscount", type="smallint")
     */
    private $bonuscount;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Dp\MainBundle\Entity\Effecttype", inversedBy="bonuspanoplys")
     * @ORM\JoinColumn(name="effecttype_id", referencedColumnName="id")
     */
    private $effecttype;

    /**
     * @var integer
     *
     * @ORM\Column(name="valuemin", type="integer", nullable=true)
     */
    private $valuemin;

    /**
     * @var integer
     *
     * @ORM\Column(name="valuemax", type="integer", nullable=true)
     */
    private $valuemax;

    /**
     * @var string
     *
     * @ORM\Column(name="textvalue", type="string", length=255, nullable=true)
     */
    private $textvalue;

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
     * Set bonuscount
     *
     * @param integer $bonuscount
     * @return Bonuspanoply
     */
    public function setBonuscount($bonuscount)
    {
        $this->bonuscount = $bonuscount;

        return $this;
    }

    /**
     * Get bonuscount
     *
     * @return integer
     */
    public function getBonuscount()
    {
        return $this->bonuscount;
    }

    /**
     * Set valuemin
     *
     * @param integer $valuemin
     * @return Bonuspanoply
     */
    public function setValuemin($valuemin)
    {
        $this->valuemin = $valuemin;

        return $this;
    }

    /**
     * Get valuemin
     *
     * @return integer
     */
    public function getValuemin()
    {
        return $this->valuemin;
    }

    /**
     * Set valuemax
     *
     * @param integer $valuemax
     * @return Bonuspanoply
     */
    public function setValuemax($valuemax)
    {
        $this->valuemax = $valuemax;

        return $this;
    }

    /**
     * Get valuemax
     *
     * @return integer
     */
    public function getValuemax()
    {
        return $this->valuemax;
    }

    /**
     * Set panoply
     *
     * @param \Dp\MainBundle\Entity\Panoply $panoply
     * @return Bonuspanoply
     */
    public function setPanoply(\Dp\MainBundle\Entity\Panoply $panoply = null)
    {
        $this->panoply = $panoply;
    
        return $this;
    }

    /**
     * Get panoply
     *
     * @return \Dp\MainBundle\Entity\Panoply 
     */
    public function getPanoply()
    {
        return $this->panoply;
    }

    /**
     * Set effecttype
     *
     * @param \Dp\MainBundle\Entity\Effecttype $effecttype
     * @return Bonuspanoply
     */
    public function setEffecttype(\Dp\MainBundle\Entity\Effecttype $effecttype = null)
    {
        $this->effecttype = $effecttype;
    
        return $this;
    }

    /**
     * Get effecttype
     *
     * @return \Dp\MainBundle\Entity\Effecttype 
     */
    public function getEffecttype()
    {
        return $this->effecttype;
    }

    /**
     * Set textvalue
     *
     * @param string $textvalue
     * @return Bonuspanoply
     */
    public function setTextvalue($textvalue)
    {
        $this->textvalue = $textvalue;
    
        return $this;
    }

    /**
     * Get textvalue
     *
     * @return string 
     */
    public function getTextvalue()
    {
        return $this->textvalue;
    }
}