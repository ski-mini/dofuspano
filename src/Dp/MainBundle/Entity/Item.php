<?php

namespace Dp\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table(name="item")
 * @ORM\Entity(repositoryClass="Dp\MainBundle\Entity\ItemRepository")
 */
class Item
{
    /**
     * @ORM\OneToMany(targetEntity="Dp\MainBundle\Entity\Effect", mappedBy="item")
     */
    private $effects;

    /**
     * @ORM\OneToMany(targetEntity="Dp\MainBundle\Entity\Stuffdetail", mappedBy="item")
     */
    private $stuffdetails;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
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
     * @ORM\ManyToOne(targetEntity="Dp\MainBundle\Entity\Itemtype", inversedBy="items", fetch="EAGER")
     * @ORM\JoinColumn(name="itemtype_id", referencedColumnName="id")
     */
    private $itemtype;

    /**
     * @var integer
     *
     * @ORM\Column(name="lvl", type="integer")
     */
    private $lvl;

    /**
     * @var string
     *
     * @ORM\Column(name="conditions", type="string", length=255, nullable=true, options={"comment":""})
     */
    private $conditions;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Dp\MainBundle\Entity\Panoply", inversedBy="items", fetch="EAGER")
     * @ORM\JoinColumn(name="panoply_id", nullable=true)
     */
    private $panoply;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enable", type="boolean", options={"default":"1"})
     */
    private $enable;

    public function __construct()
    {
        $this->effects = new \Doctrine\Common\Collections\ArrayCollection();
        $this->stuffdetails = new \Doctrine\Common\Collections\ArrayCollection();
        $this->conditions = NULL;
        $this->panoply = NULL;
        $this->updated = new \DateTime();
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
     * @return Item
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
     * Set lvl
     *
     * @param integer $lvl
     * @return Item
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
     * Set conditions
     *
     * @param string $conditions
     * @return Item
     */
    public function setConditions($conditions)
    {
        $this->conditions = $conditions;

        return $this;
    }

    /**
     * Get conditions
     *
     * @return string
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Item
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set enable
     *
     * @param boolean $enable
     * @return Itemglobaltype
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
     * Set id
     *
     * @param integer $id
     * @return Item
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Add effects
     *
     * @param \Dp\MainBundle\Entity\Effect $effects
     * @return Item
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
     * Add stuffdetails
     *
     * @param \Dp\MainBundle\Entity\Stuffdetail $stuffdetails
     * @return Item
     */
    public function addStuffdetail(\Dp\MainBundle\Entity\Stuffdetail $stuffdetails)
    {
        $this->stuffdetails[] = $stuffdetails;

        return $this;
    }

    /**
     * Remove stuffdetails
     *
     * @param \Dp\MainBundle\Entity\Stuffdetail $stuffdetails
     */
    public function removeStuffdetail(\Dp\MainBundle\Entity\Stuffdetail $stuffdetails)
    {
        $this->stuffdetails->removeElement($stuffdetails);
    }

    /**
     * Get stuffdetails
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStuffdetails()
    {
        return $this->stuffdetails;
    }

    /**
     * Set itemtype
     *
     * @param \Dp\MainBundle\Entity\Effecttype $itemtype
     * @return Item
     */
    public function setItemtype(\Dp\MainBundle\Entity\Effecttype $itemtype = null)
    {
        $this->itemtype = $itemtype;

        return $this;
    }

    /**
     * Get itemtype
     *
     * @return \Dp\MainBundle\Entity\Effecttype
     */
    public function getItemtype()
    {
        return $this->itemtype;
    }

    /**
     * Set panoply
     *
     * @param \Dp\MainBundle\Entity\Panoply $panoply
     * @return Item
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
}