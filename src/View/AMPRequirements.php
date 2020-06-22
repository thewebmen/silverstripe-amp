<?php

namespace Webmen\AMP\View;

use SilverStripe\Core\Manifest\ModuleResourceLoader;
use SilverStripe\View\SSViewer;
use SilverStripe\View\ThemeResourceLoader;

class AMPRequirements
{
    private static $cssFiles = [];


    public static function css(string $path)
    {
        self::$cssFiles[] = ModuleResourceLoader::singleton()->resolvePath($path);
    }

    public static function themedCss(string $name)
    {
        self::css(ThemeResourceLoader::inst()->findThemedCSS($name, SSViewer::get_themes()));
    }

    public static function getCssFiles()
    {
        return self::$cssFiles;
    }

    /**
     * @return string
     */
    public static function getStyles()
    {
        $styles = '';

        foreach (self::getCssFiles() as $cssFile) {
            $styles .= file_get_contents(BASE_PATH . '/' . $cssFile);
        }

        return $styles;
    }
}
