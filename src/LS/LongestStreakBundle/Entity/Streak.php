<?php

namespace LS\LongestStreakBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Streak
 *
 * @ORM\Table(name="streak")
 * @ORM\Entity()
 */

class Streak
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
     * @var  integer
     * @ORM\Column(type="integer")
     */
    protected $currentStreak = 0;
    /**
     * @var  \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $currentStreakFrom;

    /**
     * @var  \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $currentStreakTo;

    /**
     * @var  integer
     * @ORM\Column(type="integer")
     */
    protected $longestStreak = 0;
    /**
     * @var  \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $longestStreakFrom;
    /**
     * @var  \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $longestStreakTo;

    /**
     * @ORM\OneToOne(targetEntity="LS\LongestStreakBundle\Entity\User", mappedBy="streak")
     */
    protected $user;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getCurrentStreak()
    {
        return $this->currentStreak;
    }

    /**
     * @param  int   $currentStreak
     * @return $this
     */
    public function setCurrentStreak($currentStreak)
    {
        $this->currentStreak = $currentStreak;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCurrentStreakFrom()
    {
        return $this->currentStreakFrom;
    }

    /**
     * @param  \DateTime $currentStreakFrom
     * @return $this
     */
    public function setCurrentStreakFrom($currentStreakFrom)
    {
        $this->currentStreakFrom = $currentStreakFrom;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCurrentStreakTo()
    {
        return $this->currentStreakTo;
    }

    /**
     * @param  \DateTime $currentStreakTo
     * @return $this
     */
    public function setCurrentStreakTo($currentStreakTo)
    {
        $this->currentStreakTo = $currentStreakTo;

        return $this;
    }

    /**
     * @return int
     */
    public function getLongestStreak()
    {
        return $this->longestStreak;
    }

    /**
     * @param  int   $longestStreak
     * @return $this
     */
    public function setLongestStreak($longestStreak)
    {
        $this->longestStreak = $longestStreak;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLongestStreakFrom()
    {
        return $this->longestStreakFrom;
    }

    /**
     * @param  \DateTime $longestStreakFrom
     * @return $this
     */
    public function setLongestStreakFrom($longestStreakFrom)
    {
        $this->longestStreakFrom = $longestStreakFrom;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLongestStreakTo()
    {
        return $this->longestStreakTo;
    }

    /**
     * @param  \DateTime $longestStreakTo
     * @return $this
     */
    public function setLongestStreakTo($longestStreakTo)
    {
        $this->longestStreakTo = $longestStreakTo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;
        //$this->user->setStreak($this);

        return $this;
    }

}
