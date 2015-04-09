<?php

namespace LS\LongestStreakBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="LS\LongestStreakBundle\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="login", type="string")
     */
    private $login;

    /**
     * @var DateTime
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(name="github_id", type="integer")
     */
    private $githubId;

    /**
     * @ORM\Column(name="github_url", type="string", nullable = true)
     */
    private $githubUrl;

    /**
     * @ORM\Column(name="email", type="string")
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="Repo", mappedBy="user")
     */
    private $repos;

    /**
     * @ORM\OneToOne(targetEntity="LS\LongestStreakBundle\Entity\Streak", inversedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(name="streak_id", referencedColumnName="id")
     */
    private $streak;

    public function __construct()
    {
        $this->repos = new ArrayCollection();
    }

    /**
     * @param  string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $login
     * @return $this
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param  \DateTime $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param  Repo  $repo
     * @return $this
     */
    public function addRepo(Repo $repo)
    {
        $this->repos[] = $repo;

        return $this;
    }

    /**
     * @param  mixed $repos
     * @return $this
     */
    public function setRepos($repos)
    {
        $this->repos = $repos;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRepos()
    {
        return $this->repos;
    }

    /**
     * @param  mixed $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param  mixed $githubId
     * @return $this
     */
    public function setGithubId($githubId)
    {
        $this->githubId = $githubId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGithubId()
    {
        return $this->githubId;
    }

    /**
     * @param  mixed $githubUrl
     * @return $this
     */
    public function setGithubUrl($githubUrl)
    {
        $this->githubUrl = $githubUrl;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStreak()
    {
        return $this->streak;
    }

    /**
     * @param Streak $streak
     * @return $this
     */
    public function setStreak($streak)
    {
        $this->streak = $streak;
        //$this->streak->setUser($this);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGithubUrl()
    {
        return $this->githubUrl;
    }

    public function getRoles()
    {
        return [];
    }

    public function getPassword()
    {
        return null;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->login;
    }

    public function eraseCredentials()
    {

    }

}
