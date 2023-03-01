<?php

namespace morlowsk\corephp\exception;

/**
 * Summary of NotFoundException
 * @author Michal Orlowski
 * @copyright (c) 2023
 */
class NotFoundException extends \Exception
{
    protected $message = 'Page not found';
    protected $code = 404;
}