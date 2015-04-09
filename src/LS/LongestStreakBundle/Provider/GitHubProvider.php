<?php

namespace LS\LongestStreakBundle\Provider;

use Doctrine\Common\Collections\ArrayCollection;
use Github\Client;
use Github\Exception\RuntimeException;
use LongestStreak\LongestStreakBundle\Entity\Commit;
use LongestStreak\LongestStreakBundle\Entity\Repo;
use LongestStreak\LongestStreakBundle\Entity\User;

class GitHubProvider
{
    /** @var Client */
    protected $client;

    public function __construct($clientId, $clientSecret)
    {
        $this->client = new Client();
        $this->client->authenticate($clientId, $clientSecret, Client::AUTH_URL_CLIENT_ID);
    }

    public function getUserRepos($user)
    {
        $newReposCollection = new ArrayCollection();
        try {
            $newReposArray = $this->client->api('user')->repositories(sprintf('%s', $user));
        } catch (RuntimeException $e) {
            throw new \Exception(sprintf('%s:%s', $e->getCode(), $e->getMessage()));
        }

        foreach ($newReposArray as $repo) {
            $newReposCollection->add(Repo::toModel($repo));
        }

        return $newReposCollection;
    }


    /**
     *
     * @link https://developer.github.com/v3/repos/commits/#list-commits-on-a-repository
     * @param $user
     * @param $repo
     * @param null $since
     * @param int $page
     * @return array
     */
    public function getUserCommitsFromRepoArray(User $user, $repo, $since = null, $page = 1)
    {
        $params = [
            'author' => $user->getLogin(),
            'page' => $page,
        ];
        if (!empty($since)) {
            $params['since'] = $since->format(DATE_ISO8601);
        }

        try {
            $newCommitsArray = $this->client->api('repo')->commits()->all($user->getLogin(), $repo, $params);
        } catch (RuntimeException $e) {
            return [];
        }

        foreach ($newCommitsArray as $key => $commit) {
            $newCommitsArray[$key] = Commit::toModel($commit);
        }
        if (count($newCommitsArray) == 30) {

            $page++;
            $pagedCommits = $this->getUserCommitsFromRepoArray($user, $repo, $since, $page);
            return $newCommits = array_merge($newCommitsArray, $pagedCommits);
        }

        return $newCommitsArray;
    }

    public function getUserCommitsFromRepoCollection(User $user, $repo, $since = null)
    {
        return new ArrayCollection($this->getUserCommitsFromRepoArray($user, $repo, $since));
    }
}