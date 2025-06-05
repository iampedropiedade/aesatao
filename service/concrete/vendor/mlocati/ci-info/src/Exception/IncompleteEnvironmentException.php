<?php

declare(strict_types=1);

namespace CIInfo\Exception;

/**
 * Exception thrown when the list of environment variables is not complete.
 */
class IncompleteEnvironmentException extends PushWithoutBaseCommitException
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
