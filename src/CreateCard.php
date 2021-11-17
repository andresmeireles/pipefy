<?php

declare(strict_types=1);

namespace AndremeirelesPipefy;

use AndremeirelesPipefy\Exception\PipefyException;
use GraphQL\Type\Definition\ObjectType;

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
            '{"query":"mutation { createCard (input: {title: \\"%s\\" pipe_id: %s assignee_ids: [%s] fields_attributes : [ {field_id: \\"email\\" field_value: \\"jooj\\"} {field_id: \\"nome_do_rapaz\\" field_value: \\"andre meireles\\"} ] } ) { card { title } clientMutationId } }"}',
            $cardTitle,
            $pipeId,
            $assigneeIds === null ? '' : implode(',', $assigneeIds)
        );
        $request = $this->pipefyPost($body)->getBody()->getContents();
        $response = json_decode($request, true, 512, JSON_THROW_ON_ERROR);
        if (array_key_exists('errors', $response)) {
            throw new PipefyException($response['errors']['message']);
        }

        return PipefyResponse::successStringResponse('card was successfully created!');
    }
}