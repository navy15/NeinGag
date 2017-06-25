<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/home');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());



    }

    public function testApiAllPost()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/api/home');

        $this->assertEquals('{
    "1": {
        "id": 1,
        "user": null,
        "image": "e5ceba3e1cdfe07d92ee40ce0751327e.jpeg",
        "votePlus": null,
        "voteMoins": {},
        "title": "test",
        "comments": null,
        "vote": {}
    },
    "2": {
        "id": 2,
        "user": {
            "__initializer__": {},
            "__cloner__": {},
            "__isInitialized__": false
        },
        "image": "0924a350bc1720facb6adbb361473d0b.jpeg",
        "votePlus": null,
        "voteMoins": {},
        "title": "tes",
        "comments": null,
        "vote": {}
    },
    "3": {
        "id": 3,
        "user": {
            "__initializer__": {},
            "__cloner__": {},
            "__isInitialized__": false
        },
        "image": "69ca9f135075442db58c234913269dd6.jpeg",
        "votePlus": null,
        "voteMoins": {},
        "title": "hoahoaho",
        "comments": null,
        "vote": {}
    }
}', $crawler->text());



    }
}
