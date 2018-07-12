<?php

namespace Dp\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stuffcharacteristic
 *
 * @ORM\Table(name="stuffcharacteristic")
 * @ORM\Entity(repositoryClass="Dp\MainBundle\Entity\StuffcharacteristicRepository")
 */
class Stuffcharacteristic
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
     * @ORM\ManyToOne(targetEntity="Dp\MainBundle\Entity\Stuff", inversedBy="stuffcharacteristics", fetch="EAGER")
     * @ORM\JoinColumn(name="stuff_id", referencedColumnName="id")
     */
    private $stuff;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Dp\MainBundle\Entity\Stuffcharacteristictype", inversedBy="stuffcharacteristics", fetch="EAGER")
     * @ORM\JoinColumn(name="stuffcharacteristictype_id", referencedColumnName="id")
     */
    private $stuffcharacteristictype;

    /**
     * @var integer
     *
     * @ORM\Column(name="value", type="integer")
     */
    private $value;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Dp\MainBundle\Entity\Effecttype", inversedBy="stuffcharacteristics", fetch="EAGER")
     * @ORM\JoinColumn(name="effecttype_id", referencedColumnName="id")
     */
    private $effecttype;


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
     * Set stuffcharacteristictype
     *
     * @param integer $stuffcharacteristictype
     * @return Stuffcharacteristic
     */
    public function setStuffcharacteristictype($stuffcharacteristictype)
    {
        $this->stuffcharacteristictype = $stuffcharacteristictype;

        return $this;
    }

    /**
     * Get stuffcharacteristictype
     *
     * @return integer
     */
    public function getStuffcharacteristictype()
    {
        return $this->stuffcharacteristictype;
    }

    /**
     * Set value
     *
     * @param integer $value
     * @return Stuffcharacteristic
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set effecttype
     *
     * @param integer $effecttype
     * @return Stuffcharacteristic
     */
    public function setEffecttype($effecttype)
    {
        $this->effecttype = $effecttype;

        return $this;
    }

    /**
     * Get effecttype
     *
     * @return integer
     */
    public function getEffecttype()
    {
        return $this->effecttype;
    }

    /**
     * Set stuff
     *
     * @param \Dp\MainBundle\Entity\Stuff $stuff
     * @return Stuffcharacteristic
     */
    public function setStuff(\Dp\MainBundle\Entity\Stuff $stuff = null)
    {
        $this->stuff = $stuff;

        return $this;
    }

    /**
     * Get stuff
     *
     * @return \Dp\MainBundle\Entity\Stuff
     */
    public function getStuff()
    {
        return $this->stuff;
    }
}