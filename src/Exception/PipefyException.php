<?php

declare(strict_types=1);

namespace AndremeirelesPipefy\Exception;

class PipefyException extends \Exception
{
    public function __construct(string $errorMessage)
    {
        $this->message = $errorMessage;
    }
}