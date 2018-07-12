<?php

namespace Dp\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Effect
 *
 * @ORM\Table(name="effect")
 * @ORM\Entity(repositoryClass="Dp\MainBundle\Entity\EffectRepository")
 */
class Effect
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
     * @ORM\ManyToOne(targetEntity="Dp\MainBundle\Entity\Item", inversedBy="effects", fetch="EAGER")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     */
    private $item;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Dp\MainBundle\Entity\Effecttype", inversedBy="effects", fetch="EAGER")
     * @ORM\JoinColumn(name="effecttype_id", referencedColumnName="id", nullable=true)
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
     * Set valuemin
     *
     * @param integer $valuemin
     * @return Effect
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
     * @return Effect
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
     * Set item
     *
     * @param \Dp\MainBundle\Entity\Item $item
     * @return Effect
     */
    public function setItem(\Dp\MainBundle\Entity\Item $item = null)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return \Dp\MainBundle\Entity\Item
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set effecttype
     *
     * @param \Dp\MainBundle\Entity\Effecttype $effecttype
     * @return Effect
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
     * @return Effect
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