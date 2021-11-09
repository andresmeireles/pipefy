<?php

declare(strict_types=1);

namespace AndremeirelesPipefy;

use GuzzleHttp\Client;

class Query
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * How query was build [organization [ members [ user [ id, uuid, name, email ]]]]
     * 
     * @param int $organizationId
     * @return array associative array in this sequence `data` => `organization` => `members` => 
     * array<key, array<user <id, uuid, name, email>>> 
     */
    public function getOrganizationUsers(int $organizationId): array
    {
        $query = sprintf('{
            "query": "{ organization (id: %s) { members { user { id uuid name email } } } }"
        }', $organizationId);
        $response = $this->client->post(
            'https://api.pipefy.com/graphql',
            [
                'body' => $query,
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => sprintf('Bearer %s', $_ENV['PIPEFY_KEY']),
                    'Content-Type' => 'application/json'
                ]
            ]
        );

        return json_decode($response->getBody()->getContents(), true);
    }
}
