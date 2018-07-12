<?php

namespace Dp\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Itemtype
 *
 * @ORM\Table(name="itemtype")
 * @ORM\Entity(repositoryClass="Dp\MainBundle\Entity\ItemtypeRepository")
 */
class Itemtype
{
    /**
     * @ORM\OneToMany(targetEntity="Dp\MainBundle\Entity\Item", mappedBy="itemtype")
     */
    private $items;

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
     * @ORM\ManyToOne(targetEntity="Dp\MainBundle\Entity\Itemglobaltype", inversedBy="itemtypes", fetch="EAGER")
     * @ORM\JoinColumn(name="itemglobaltype_id", referencedColumnName="id")
     */
    private $itemglobaltype;

    public function __construct(){
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Itemtype
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
     * Add items
     *
     * @param \Dp\MainBundle\Entity\Item $items
     * @return Itemtype
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
     * Set itemglobaltype
     *
     * @param \Dp\MainBundle\Entity\Itemglobaltype $itemglobaltype
     * @return Itemtype
     */
    public function setItemglobaltype(\Dp\MainBundle\Entity\Itemglobaltype $itemglobaltype = null)
    {
        $this->itemglobaltype = $itemglobaltype;

        return $this;
    }

    /**
     * Get itemglobaltype
     *
     * @return \Dp\MainBundle\Entity\Itemglobaltype
     */
    public function getItemglobaltype()
    {
        return $this->itemglobaltype;
    }
}