<?php

namespace Dp\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Spelldamage
 *
 * @ORM\Table(name="spelldamage")
 * @ORM\Entity(repositoryClass="Dp\MainBundle\Entity\SpelldamageRepository")
 */
class Spelldamage
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
     * @ORM\ManyToOne(targetEntity="Dp\MainBundle\Entity\Spell", inversedBy="spelldamages", fetch="EAGER")
     * @ORM\JoinColumn(name="spell_id", referencedColumnName="id")
     */
    private $spell;

    /**
     * @var integer
     *
     * @ORM\Column(name="lvl", type="smallint")
     */
    private $lvl;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Dp\MainBundle\Entity\Damagetype", inversedBy="spelldamages", fetch="EAGER")
     * @ORM\JoinColumn(name="damagetype_id", referencedColumnName="id", nullable=true)
     */
    private $damagetype;


    /**
     * @var integer
     *
     * @ORM\Column(name="dmgmin", type="integer", nullable=TRUE, options={"default":NULL})
     */
    private $dmgmin;

    /**
     * @var integer
     *
     * @ORM\Column(name="dmgmax", type="integer", nullable=TRUE, options={"default":NULL})
     */
    private $dmgmax;

    /**
     * @var integer
     *
     * @ORM\Column(name="dmgmincc", type="integer", nullable=TRUE, options={"default":NULL})
     */
    private $dmgmincc;

    /**
     * @var integer
     *
     * @ORM\Column(name="dmgmaxcc", type="integer", nullable=TRUE, options={"default":NULL})
     */
    private $dmgmaxcc;

    /**
     * @var string
     *
     * @ORM\Column(name="specification", type="string", length=255, nullable=TRUE, options={"default":NULL})
     */
    private $specification;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cumulable", type="boolean", options={"default":FALSE})
     */
    private $cumulable;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255, nullable=TRUE, options={"default":NULL})
     */
    private $comment;


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
     * Set lvl
     *
     * @param integer $lvl
     * @return Spelldamage
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
     * Set dmgmin
     *
     * @param integer $dmgmin
     * @return Spelldamage
     */
    public function setDmgmin($dmgmin)
    {
        $this->dmgmin = $dmgmin;

        return $this;
    }

    /**
     * Get dmgmin
     *
     * @return integer
     */
    public function getDmgmin()
    {
        return $this->dmgmin;
    }

    /**
     * Set dmgmax
     *
     * @param integer $dmgmax
     * @return Spelldamage
     */
    public function setDmgmax($dmgmax)
    {
        $this->dmgmax = $dmgmax;

        return $this;
    }

    /**
     * Get dmgmax
     *
     * @return integer
     */
    public function getDmgmax()
    {
        return $this->dmgmax;
    }

    /**
     * Set dmgmincc
     *
     * @param integer $dmgmincc
     * @return Spelldamage
     */
    public function setDmgmincc($dmgmincc)
    {
        $this->dmgmincc = $dmgmincc;

        return $this;
    }

    /**
     * Get dmgmincc
     *
     * @return integer
     */
    public function getDmgmincc()
    {
        return $this->dmgmincc;
    }

    /**
     * Set dmgmaxcc
     *
     * @param integer $dmgmaxcc
     * @return Spelldamage
     */
    public function setDmgmaxcc($dmgmaxcc)
    {
        $this->dmgmaxcc = $dmgmaxcc;

        return $this;
    }

    /**
     * Get dmgmaxcc
     *
     * @return integer
     */
    public function getDmgmaxcc()
    {
        return $this->dmgmaxcc;
    }

    /**
     * Set specification
     *
     * @param string $specification
     * @return Spelldamage
     */
    public function setSpecification($specification)
    {
        $this->specification = $specification;

        return $this;
    }

    /**
     * Get specification
     *
     * @return string
     */
    public function getSpecification()
    {
        return $this->specification;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return Spelldamage
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set cumulable
     *
     * @param boolean $cumulable
     * @return Spelldamage
     */
    public function setCumulable($cumulable)
    {
        $this->cumulable = $cumulable;

        return $this;
    }

    /**
     * Get cumulable
     *
     * @return boolean
     */
    public function getCumulable()
    {
        return $this->cumulable;
    }

    /**
     * Set spell
     *
     * @param \Dp\MainBundle\Entity\Spell $spell
     * @return Spelldamage
     */
    public function setSpell(\Dp\MainBundle\Entity\Spell $spell = null)
    {
        $this->spell = $spell;

        return $this;
    }

    /**
     * Get spell
     *
     * @return \Dp\MainBundle\Entity\Spell
     */
    public function getSpell()
    {
        return $this->spell;
    }

    /**
     * Set damagetype
     *
     * @param \Dp\MainBundle\Entity\Damagetype $damagetype
     * @return Spelldamage
     */
    public function setDamagetype(\Dp\MainBundle\Entity\Damagetype $damagetype = null)
    {
        $this->damagetype = $damagetype;

        return $this;
    }

    /**
     * Get damagetype
     *
     * @return \Dp\MainBundle\Entity\Damagetype
     */
    public function getDamagetype()
    {
        return $this->damagetype;
    }
}