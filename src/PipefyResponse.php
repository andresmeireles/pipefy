<?php

declare(strict_types=1);

namespace AndremeirelesPipefy;

class PipefyResponse
{
    public function __construct(
        private mixed $response,
        private bool $success
    )
    {}

    /**
     * @param string $response
     * @return array
     */
    public static function successStringResponse(string $response): array
    {
        $new = new static($response, true);
        return $new->getResponse();
    }

    /**
     * @return array<string, mixed> associative array with keys `message` and `success` as boolean
     */
    public function getResponse(): array
    {
        return [
            'message' => $this->response,
            'success' => $this->success
        ];
    }
}