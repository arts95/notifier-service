<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 30.11.17
 */

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

/**
 * Class RequesterServiceTest
 *
 * @covers \app\services\RequesterService
 */
class RequesterServiceTest extends TestCase
{
    /** @todo write a test for test :) */
    public function testGetDb()
    {
        $client = new Client([
            'base_uri' => 'http://notifier.dev/',
        ]);
        $response = $client->get('test');
        $data = json_decode($response->getBody(), true);
        $this->assertNotEmpty($data);
    }
}
