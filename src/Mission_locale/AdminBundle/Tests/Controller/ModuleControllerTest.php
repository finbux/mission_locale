<?php

namespace Mission_locale\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ModuleControllerTest extends WebTestCase
{
    public function testAppel()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/module/appel');
    }

    public function testSlogan()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/module/slogan');
    }

    public function testAntenne()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/module/antenne');
    }

}
