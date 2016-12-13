<?php

namespace Tests\AppBundle\Controller;

use Tests\AppBundle\AppTestCase;

class DefaultControllerTest extends AppTestCase
{
    public function testIndexLogout()
    {
        $client = $this->getClient();
        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Login', $client->getResponse()->getContent());
    }

    public function testIndexLogged()
    {
        $this->logInAs('nicolas');

        $client = $this->getClient();
        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Logout', $client->getResponse()->getContent());
    }

    public function testJaimeJaimeplus()
    {
        $this->logInAs('nicolas');

        $client = $this->getClient();
        $crawler = $client->request('GET', '/');

        // Chercher dans la page un message dont le texte est "j'aime"
        $link = $crawler
            ->filter('a:contains("J\'aime")')
            ->eq(0)
            ->link()
        ;
        $crawler = $client->click($link);
        $crawler = $client->followRedirect();

        $this->assertNotContains("J'aime", $client->getResponse()->getContent());

        // Je remets les données comme elles l'étaient au début du test
        $link = $crawler
            ->filter('a:contains("aime plus")')
            ->eq(0)
            ->link()
        ;
        $client->click($link);
        $client->followRedirect();

        $this->assertNotContains('aime plus', $client->getResponse()->getContent());
    }
}
