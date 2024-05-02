<?php

declare(strict_types=1);

namespace Macademy\ProductCompare\Controller;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;

class Router implements RouterInterface
{
    /**
     * Match a route to this router.
     *
     * @param RequestInterface $request
     * @return ActionInterface|null
     */
    public function match(
        RequestInterface $request,
    ): ActionInterface|null {
        $path = trim($request->getPathInfo(), '/');
        $pathParts = explode('/', $path);

        if ($pathParts[0] === 'compare') {
            dd('match');
        }

        dd('no match');
    }
}
