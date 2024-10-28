<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginControllerTest extends WebTestCase
{
public function testUserCanLogin()
{
$client = static::createClient();
$client->request('POST', '/api/login', [
'json' => [
'email' => 'test@example.com',
'password' => 'password'
],
]);

$this->assertResponseIsSuccessful();
$this->assertJsonContains(['token']);
}
}
