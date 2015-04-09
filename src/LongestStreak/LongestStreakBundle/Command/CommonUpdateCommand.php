<?php

namespace LongestStreak\LongestStreakBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CommonUpdateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('ls:common:update')
            ->setDescription('Update all users, repos, commits')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('app.update.common')->update();
        $output->writeln('All users successfuly updated');
    }
}