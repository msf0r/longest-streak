<?php

namespace LongestStreak\LongestStreakBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Repository
 *
 * @ORM\Table(name="repos")
 * @ORM\Entity(repositoryClass="\LongestStreak\LongestStreakBundle\Repository\RepoRepository")
 */

class Repo
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="repos", cascade="persist")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="cascade")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="git_login", type="string", nullable=true)
     */
    private $gitLogin;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="git_created_at", type="datetime")
     */
    private $gitCreatedAt;

    /**
     * @var DateTime;
     *
     * @ORM\Column(name="git_updated_at", type="datetime")
     */
    private $gitUpdatedAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="github_id", type="integer")
     */
    private $githubId;

    /**
     * @ORM\OneToMany(targetEntity="LongestStreak\LongestStreakBundle\Entity\Commit", mappedBy="repo")
     */
    private $commits;

    function __construct()
    {
        $this->commits = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $owner
     * @return $this
     */
    public function setUser($owner)
    {
        $this->user = $owner;
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
     * @param $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param int $githubId
     * @return $this
     */
    public function setGithubId($githubId)
    {
        $this->githubId = $githubId;
        return $this;
    }

    /**
     * @return int
     */
    public function getGithubId()
    {
        return $this->githubId;
    }

    /**
     * @param \DateTime $gitCreatedAt
     * @return $this
     */
    public function setGitCreatedAt($gitCreatedAt)
    {
        $this->gitCreatedAt = $gitCreatedAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getGitCreatedAt()
    {
        return $this->gitCreatedAt;
    }

    /**
     * @param \DateTime $gitUpdatedAt
     * @return $this
     */
    public function setGitUpdatedAt($gitUpdatedAt)
    {
        $this->gitUpdatedAt = $gitUpdatedAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getGitUpdatedAt()
    {
        return $this->gitUpdatedAt;
    }

    /**
     * @param string $gitLogin
     * @return $this
     */
    public function setGitLogin($gitLogin)
    {
        $this->gitLogin = $gitLogin;
        return $this;
    }

    /**
     * @return string
     */
    public function getGitLogin()
    {
        return $this->gitLogin;
    }

    /**
     * @return mixed
     */
    public function getCommits()
    {
        return $this->commits;
    }

    /**
     * @param mixed $commits
     * @return $this
     */
    public function setCommits($commits)
    {
        $this->commits = $commits;

        return $this;
    }

    public static function toModel(array $array)
    {
        $repo = new Repo();
        $repo->setName($array['name']);
        $repo->setUrl($array['url']);
        $repo->setGitLogin($array['owner']['login']);
        $repo->setGithubId($array['id']);
        $repo->setGitCreatedAt(new \DateTime($array['created_at']));
        $repo->setGitUpdatedAt(new \DateTime($array['updated_at']));

        return $repo;
    }
} 