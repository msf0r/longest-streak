<?php

namespace LongestStreak\LongestStreakBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="commits")
 * @ORM\Entity(repositoryClass="\LongestStreak\LongestStreakBundle\Repository\CommitRepository")
 */
class Commit
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(name="sha", type="string", length=40)
     */
    private $sha;

    /**
     * @var integer
     * @ORM\Column(name="github_user_id", type="integer")
     */
    private $user;

    /**
     * @var \DateTime
     * @ORM\Column(name="committedAt", type="datetime")
     */
    private $committedAt;

    /**
     * @ORM\ManyToOne(targetEntity="LongestStreak\LongestStreakBundle\Entity\Repo", inversedBy="commits")
     * @ORM\JoinColumn(name="repo_id", referencedColumnName="id")
     */
    private $repo;

    /**
     * @param  string $sha
     * @return $this
     */
    public function setSha($sha)
    {
        $this->sha = $sha;

        return $this;
    }

    /**
     * @return string
     */
    public function getSha()
    {
        return $this->sha;
    }

    /**
     * @param \DateTime $committedAt
     * @return $this
     */
    public function setCommittedAt($committedAt)
    {
        $this->committedAt = $committedAt;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRepo()
    {
        return $this->repo;
    }

    /**
     * @param mixed $repo
     * @return $this
     */
    public function setRepo(Repo $repo)
    {
        $this->repo = $repo;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCommittedAt()
    {
        return $this->committedAt;
    }

    public function getCommittedAtInISO8601()
    {
        return $this->committedAt->format('Y-m-d\TH:i:s\Z');
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $user
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    static public function toModel(array $array)
    {
        $commit = new Commit();

        $commit->setSha($array['sha']);
        $commit->setUser($array['committer']['id']);
        $commit->setCommittedAt(new \DateTime($array['commit']['committer']['date']));

        return $commit;
    }
}
