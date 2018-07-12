<?php

namespace Dp\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stuffcharacteristictype
 *
 * @ORM\Table(name="stuffcharacteristictype")
 * @ORM\Entity(repositoryClass="Dp\MainBundle\Entity\StuffcharacteristictypeRepository")
 */
class Stuffcharacteristictype
{

    /**
     * @ORM\OneToMany(targetEntity="Dp\MainBundle\Entity\Stuffcharacteristic", mappedBy="stuffcharacteristictype")
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
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    public function __construct(){
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
     * Set type
     *
     * @param string $type
     * @return Stuffcharacteristictype
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add stuffcharacteristics
     *
     * @param \Dp\MainBundle\Entity\Stuffcharacteristic $stuffcharacteristics
     * @return Stuffcharacteristictype
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