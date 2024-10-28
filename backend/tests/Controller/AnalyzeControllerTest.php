<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AnalyzeControllerTest extends WebTestCase
{
public function testAnalyzeService()
{
$client = static::createClient();
$client->request('POST', '/api/analyze', [
'json' => [
'url' => 'https://example.com'
],
]);

$this->assertResponseIsSuccessful();
$this->assertJsonContains(['score']);
}
}
