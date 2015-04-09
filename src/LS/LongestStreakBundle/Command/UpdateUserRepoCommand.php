<?php

namespace LS\LongestStreakBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateUserRepoCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('ls:user-repo:update')
            ->setDescription('Update user commits')
            ->addOption('login', null, InputOption::VALUE_OPTIONAL , 'GitHub user login')
            ->addOption('repoName', null, InputOption::VALUE_OPTIONAL , 'GitHub repo name');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $login = $input->getOption('login');
        $repoName = $input->getOption('repoName');

        if (! $login or ! $repoName) {
            throw new \InvalidArgumentException('Specify GitHub user login and repository name');
        }
        $output->writeln('Updating...');

        if ($this->getContainer()->get('app.manager.repos_manager')->updateRepo($login, $repoName)) {
            $output->writeln('Successfully updated');
        } else {
            $output->writeln('User wasn\'t updated');
        }
    }
}
