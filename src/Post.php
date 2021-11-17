<?php

declare(strict_types=1);

namespace AndremeirelesPipefy;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;

abstract class Post
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    protected function client(): Client
    {
        return $this->client;
    }

    protected function pipefyPost(string $body): Response
    {
        try {
            return $this->client()->post(
                'https://api.pipefy.com/graphql',
                [
                    'body' => $body,
                    'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => sprintf('Bearer %s', $_ENV['PIPEFY_KEY']),
                        'Content-Type' => 'application/json'
                    ]
                ]
            );
        } catch (RequestException $err) {
            return $err->getResponse();
        }
    }
}