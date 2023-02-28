<?php

namespace app\core\exception;

/**
 * Summary of ForbiddenException
 * @author Michal Orlowski
 * @copyright (c) 2023
 */
class ForbiddenException extends \Exception
{
    protected $message = 'You don\'t have permission to access this page';
    protected $code = 403;
}