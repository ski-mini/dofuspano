<?php

namespace Dp\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Panoply
 *
 * @ORM\Table(name="panoply")
 * @ORM\Entity(repositoryClass="Dp\MainBundle\Entity\PanoplyRepository")
 */
class Panoply
{
    /**
     * @ORM\OneToMany(targetEntity="Dp\MainBundle\Entity\Item", mappedBy="panoply")
     */
    private $items;

    /**
     * @ORM\OneToMany(targetEntity="Dp\MainBundle\Entity\Bonuspanoply", mappedBy="panoply")
     */
    private $bonuspanoplys;

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
     * @ORM\Column(name="name", type="string", length=254)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enable", type="boolean", options={"default":"1"})
     */
    private $enable;

    public function __construct()
    {
        $this->bonuspanoplys = new \Doctrine\Common\Collections\ArrayCollection();
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
        $this->enable = TRUE;
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
     * @return Panoplys
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
     * Set enable
     *
     * @param boolean $enable
     * @return Panoplys
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * Get enable
     *
     * @return boolean
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * Add items
     *
     * @param \Dp\MainBundle\Entity\Item $items
     * @return Panoply
     */
    public function addItem(\Dp\MainBundle\Entity\Item $items)
    {
        $this->items[] = $items;
    
        return $this;
    }

    /**
     * Remove items
     *
     * @param \Dp\MainBundle\Entity\Item $items
     */
    public function removeItem(\Dp\MainBundle\Entity\Item $items)
    {
        $this->items->removeElement($items);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Add bonuspanoplys
     *
     * @param \Dp\MainBundle\Entity\Bonuspanoply $bonuspanoplys
     * @return Panoply
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
}