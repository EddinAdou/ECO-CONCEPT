<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SignupControllerTest extends WebTestCase
{
    public function testSignup()
    {
        $client = static::createClient();

        // Envoie d'une requête POST avec les données nécessaires pour l'inscription
        $client->request('POST', '/api/signup', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode([
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'johndoe@example.com',
            'password' => 'securepassword'
        ]));

        // Vérifie la réponse du serveur
        $this->assertEquals(201, $client->getResponse()->getStatusCode());

        // Vérifie que la réponse contient les données attendues
        $responseData = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('id', $responseData);
        $this->assertEquals('John', $responseData['firstname']);
        $this->assertEquals('Doe', $responseData['lastname']);
        $this->assertEquals('johndoe@example.com', $responseData['email']);
    }
}
