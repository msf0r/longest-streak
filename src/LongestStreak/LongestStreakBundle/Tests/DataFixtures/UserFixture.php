<?php

namespace LongestStreak\LongestStreakBundle\Tests\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use LongestStreak\LongestStreakBundle\Entity\User;

class UserFixture extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setLogin('user1');

        $manager->persist($user);
        $manager->flush();

        $this->addReference('user1', $user);
    }

    public function getOrder()
    {
        return 1;
    }

} 