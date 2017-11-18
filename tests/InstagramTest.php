<?php

/*
 * This file is part of Instagram.
 *
 * (c) Xalid Balagozov <xalidbalagozov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace CodFee\Tests\Instagram;

use GuzzleHttp\Psr7\Response;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;
use CodFee\Instagram\Instagram;
use CodFee\Instagram\InstagramException;

/**
 * This is the instagram test class.
 *
 * @author Xalid Balagozov <xalidbalagozov@gmail.com>
 */
class InstagramTest extends TestCase
{
    public function testGet()
    {
        $response = new Response(200, [], json_encode([
            'data' => range(0, 19),
        ]));

        $client = new Client();
        $client->addResponse($response);

        $instagram = new Instagram('jerryseinfeld', $client);
        $items = $instagram->get();

        $this->assertInternalType('array', $items);
        $this->assertCount(20, $items);
    }

    public function testError()
    {
        $this->expectException(InstagramException::class);
        $this->expectExceptionMessage('The access_token provided is invalid.');

        (new Instagram('imspeechlessihavenospeech'))->get();
    }
}