<?php

namespace LS\LongestStreakBundle\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use LongestStreak\LongestStreakBundle\Entity\Repo;

class RepoRepository extends EntityRepository
{
    public function findByGithubId($newReposIds)
    {
        return $this->createQueryBuilder('r')
            ->select('r.githubId')
            ->where('r.githubId IN (:ids)')->setParameter(':ids', $newReposIds)
            ->getQuery()
            ->execute();
    }
}