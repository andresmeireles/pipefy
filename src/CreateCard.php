<?php

declare(strict_types=1);

namespace AndremeirelesPipefy;

use AndremeirelesPipefy\Exception\PipefyException;

class CreateCard extends Post
{
    /**
     * @param string $cardTitle
     * @param integer $pipeId Pipefy pipe number
     * @param array<int> $assigneeIds Pipefy customer id
     * @return array
     */
    public function create(string $cardTitle, int $pipeId, ?array $assigneeIds = null): array
    {
        $body = sprintf(
            '{"mutation": "{ createCard (input: { title: %s pipe_id: %s assignee_id: [%s] }) { card { title } clientMutationId } }"}',
            $cardTitle,
            $pipeId,
            $assigneeIds === null ? '' : implode(',', $assigneeIds)
        );
        $response = json_decode($this->pipefyPost($body)->getBody()->getContents(), true);
        if (array_key_exists('errors', $response)) {
            throw new PipefyException($response['errors']['message']);
        }

        return PipefyResponse::successStringResponse('card was successfully created!');
    }
}