<?php

namespace Webmen\AMP\Middleware;

interface AMPMiddleware
{
    /**
     * @param string $html
     * @return string
     */
    public function process(string $html);
}
