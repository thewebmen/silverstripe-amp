<?php

namespace Webmen\AMP\Middleware;

use SilverStripe\View\Requirements;

class AMPImageReplacementMiddleware implements AMPMiddleware
{
    public function process(string $html)
    {
        $html = preg_replace(
            '/<img([^>]+)\/?>/',
            '<amp-img layout="responsive"$1></amp-img>',
            $html,
            -1,
            $count
        );

        return $html;
    }
}
