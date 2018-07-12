<?php

namespace Dp\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stuff
 *
 * @ORM\Table(name="stuff")
 * @ORM\Entity(repositoryClass="Dp\MainBundle\Entity\StuffRepository")
 */
class Stuff
{
    /**
     * @ORM\OneToMany(targetEntity="Dp\MainBundle\Entity\Stuffdetail", mappedBy="stuff")
     */
    private $stuffdetails;

    /**
     * @ORM\OneToMany(targetEntity="Dp\MainBundle\Entity\Stuffcharacteristic", mappedBy="stuff")
     */
    private $stuffcharacteristics;

    /**
     * @ORM\OneToMany(targetEntity="Fbr\VoteBundle\Entity\VoteStuff", mappedBy="stuff")
     */
    private $votestuffs;

    /**
     * @ORM\ManyToMany(targetEntity="Dp\MainBundle\Entity\Stuffcategory", cascade={"persist"})
     */
    private $stuffcategories;

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
     * @ORM\Column(name="name", type="string", length=60)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="keyword", type="string", length=255)
     */
    private $keyword;

    /**
     * @var text
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Dp\UserBundle\Entity\User", inversedBy="stuffs")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var integer
     *
     * @ORM\Column(name="lvl", type="integer")
     */
    private $lvl;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Dp\MainBundle\Entity\Classe", inversedBy="stuffs", fetch="EAGER")
     * @ORM\JoinColumn(name="classe_id", referencedColumnName="id")
     */
    private $classe;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    /**
     * @var boolean
     *
     * @ORM\Column(name="online", type="boolean")
     */
    private $online;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enable", type="boolean")
     */
    private $enable;

    public function __construct()
    {
        $this->stuffdetails = new \Doctrine\Common\Collections\ArrayCollection();
        $this->stuffcharacteristics = new \Doctrine\Common\Collections\ArrayCollection();
        $this->votestuffs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->stuffcategorys = new \Doctrine\Common\Collections\ArrayCollection();
        $this->enable = TRUE;
        $this->online = FALSE;
        $this->created = new \Datetime();
        $this->updated = new \Datetime();
        $this->name = 'Untitle';
        $this->description = 'Description...';
        $this->keyword = '';
        $this->lvl = 0;
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
     * @return Stuff
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
     * Set userId
     *
     * @param integer $userId
     * @return Stuff
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     * @return Stuff
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
     * Set created
     *
     * @param \DateTime $created
     * @return Stuff
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
     * @return Stuff
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
     * Add stuffdetails
     *
     * @param \Dp\MainBundle\Entity\Stuffdetail $stuffdetails
     * @return Stuff
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
     * Set user
     *
     * @param \Dp\UserBundle\Entity\User $user
     * @return Stuff
     */
    public function setUser(\Dp\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Dp\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set classe
     *
     * @param \Dp\MainBundle\Entity\Classe $classe
     * @return Stuff
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

    /**
     * Add stuffcharacteristics
     *
     * @param \Dp\MainBundle\Entity\Stuffcharacteristic $stuffcharacteristics
     * @return Stuff
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

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Stuff
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
     * Set online
     *
     * @param boolean $online
     * @return Stuff
     */
    public function setOnline($online)
    {
        $this->online = $online;

        return $this;
    }

    /**
     * Get online
     *
     * @return boolean
     */
    public function getOnline()
    {
        return $this->online;
    }

    /**
     * Set keyword
     *
     * @param array $keyword
     * @return Stuff
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * Get keyword
     *
     * @return array
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Stuff
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add votestuff
     *
     * @param \Fbr\VoteBundle\Entity\VoteStuff $votestuff
     *
     * @return Stuff
     */
    public function addVotestuff(\Fbr\VoteBundle\Entity\VoteStuff $votestuff)
    {
        $this->votestuffs[] = $votestuff;

        return $this;
    }

    /**
     * Remove votestuff
     *
     * @param \Fbr\VoteBundle\Entity\VoteStuff $votestuff
     */
    public function removeVotestuff(\Fbr\VoteBundle\Entity\VoteStuff $votestuff)
    {
        $this->votestuffs->removeElement($votestuff);
    }

    /**
     * Get votestuffs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVotestuffs()
    {
        return $this->votestuffs;
    }

    /**
     * Add stuffcategory
     *
     * @param \Fbr\VoteBundle\Entity\Stuffcategory $stuffcategory
     *
     * @return Stuff
     */
    public function addStuffcategory(\Fbr\VoteBundle\Entity\Stuffcategory $stuffcategory)
    {
        $this->stuffcategories[] = $stuffcategory;

        return $this;
    }

    /**
     * Remove stuffcategory
     *
     * @param \Fbr\VoteBundle\Entity\Stuffcategory $stuffcategory
     */
    public function removeStuffcategory(\Fbr\VoteBundle\Entity\Stuffcategory $stuffcategory)
    {
        $this->stuffcategories->removeElement($stuffcategory);
    }

    /**
     * Get stuffcategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStuffcategories()
    {
        return $this->stuffcategories;
    }
}
