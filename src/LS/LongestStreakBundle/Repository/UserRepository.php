<?php

namespace LS\LongestStreakBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\Expr\Join;
use Symfony\Component\Validator\Constraints\Expression;

class UserRepository extends EntityRepository
{
    public function findTop10()
    {
        $q = $this->createQueryBuilder('u')
            ->select('MAX(s.longestStreak), u, s')
            ->join('u.streak', 's', Join::WITH)
            ->groupBy('u.id')
            ->orderBy('s.longestStreak', 'desc')
            ->setMaxResults(10);

        return $q->getQuery()->execute();
    }
}