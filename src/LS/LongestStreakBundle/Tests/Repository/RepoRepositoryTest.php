<?php

namespace LS\LongestStreakBundle\Tests\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use LongestStreak\LongestStreakBundle\Entity\Repo;
use LongestStreak\LongestStreakBundle\Tests\DataFixtures\RepoFixture;
use LongestStreak\LongestStreakBundle\Tests\DataFixtures\UserFixture;
use LongestStreak\LongestStreakBundle\Tests\LSBase;

class RepoRepositoryTest extends LSBase
{
    public function setUp()
    {
        parent::setUp();
        $fixtures[] = new UserFixture();
        $fixtures[] = new RepoFixture();
        parent::loadFixtures($fixtures);
    }
}