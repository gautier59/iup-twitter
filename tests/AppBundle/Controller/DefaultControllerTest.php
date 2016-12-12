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
}
