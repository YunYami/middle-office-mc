<?php

namespace Gupo\MiddleOfficeMc\Exception;

use Exception;

/**
 * Class CenterException
 *
 * @package Gupo\MiddleOfficeMc\Exception
 * @author wm
 */
class CenterException extends Exception
{
    /**
     * ClientException constructor
     *
     * @param $errorMessage
     * @param $errorCode
     * @param $previous
     */
    public function __construct($errorMessage, $errorCode = 0, $previous = null)
    {
        parent::__construct($errorMessage, $errorCode, $previous);
    }
}
