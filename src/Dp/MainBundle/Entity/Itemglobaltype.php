<?php

namespace Dp\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Itemglobaltype
 *
 * @ORM\Table(name="itemglobaltype")
 * @ORM\Entity(repositoryClass="Dp\MainBundle\Entity\ItemglobaltypeRepository")
 */
class Itemglobaltype
{
    /**
     * @ORM\OneToMany(targetEntity="Dp\MainBundle\Entity\Itemtype", mappedBy="itemglobaltype")
     */
    private $itemtypes;

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
        $this->itemtypes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Itemglobaltype
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
     * Add itemtypes
     *
     * @param \Dp\MainBundle\Entity\Itemtype $itemtypes
     * @return Itemglobaltype
     */
    public function addItemtype(\Dp\MainBundle\Entity\Itemtype $itemtypes)
    {
        $this->itemtypes[] = $itemtypes;

        return $this;
    }

    /**
     * Remove itemtypes
     *
     * @param \Dp\MainBundle\Entity\Itemtype $itemtypes
     */
    public function removeItemtype(\Dp\MainBundle\Entity\Itemtype $itemtypes)
    {
        $this->itemtypes->removeElement($itemtypes);
    }

    /**
     * Get itemtypes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItemtypes()
    {
        return $this->itemtypes;
    }
}