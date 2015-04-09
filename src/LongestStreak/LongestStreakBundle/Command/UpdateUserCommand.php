<?php

namespace LongestStreak\LongestStreakBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('ls:user:update')
            ->setDescription('Update user commits')
            ->addOption('login', null, InputOption::VALUE_OPTIONAL , 'GitHub user login')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $login = $input->getOption('login');

        if (! $login) {
            throw new \InvalidArgumentException('Specify GitHub user login');
        }
        $output->writeln('Updating...');

        $this->getContainer()->get('app.update.user_updater')->update($login);
        $output->writeln('Repos successfully updated');

    }
}
