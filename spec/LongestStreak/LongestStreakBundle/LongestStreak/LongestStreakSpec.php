<?php

namespace spec\LongestStreak\LongestStreakBundle\LongestStreak;

use LongestStreak\LongestStreakBundle\Entity\Streak;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LongestStreakSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('LS\LongestStreakBundle\LS\LS');
    }

    function it_should_count_duration_initial_1()
    {
        $dates = [
            new \DateTime('2014-12-23 10:08:39'),
            new \DateTime('2014-12-23 19:08:39'),
            new \DateTime('2014-12-24 16:08:39'),
            new \DateTime('2014-12-25 06:08:39'),
            new \DateTime('2014-12-26 16:08:39'),
            new \DateTime('2014-12-26 19:08:39'),
            new \DateTime('2014-12-27 14:08:39'),
            new \DateTime('2014-12-29 14:07:39'),
            new \DateTime('2014-12-30 14:08:39'),
            new \DateTime('2014-12-31 14:08:39'),
        ];

//        $result =[
//            'current' => [
//                3 => new \DateTime('2014-12-31 14:08:39'),
//            ],
//            'longest' => [
//                5 => new \DateTime('2014-12-27 14:08:39')
//            ]
//        ];
        $streak = new Streak();
        $streak->setCurrentStreak(3);
        $streak->setCurrentStreakTo(new \DateTime('2014-12-31 14:08:39'));
//        $streak->setCurrentStreakFrom(new \DateTime('2014-12-29 14:07:39'));
        $streak->setLongestStreak(5);
//        $streak->setLongestStreakFrom(new \DateTime('2014-12-23 10:08:39'));
        $streak->setLongestStreakTo(new \DateTime('2014-12-27 14:08:39'));
        $this->getStreakByDates($dates)->shouldBeLike($streak);
    }

    public function it_should_count_duration_initial_2()
    {
        $dates = [
            new \DateTime('2014-12-23 10:08:39'),
            new \DateTime('2014-12-26 00:08:39'),
            new \DateTime('2014-12-28 00:08:39'),
        ];

//        $result =[
//            'current' => [
//                1 => new \DateTime('2014-12-28 00:08:39'),
//            ],
//            'longest' => [
//                1 => new \DateTime('2014-12-28 00:08:39')
//            ]
//        ];

        $streak = new Streak();
        $streak->setCurrentStreak(1);
        $streak->setCurrentStreakTo(new \DateTime('2014-12-28 00:08:39'));
//        $streak->setCurrentStreakFrom(new \DateTime('2014-12-28 00:08:39'));
        $streak->setLongestStreak(1);
//        $streak->setLongestStreakFrom(new \DateTime('2014-12-28 00:08:39'));
        $streak->setLongestStreakTo(new \DateTime('2014-12-28 00:08:39'));

        $this->getStreakByDates($dates)->shouldBeLike($streak);
    }
}
