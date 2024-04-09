<?php

namespace DevPontes\View\Exception;

use Exception;
use Throwable;

/**
 * Class DevPontes View
 *
 * @author Moises Pontes <sesiom_assis@hotmail.com>
 * @package DevPontes\View\Exception
 */
class ErrorRender extends Exception
{
    /**
     * ErrorRender constructor.
     *
     * @param string $message
     * @param integer $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message, int $code = 1, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
