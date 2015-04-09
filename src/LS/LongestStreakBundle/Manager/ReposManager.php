<?php

namespace LS\LongestStreakBundle\Manager;

use Doctrine\ORM\EntityManager;
use LongestStreak\LongestStreakBundle\Entity\Repo;
use LongestStreak\LongestStreakBundle\Entity\User;
use LongestStreak\LongestStreakBundle\Provider\GitHubProvider;
use LongestStreak\LongestStreakBundle\Repository\RepoRepository;

class ReposManager //RepositoryUpdater
{
    /**
     * @var \LongestStreak\LongestStreakBundle\Provider\GitHubProvider
     */
    private $gitHubProvider;
    /**
     * @var \LongestStreak\LongestStreakBundle\Repository\RepoRepository
     */
    private $repoRepository;

    private $em;

    public function __construct(
        GitHubProvider $gitHubProvider,
        RepoRepository $repoRepository,
        EntityManager $em
    )
    {
        $this->gitHubProvider = $gitHubProvider;
        $this->repoRepository = $repoRepository;
        $this->em = $em;
    }

    public function updateRepos($login)
    {
        $newReposCollection = $this->gitHubProvider->getUserRepos($login);
        /** @var User $user */
        $user = $this->em->getRepository('LSLongestStreakBundle:User')->findOneBy(['login' => $login]);

        $brandNewReposCollection = $newReposCollection->filter(function (Repo $repo) use ($user) {
            return ($repo->getGitCreatedAt() > $user->getUpdatedAt());
        });

        if (!$brandNewReposCollection->isEmpty()) {
            foreach ($brandNewReposCollection->toArray() as $repo) {
                $repo->setUser($user);
                $this->em->persist($repo);
            }

        }

        $reposArray = $this->em->getRepository('LSLongestStreakBundle:Repo')->findBy(['gitLogin' => $user->getLogin()]);

        foreach($reposArray as $repo) {
            $this->em->persist($repo);
        }

        $this->em->flush();

        return true;
    }

    public function updateRepo(User $user, Repo $repo)
    {
        $commitsArray = $this->gitHubProvider->getUserCommitsFromRepoArray($user, $repo->getName(), $repo->getUpdatedAt());

        foreach ($commitsArray as $commit) {
            $commit->setRepo($repo);
            $this->em->persist($commit);
        }
        $user->setUpdatedAt(new \DateTime('now'));
        $repo->setUpdatedAt(new \DateTime('now'));
        $this->em->flush();
    }
}