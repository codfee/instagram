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

namespace CodFee\Instagram;

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\RequestFactory;

/**
 * This is the instagram class.
 *
 * @author Xalid Balagozov <xalidbalagozov@gmail.com>
 */
class Instagram
{
    /**
     * The access token.
     *
     * @var string
     */
    protected $accessToken;

    /**
     * The http client.
     *
     * @var \Http\Client\HttpClient
     */
    protected $httpClient;

    /**
     * The http request factory.
     *
     * @var \Http\Message\RequestFactory
     */
    protected $requestFactory;


    protected $api = 'https://api.instagram.com/v1/';

    /**
     * Create a new instagram instance.
     *
     * @param string $accessToken
     * @param \Http\Client\HttpClient|null $httpClient
     * @param \Http\Message\RequestFactory|null $requestFactory
     *
     * @return void
     */
    public function __construct(string $accessToken, HttpClient $httpClient = null, RequestFactory $requestFactory = null)
    {
        $this->accessToken = $accessToken;
        $this->httpClient = $httpClient ?: HttpClientDiscovery::find();
        $this->requestFactory = $requestFactory ?: MessageFactoryDiscovery::find();
    }

    /**
     * Fetch the media items.
     *
     * @throws \CodFee\Instagram\InstagramException
     *
     * @return array
     */ 


    public function get($table='users',$user='self',$condition='/media/recent'): array
    {   
        $uri = sprintf($this->api.$table.'/'.$user.$condition.'?access_token=%s', $this->accessToken); 
        $request = $this->requestFactory->createRequest('GET', $uri);

        $response = $this->httpClient->sendRequest($request);

        if ($response->getStatusCode() === 400) {
            $body = json_decode((string) $response->getBody());

            throw new InstagramException($body->meta->error_message);
        }

        return json_decode((string) $response->getBody())->data;
    }

    public function getMediaById($id){
        $uri = sprintf($this->api.'media/'.$id.'?access_token=%s', $this->accessToken); 
        $request = $this->requestFactory->createRequest('GET', $uri);

        $response = $this->httpClient->sendRequest($request);

        if ($response->getStatusCode() === 400) {
            $body = json_decode((string) $response->getBody());

            throw new InstagramException($body->meta->error_message);
        }

        return json_decode((string) $response->getBody())->data;

    }
}
