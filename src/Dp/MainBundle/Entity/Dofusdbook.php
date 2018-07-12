<?php

namespace Dp\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dofusdbook
 *
 * @ORM\Table(name="dofusdbook")
 * @ORM\Entity(repositoryClass="Dp\MainBundle\Entity\DofusdbookRepository")
 */
class Dofusdbook
{
    /**
     * @var integer
     *
     * @ORM\Column(name="dofus_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $dofusId;

    /**
     * @var integer
     *
     * @ORM\Column(name="dbook_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $dbookId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ride", type="boolean", nullable=false)
     */
    private $ride;


    /**
     * Set dofusId
     *
     * @param integer $dofusId
     * @return Dofusdbook
     */
    public function setDofusId($dofusId)
    {
        $this->dofusId = $dofusId;
    
        return $this;
    }

    /**
     * Get dofusId
     *
     * @return integer 
     */
    public function getDofusId()
    {
        return $this->dofusId;
    }

    /**
     * Set dbookId
     *
     * @param integer $dbookId
     * @return Dofusdbook
     */
    public function setDbookId($dbookId)
    {
        $this->dbookId = $dbookId;
    
        return $this;
    }

    /**
     * Get dbookId
     *
     * @return integer 
     */
    public function getDbookId()
    {
        return $this->dbookId;
    }

    /**
     * Set ride
     *
     * @param boolean $ride
     * @return Dofusdbook
     */
    public function setRide($ride)
    {
        $this->ride = $ride;
    
        return $this;
    }

    /**
     * Get ride
     *
     * @return boolean 
     */
    public function getRide()
    {
        return $this->ride;
    }
}