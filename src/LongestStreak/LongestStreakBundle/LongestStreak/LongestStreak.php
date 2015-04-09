<?php

namespace LongestStreak\LongestStreakBundle\LongestStreak;

use Doctrine\ORM\EntityManager;
use LongestStreak\LongestStreakBundle\Entity\Streak;

class LongestStreak
{
    /**
     * @var EntityManager
     */
    private $em;

    function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function updateAll()
    {
        $users = $this->em->getRepository('LongestStreakLongestStreakBundle:User')->findAll();
        $commitRepo = $this->em->getRepository('LongestStreakLongestStreakBundle:Commit');
        foreach ($users as $user) {
            $dates = $commitRepo->findDatesByGithubId($user->getGithubId());
            $dates = array_column($dates, 'committedAt');

            $streak = $this->getStreakByDates($dates, $user->getStreak());

            $user->setStreak($streak);
            $this->em->persist($user);
        }

        $this->em->flush();
    }

    /**
     * @param array $dates
     * @param Streak $streak
     * @return Streak $streak
     */
    public function getStreakByDates(array $dates, Streak $streak = null)
    {
        if (!$streak) {
            $streak = new Streak();
        }
        if (empty($dates)) {
            return $streak;
        }
        $duration = 1;
        $streaks = [];
        foreach ($dates as $date) {

            if (!$date instanceof \DateTime) {
                throw new \InvalidArgumentException('Array should have only dates');
            }

            if (isset($prevDate)) {
                $currDate = clone $date;
                # if diff is only 1 day
                if ($prevDate->format('Y-m-d') == $currDate->modify('-1 day')->format('Y-m-d')) {
                    $duration++;
                } else {
                    $dateDiff = date_diff($prevDate, $date);
                    # if diff more than 1 day
                    if ($dateDiff->y > 0 || $dateDiff->m > 0 || $dateDiff->d > 0) {
                        # store streak and reset
                        $duration = 1;
                    }
                }
            }
            $streaks[$duration] = $date;
            $prevDate = $date;
        }

        $streak->setCurrentStreak(array_search(max($streaks), $streaks));

        $streak->setCurrentStreakTo(max($streaks));
        $streak->setLongestStreak(max(array_keys($streaks)));
        $streak->setLongestStreakTo($streaks[max(array_keys($streaks))]);

        return $streak;
    }
}