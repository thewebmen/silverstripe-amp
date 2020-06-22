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

    public function onAfterInit()
    {
        if ($this->owner->getRequest()->param('Action') != 'amp') {
            Requirements::insertHeadTags('<link rel="amphtml" href="' . $this->owner->AbsoluteLink('amp') . '">');
        }
    }

    public function amp()
    {
        return AMPDirector::singleton()->handle($this->owner);
    }
}
