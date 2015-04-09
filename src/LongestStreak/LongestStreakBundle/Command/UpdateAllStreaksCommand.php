<?php

namespace LongestStreak\LongestStreakBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateAllStreaksCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('ls:streaks:update')
            ->setDescription('Update all streaks')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Updating...');

        $this->getContainer()->get('app.longest_streak')->updateAll();
        $output->writeln('Streaks successfully updated');

    }
}