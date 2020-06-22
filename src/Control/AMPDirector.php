<?php

namespace Webmen\AMP\Control;

use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\Core\Config\Configurable;
use SilverStripe\Core\Injector\Injectable;
use SilverStripe\View\Requirements;
use Webmen\AMP\Helpers\AMPHelper;
use Webmen\AMP\Middleware\AMPMiddleware;
use Webmen\AMP\View\AMPRequirements;

class AMPDirector
{
    use Configurable;
    use Injectable;

    /**
     * @var AMPMiddleware[]
     */
    private $middlewares = [];

    /** @var AMPHelper */
    private $helper;

    public function __construct()
    {
        $this->helper = new AMPHelper();
    }

    /**
     * @param ContentController $controller
     * @return \SilverStripe\ORM\FieldType\DBHTMLText
     */
    public function handle(ContentController $controller)
    {
        Requirements::clear();

        Requirements::insertHeadTags('<script async src="https://cdn.ampproject.org/v0.js"></script>');
        Requirements::insertHeadTags(sprintf('<style amp-custom>%s</style>', AMPRequirements::getStyles()));

        $layout = $this->helper->renderLayout($controller);
        $layout = $this->process($layout);

        $html = $this->helper->renderHtml($controller, $layout);

        return $html;
    }

    /**
     * @param string $html
     * @return string
     */
    public function process(string $html)
    {
        foreach ($this->getMiddlewares() as $middleware) {
            $html = $middleware->process($html);
        }

        return $html;
    }

    /**
     * @return AMPMiddleware[]
     */
    public function getMiddlewares()
    {
        return $this->middlewares;
    }

    /**
     * @param AMPMiddleware[] $middlewares
     * @return $this
     */
    public function setMiddlewares($middlewares)
    {
        $this->middlewares = array_filter((array)$middlewares);
        return $this;
    }

    /**
     * @param AMPMiddleware $middleware
     * @return $this
     */
    public function addMiddleware(AMPMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
        return $this;
    }
}
