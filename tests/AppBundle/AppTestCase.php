<?php

namespace Tests\AppBundle;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;

abstract class AppTestCase extends WebTestCase
{
    private $client = null;

    public function getClient()
    {
        return $this->client;
    }

    public function setUp()
    {
        parent::setUp();

        $this->client = static::createClient();
    }

    public function logInAs($username)
    {
        $container = $this->client->getContainer();
        $session = $container->get('session');

        $userManager = $container->get('fos_user.user_manager');
        $loginManager = $container->get('fos_user.security.login_manager');
        $firewallName = $container->getParameter('fos_user.firewall_name');

        $user = $userManager->findUserBy(array('username' => $username));
        $loginManager->loginUser($firewallName, $user);

        $session->set('_security_'.$firewallName, serialize($container->get('security.token_storage')->getToken()));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }

    /**
     * Return the user id of the logged in user.
     * You should be sure that you called `logInAs` before.
     *
     * @return int
     */
    public function getLoggedInUserId()
    {
        $token = static::$kernel->getContainer()->get('security.token_storage')->getToken();

        if (null !== $token) {
            return $token->getUser()->getId();
        }

        throw new \RuntimeException('No logged in User.');
    }
}