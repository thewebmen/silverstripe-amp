<?php

namespace Webmen\AMP\Helpers;

use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\View\SSViewer;

class AMPHelper
{
    public function renderLayout(ContentController $controller)
    {
        $templates = SSViewer::get_templates_by_class(
            get_class($controller->data()),
            '_amp',
            Page::class
        );
        $templates['type'] = 'Layout';

        $viewer = new SSViewer($templates);

        $layout = $viewer->process($controller);

        return $layout;
    }

    public function renderHtml(ContentController $controller, string $layout)
    {
        $templates = SSViewer::get_templates_by_class(
            get_class($controller->data()),
            '_amp',
            Page::class
        );

        $viewer = new SSViewer($templates);

        $html = $viewer->process($controller, [
            'Layout' => DBField::create_field('HTMLText', $layout, null, ['shortcodes' => false])
        ]);

        return $html;
    }
}
