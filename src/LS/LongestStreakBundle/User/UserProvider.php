<?php

namespace LS\LongestStreakBundle\User;

use Doctrine\ORM\EntityManager;
use HWI\Bundle\OAuthBundle\OAuth\RequestDataStorage\SessionStorage;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;
use LongestStreak\LongestStreakBundle\Entity\User;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements OAuthAwareUserProviderInterface, UserProviderInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    /**
     * @var \HWI\Bundle\OAuthBundle\OAuth\RequestDataStorage\SessionStorage
     */
    private $sessionStorage;

    public function __construct(EntityManager $em, SessionStorage $sessionStorage)
    {
        $this->em = $em;
        $this->sessionStorage = $sessionStorage;
    }

    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $user = $this->em->getRepository('LSLongestStreakBundle:User')->findOneBy(['login'=>$response->getNickname()]);

        if ($user) {
            return $user;
        }

        $user = new User();
        $user->setLogin($response->getNickname());
        $user->setGithubId($response->getUsername());
        $user->setEmail($response->getEmail());

        $this->em->persist($user);
        $this->em->flush();

        $this->sessionStorage->save($response->getResourceOwner(),[]);

        return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException();
        }

        return $this->em->getRepository('LSLongestStreakBundle:User')->find($user->getId());
    }

    public function loadUserByUsername($username)
    {
        throw new \BadMethodCallException();
    }

    public function supportsClass($class)
    {
        return $class === get_class($this);
    }

}
