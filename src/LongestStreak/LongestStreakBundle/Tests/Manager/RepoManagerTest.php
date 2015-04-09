<?php

namespace LongestStreak\LongestStreakBundle\Tests\Manager;

use Doctrine\Common\Collections\ArrayCollection;
use LongestStreak\LongestStreakBundle\Entity\Repo;
use LongestStreak\LongestStreakBundle\Tests\LSBase;

class RepoManagerTest extends LSBase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testUpdateUserReposFromGithub()
    {
        $user = $this->em->getRepository('LongestStreakLongestStreakBundle:User')->findBy(['login' => 'user1']);

        $newReposArrayCollection = new ArrayCollection();
        $newReposArrayCollection->add(
            (new Repo)
                ->setName('user1/test-repository')
                ->setUser($user)
                ->setGithubId(25623)
                ->setUrl('http://test.url')
        );
        $newReposArrayCollection->add(
            (new Repo)
                ->setName('user1/test-repository33')
                ->setUser($user)
                ->setGithubId(435324)
                ->setUrl('http://test31.u23rl')
        );

        $this->container->get('app.repository.repos')->update($newReposArrayCollection);
        $expected = $this->em->getRepository('LongestStreakLongestStreakBundle:Repo')->findAll();

        $this->assertCount(3, $expected);
    }
} 