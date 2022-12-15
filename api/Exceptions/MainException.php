<?php
namespace Api\Exceptions;

use JetBrains\PhpStorm\Pure;
use RuntimeException;

class MainException extends RuntimeException
{
    public string $debugMessage;

    #[Pure] public function __construct($message, string $debugMessage)
    {
        parent::__construct($message, 0, null);
        $this->debugMessage = $debugMessage;

    }
}
