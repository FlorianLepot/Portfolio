<?php

namespace FL\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryControllerTest extends WebTestCase
{
    public function testMenucategories()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/categories/menu');
    }

}
