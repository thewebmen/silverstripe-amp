<?php

namespace Webmen\AMP\Extensions;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Core\Extension;
use Webmen\AMP\Control\AMPDirector;

/**
 * @property SiteTree $owner
 */
class AMPPageControllerExtension extends Extension
{
    private static $allowed_actions = [
        'amp'
    ];

    public function amp()
    {
        return AMPDirector::singleton()->handle($this->owner);
    }
}
