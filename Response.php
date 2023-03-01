<?php

namespace morlowsk\corephp;

/**
 * Summary of Response
 * @author Michal Orlowski
 * @copyright (c) 2023
 */
class Response 
{ 
    /**
     * Summary of setStatusCode
     * @param int $code
     * @return void
     * @author Michal Orlowski
     */
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    public function redirect(string $url)
    {
        header('Location: ' . $url);
    }
}