<?php

namespace Dp\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cast
 *
 * @ORM\Table(name="rel_cast")
 * @ORM\Entity(repositoryClass="Dp\MainBundle\Entity\CastRepository")
 */
class Cast
{
    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Dp\MainBundle\Entity\Classe", inversedBy="casts", fetch="EAGER")
     * @ORM\JoinColumn(name="classe_id", referencedColumnName="id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $classe;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Dp\MainBundle\Entity\Spell", inversedBy="casts", fetch="EAGER")
     * @ORM\JoinColumn(name="spell_id", referencedColumnName="id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $spell;

    /**
     * Set classe
     *
     * @param \Dp\MainBundle\Entity\Classe $classe
     * @return Cast
     */
    public function setClasse(\Dp\MainBundle\Entity\Classe $classe)
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
     * Set spell
     *
     * @param \Dp\MainBundle\Entity\Spell $spell
     * @return Cast
     */
    public function setSpell(\Dp\MainBundle\Entity\Spell $spell)
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
}