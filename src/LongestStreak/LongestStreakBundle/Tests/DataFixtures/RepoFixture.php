<?php

namespace LongestStreak\LongestStreakBundle\Tests\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use LongestStreak\LongestStreakBundle\Entity\Repo;

class RepoFixture extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $repo = new Repo();
        $repo->setName('user1/test-repository');
        $repo->setUrl('http://test.url');
        $repo->setGithubId(25623);
        $repo->setUser($this->getReference('user1'));

        $manager->persist($repo);

        $repo = new Repo();
        $repo->setName('user1/test-repository');
        $repo->setUrl('http://test2.url');
        $repo->setGithubId(2414);
        $repo->setUser($this->getReference('user1'));

        $manager->persist($repo);
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
} 