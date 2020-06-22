<?php

namespace Webmen\AMP\Middleware;

use SilverStripe\View\Requirements;

class AMPRemoveAttributesMiddleware implements AMPMiddleware
{
    public function process(string $html)
    {
        return preg_replace('/thumbnail="[^"]*"/', '$1', $html);
    }
}
