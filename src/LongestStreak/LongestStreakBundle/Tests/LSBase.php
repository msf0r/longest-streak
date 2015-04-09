<?php

namespace LongestStreak\LongestStreakBundle\Tests;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Symfony\Bridge\Doctrine\DataFixtures\ContainerAwareLoader;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpKernel\Client;
use Symfony\Component\Routing\Router;
use Doctrine\ORM\EntityManager;

class LSBase extends WebTestCase
{
    /** @var Client */
    protected $client;
    /** @var ContainerInterface */
    protected $container;
    /** @var EntityManager */
    protected $em;
    /** @var Router */
    protected $router;

    public function setUp()
    {
        $this->client = static::createClient();
        $this->container = $this->client->getKernel()->getContainer();
        $this->router = $this->container->get('router');
        $this->em = $this->container->get('doctrine.orm.default_entity_manager');

    }

    protected function  loadFixtures($fixtures = [])
    {
        $loader = new ContainerAwareLoader($this->container);
        foreach ($fixtures as $fixture) {
            $loader->addFixture($fixture);
        }
        $purger = new ORMPurger($this->em);
        $purger->setPurgeMode(2);
        $this->em->getConnection()->executeUpdate("SET foreign_key_checks = 0;");

        $executor = new ORMExecutor($this->em, $purger);
        $executor->execute($loader->getFixtures());
    }
} 