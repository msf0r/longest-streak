<?php

namespace LongestStreak\LongestStreakBundle\Manager;

use Doctrine\ORM\EntityManager;

class CommonUpdater
{
    /**
     * @var EntityManager
     */
    private $em;
    /**
     * @var UserUpdater
     */
    private $userUpdater;

    function __construct(EntityManager $em, UserUpdater $userUpdater)
    {
        $this->em = $em;
        $this->userUpdater = $userUpdater;
    }

    public function update()
    {
        $users = $this->em->getRepository('LongestStreakLongestStreakBundle:User')->findAll();

        foreach ($users as $user) {
            $this->userUpdater->update($user->getLogin());
        }

    }
}