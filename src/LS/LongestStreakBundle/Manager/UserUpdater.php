<?php

namespace LS\LongestStreakBundle\Manager;

use Doctrine\ORM\EntityManager;

class UserUpdater //UserUpdater
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    /**
     * @var ReposManager
     */
    private $reposManager;

    public function __construct(EntityManager $em, ReposManager $reposManager)
    {

        $this->em = $em;
        $this->reposManager = $reposManager;
    }

    public function update($login)
    {
        $user = $this->em->getRepository('LSLongestStreakBundle:User')->findOneBy(['login' => $login]);
        $this->reposManager->updateRepos($user->getLogin());

        foreach ($user->getRepos()->toArray() as $repo) {
            $this->reposManager->updateRepo($user, $repo);
            $repo->setUpdatedAt(new \DateTime('now'));
            $this->em->persist($repo);

        }

        $this->em->flush();
    }
}