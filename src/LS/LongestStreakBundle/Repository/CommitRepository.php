<?php

namespace LS\LongestStreakBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class CommitRepository extends EntityRepository
{
    public function findDatesByGithubId($githubId)
    {
        $q = $this->createQueryBuilder('c')
            ->select('c.committedAt')
            ->where('c.user = :githubid')
            ->setParameter('githubid', $githubId)
            ->orderBy('c.committedAt')
        ;

        return $q->getQuery()->getResult(Query::HYDRATE_ARRAY);
    }
}