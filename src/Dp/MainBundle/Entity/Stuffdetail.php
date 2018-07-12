<?php

namespace Dp\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stuffdetail
 *
 * @ORM\Table(name="stuffdetail")
 * @ORM\Entity(repositoryClass="Dp\MainBundle\Entity\StuffdetailRepository")
 */
class Stuffdetail
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Dp\MainBundle\Entity\Item", inversedBy="stuffdetails", fetch="EAGER")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     */
    private $item;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Dp\MainBundle\Entity\Stuff", inversedBy="stuffdetails", fetch="EAGER")
     * @ORM\JoinColumn(name="stuff_id", referencedColumnName="id")
     */
    private $stuff;

    /**
     * @var string
     *
     * @ORM\Column(name="overtype", type="string", length=255, nullable=true)
     */
    private $overtype;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enable", type="boolean")
     */
    private $enable;

    public function __construct()
    {
        $this->enable = TRUE;
        $this->created = new \Datetime();
        $this->overtype = NULL;
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
     * Set created
     *
     * @param \DateTime $created
     * @return Stuffdetail
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set enable
     *
     * @param boolean $enable
     * @return Stuffdetail
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
     * Set item
     *
     * @param \Dp\MainBundle\Entity\Item $item
     * @return Stuffdetail
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
     * Set stuff
     *
     * @param \Dp\MainBundle\Entity\Stuff $stuff
     * @return Stuffdetail
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

    /**
     * Set overtype
     *
     * @param string $overtype
     * @return Stuffdetail
     */
    public function setOvertype($overtype)
    {
        $this->overtype = $overtype;

        return $this;
    }

    /**
     * Get overtype
     *
     * @return string
     */
    public function getOvertype()
    {
        return $this->overtype;
    }

    /**
     * Set classe
     *
     * @param \Dp\MainBundle\Entity\Classe $classe
     * @return Stuffdetail
     */
    public function setClasse(\Dp\MainBundle\Entity\Classe $classe = null)
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * Get classe
     *
     * @return \Dp\MainBundle\Entity\Classe
     */
    public function getClasse()
    {
        return $this->classe;
    }
}