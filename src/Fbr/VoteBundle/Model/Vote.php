<?php

namespace Fbr\VoteBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Symfony\Component\Validator\ExecutionContext;

/**
 * @ORM\MappedSuperclass
 *
 */
abstract class Vote
{

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Dp\UserBundle\Entity\User", inversedBy="votestuffs")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * The value of the vote.
     * @var integer
     * @ORM\Column(name="value", type="smallint")
     */
    protected $value;

    public function __construct()
    {
        $this->createdAt = new DateTime();
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
     * Set user
     *
     * @param \Dp\UserBundle\Entity\User $user
     * @return VoteElement
     */
    public function setUser(\Dp\UserBundle\Entity\User $user = null)
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
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return integer The votes value.
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param integer $value
     */
    public function setValue($value)
    {
        $this->value = intval($value);
    }

    /**
     * {@inheritdoc}
     */
    public function isVoteValid(ExecutionContext $context)
    {
        if (!$this->checkValue($this->value)) {
            $message = 'A vote cannot have a 0 value';
            $propertyPath = $context->getPropertyPath() . '.value';
            $context->addViolationAtPath($propertyPath, $message);
        }
    }

    public function __toString()
    {
        return 'Vote #'.$this->getId();
    }

    /**
     * Checks if the value is an appropriate one.
     *
     * @param mixed $value
     *
     * @return boolean True, if the integer representation of the value is not null or 0.
     */
    protected function checkValue($value)
    {
        return null !== $value && intval($value);
    }

}