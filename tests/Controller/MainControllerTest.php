<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MainControllerTest extends WebTestCase
{
    public function testSumGet()
    {
        $client = static::createClient();
        $client->request('GET', '/sum/2/3');

        $this->assertResponseIsSuccessful();
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals('sum', $data['operation']);
        $this->assertEquals(5, $data['result']);
    }

    public function testMultiplyGet()
    {
        $client = static::createClient();
        $client->request('GET', '/multiply/2/3');

        $this->assertResponseIsSuccessful();
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals('multiply', $data['operation']);
        $this->assertEquals(6, $data['result']);
    }

    public function testSumPost()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/sum',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['a' => 2, 'b' => 3])
        );

        $this->assertResponseIsSuccessful();
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals('sum', $data['operation']);
        $this->assertEquals(5, $data['result']);
    }

    public function testMultiplyPost()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/multiply',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['a' => 2, 'b' => 3])
        );

        $this->assertResponseIsSuccessful();
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals('multiply', $data['operation']);
        $this->assertEquals(6, $data['result']);
    }
}
