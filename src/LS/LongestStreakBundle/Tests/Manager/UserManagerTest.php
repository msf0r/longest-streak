<?php

//namespace LS\LongestStreakBundle\Tests\Manager;
//
//use Doctrine\Common\Collections\ArrayCollection;
//use LS\LongestStreakBundle\Entity\Commit;
//use LS\LongestStreakBundle\Entity\Repo;
//use LS\LongestStreakBundle\Manager\UserManager;
//use LS\LongestStreakBundle\Tests\LSBase;
//use Symfony\Bundle\FrameworkBundle\Tests\Functional\WebTestCase;
//use Symfony\Component\DependencyInjection\Container;
//
//class UserManagerLSBase extends LSBase
//{
//
//    public function setUp()
//    {
//        parent::setUp();
//    }
//
//    public function testGetReposModelsCollectionByUser()
//    {
//
//        $userRepos = [
//                [
//                    'id' => 1,
//                    'name' => 'repo1',
//                    'full_name' => 'user/repo1',
//                    'owner' => [
//                        'login' => 'user'
//                    ],
//                    'url' => 'https://url1.com'
//                ],
//                [
//                    'id' => 2,
//                    'name' => 'repo2',
//                    'full_name' => 'user/repo2',
//                    'owner' => [
//                        'login' => 'user'
//                    ],
//                    'url' => 'https://url2.com'
//                ]
//        ];
//        $githubProviderMock = $this->getMock('\LS\LongestStreakBundle\Provider\GitHubProvider', ['getUserRepos'], [], '', false);
//        $githubProviderMock
//            ->expects($this->any())
//            ->method('getUserRepos')
//            ->will($this->returnValue($userRepos));
//        $emMock = $this->getMock('\Doctrine\ORM\EntityManager', [], [], '', false);
//
//        $userManager = new UserManager($githubProviderMock, $emMock);
//        $actual = $userManager->getReposModelsCollectionByUser('user');
//        $expected = new ArrayCollection(
//            [
//                (new Repo())
//                    ->setUser('user')
//                    ->setUrl('https://url1.com')
//                    ->setName('repo1'),
//                (new Repo())
//                    ->setUser('user')
//                    ->setUrl('https://url2.com')
//                    ->setName('repo2')
//            ]
//        );
//
//        $this->assertEquals($expected, $actual);
//    }
//
//    public function testGetUserCommitsFromRepo()
//    {
//        $githubProviderMock = $this->getMock('\LS\LongestStreakBundle\Provider\GitHubProvider', ['getUserCommitsFromRepo'], [], '', false);
//        $githubProviderMock
//            ->expects($this->any())
//            ->method('getUserCommitsFromRepo')
//            ->will($this->returnValue($this->getCommitsFromRepoGitResponse()));
//        $emMock = $this->getMock('\Doctrine\ORM\EntityManager', [], [], '', false);
//
//        $userManager = new UserManager($githubProviderMock, $emMock);
//        $actual = $userManager->getUserCommitsFromRepo('user', 'repo');
//
//        $expected = new ArrayCollection(
//            [
//                (new Commit())
//                    ->setSha('7a3262ca66329a78225034946db8a890ff136c82')
//                    ->setCommitter('msf0r')
//                    ->setCommittedAt(new \DateTime('2014-11-21T09:54:58Z')),
//                (new Commit())
//                    ->setSha('62e7ac1ccd902242fa948cc1a27f6f45721a1252')
//                    ->setCommitter('msf0r')
//                    ->setCommittedAt(new \DateTime('2014-11-21T09:16:53Z'))
//            ]
//        );
//        $this->assertEquals($expected, $actual);
//    }
//
//    private function getCommitsFromRepoGitResponse()
//    {
//        return json_decode('[ { "sha": "7a3262ca66329a78225034946db8a890ff136c82", "commit": { "author": { "name": "Andrey M", "email": "a.mazuryan@gmail.com", "date": "2014-11-21T09:54:58Z" }, "committer": { "name": "Andrey M", "email": "a.mazuryan@gmail.com", "date": "2014-11-21T09:54:58Z" }, "message": "Test options connection fix", "tree": { "sha": "8bbf81fada33a622e0db264b545a00c17bf79d5c", "url": "https://api.github.com/repos/fabiang/xmpp/git/trees/8bbf81fada33a622e0db264b545a00c17bf79d5c" }, "url": "https://api.github.com/repos/fabiang/xmpp/git/commits/7a3262ca66329a78225034946db8a890ff136c82", "comment_count": 0 }, "url": "https://api.github.com/repos/fabiang/xmpp/commits/7a3262ca66329a78225034946db8a890ff136c82", "html_url": "https://github.com/fabiang/xmpp/commit/7a3262ca66329a78225034946db8a890ff136c82", "comments_url": "https://api.github.com/repos/fabiang/xmpp/commits/7a3262ca66329a78225034946db8a890ff136c82/comments", "author": { "login": "msf0r", "id": 2970001, "avatar_url": "https://avatars.githubusercontent.com/u/2970001?v=3", "gravatar_id": "", "url": "https://api.github.com/users/msf0r", "html_url": "https://github.com/msf0r", "followers_url": "https://api.github.com/users/msf0r/followers", "following_url": "https://api.github.com/users/msf0r/following{/other_user}", "gists_url": "https://api.github.com/users/msf0r/gists{/gist_id}", "starred_url": "https://api.github.com/users/msf0r/starred{/owner}{/repo}", "subscriptions_url": "https://api.github.com/users/msf0r/subscriptions", "organizations_url": "https://api.github.com/users/msf0r/orgs", "repos_url": "https://api.github.com/users/msf0r/repos", "events_url": "https://api.github.com/users/msf0r/events{/privacy}", "received_events_url": "https://api.github.com/users/msf0r/received_events", "type": "User", "site_admin": false }, "committer": { "login": "msf0r", "id": 2970001, "avatar_url": "https://avatars.githubusercontent.com/u/2970001?v=3", "gravatar_id": "", "url": "https://api.github.com/users/msf0r", "html_url": "https://github.com/msf0r", "followers_url": "https://api.github.com/users/msf0r/followers", "following_url": "https://api.github.com/users/msf0r/following{/other_user}", "gists_url": "https://api.github.com/users/msf0r/gists{/gist_id}", "starred_url": "https://api.github.com/users/msf0r/starred{/owner}{/repo}", "subscriptions_url": "https://api.github.com/users/msf0r/subscriptions", "organizations_url": "https://api.github.com/users/msf0r/orgs", "repos_url": "https://api.github.com/users/msf0r/repos", "events_url": "https://api.github.com/users/msf0r/events{/privacy}", "received_events_url": "https://api.github.com/users/msf0r/received_events", "type": "User", "site_admin": false }, "parents": [ { "sha": "62e7ac1ccd902242fa948cc1a27f6f45721a1252", "url": "https://api.github.com/repos/fabiang/xmpp/commits/62e7ac1ccd902242fa948cc1a27f6f45721a1252", "html_url": "https://github.com/fabiang/xmpp/commit/62e7ac1ccd902242fa948cc1a27f6f45721a1252" } ] }, { "sha": "62e7ac1ccd902242fa948cc1a27f6f45721a1252", "commit": { "author": { "name": "Andrey M", "email": "a.mazuryan@gmail.com", "date": "2014-11-21T09:16:53Z" }, "committer": { "name": "Andrey M", "email": "a.mazuryan@gmail.com", "date": "2014-11-21T09:16:53Z" }, "message": "Test options connection", "tree": { "sha": "082ba2fe5133d08dbede5da56ca8f2cc369f4db2", "url": "https://api.github.com/repos/fabiang/xmpp/git/trees/082ba2fe5133d08dbede5da56ca8f2cc369f4db2" }, "url": "https://api.github.com/repos/fabiang/xmpp/git/commits/62e7ac1ccd902242fa948cc1a27f6f45721a1252", "comment_count": 0 }, "url": "https://api.github.com/repos/fabiang/xmpp/commits/62e7ac1ccd902242fa948cc1a27f6f45721a1252", "html_url": "https://github.com/fabiang/xmpp/commit/62e7ac1ccd902242fa948cc1a27f6f45721a1252", "comments_url": "https://api.github.com/repos/fabiang/xmpp/commits/62e7ac1ccd902242fa948cc1a27f6f45721a1252/comments", "author": { "login": "msf0r", "id": 2970001, "avatar_url": "https://avatars.githubusercontent.com/u/2970001?v=3", "gravatar_id": "", "url": "https://api.github.com/users/msf0r", "html_url": "https://github.com/msf0r", "followers_url": "https://api.github.com/users/msf0r/followers", "following_url": "https://api.github.com/users/msf0r/following{/other_user}", "gists_url": "https://api.github.com/users/msf0r/gists{/gist_id}", "starred_url": "https://api.github.com/users/msf0r/starred{/owner}{/repo}", "subscriptions_url": "https://api.github.com/users/msf0r/subscriptions", "organizations_url": "https://api.github.com/users/msf0r/orgs", "repos_url": "https://api.github.com/users/msf0r/repos", "events_url": "https://api.github.com/users/msf0r/events{/privacy}", "received_events_url": "https://api.github.com/users/msf0r/received_events", "type": "User", "site_admin": false }, "committer": { "login": "msf0r", "id": 2970001, "avatar_url": "https://avatars.githubusercontent.com/u/2970001?v=3", "gravatar_id": "", "url": "https://api.github.com/users/msf0r", "html_url": "https://github.com/msf0r", "followers_url": "https://api.github.com/users/msf0r/followers", "following_url": "https://api.github.com/users/msf0r/following{/other_user}", "gists_url": "https://api.github.com/users/msf0r/gists{/gist_id}", "starred_url": "https://api.github.com/users/msf0r/starred{/owner}{/repo}", "subscriptions_url": "https://api.github.com/users/msf0r/subscriptions", "organizations_url": "https://api.github.com/users/msf0r/orgs", "repos_url": "https://api.github.com/users/msf0r/repos", "events_url": "https://api.github.com/users/msf0r/events{/privacy}", "received_events_url": "https://api.github.com/users/msf0r/received_events", "type": "User", "site_admin": false }, "parents": [ { "sha": "47fdbe4a60ef0e726c4aaf39d6eb57afd42915c8", "url": "https://api.github.com/repos/fabiang/xmpp/commits/47fdbe4a60ef0e726c4aaf39d6eb57afd42915c8", "html_url": "https://github.com/fabiang/xmpp/commit/47fdbe4a60ef0e726c4aaf39d6eb57afd42915c8" } ] } ]', JSON_PRETTY_PRINT);
//    }
//}