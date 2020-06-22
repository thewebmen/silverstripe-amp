<?php

namespace Webmen\AMP\Middleware;

use SilverStripe\View\Requirements;

class AMPIframeReplacementMiddleware implements AMPMiddleware
{
    public function process(string $html)
    {
        $html = preg_replace(
            '/<iframe([^>]+)><\/iframe>/',
            '<amp-iframe sandbox="allow-scripts allow-same-origin allow-presentation" layout="responsive"$1></amp-iframe>',
            $html,
            -1,
            $count
        );

        if ($count) {
            Requirements::insertHeadTags('<script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>');
        }

        return $html;
    }
}
