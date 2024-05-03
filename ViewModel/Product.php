<?php

declare(strict_types=1);

namespace Macademy\ProductCompare\ViewModel;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Product implements ArgumentInterface
{
    /** @var array */
    private array $products = [];

    /** @var array */
    private array $invalidSkus = [];

    /**
     * @param RequestInterface $request
     */
    public function __construct(
        private readonly RequestInterface $request,
    ) {
        $skus = (array)$this->request->getParam('skus');
        dd($skus);
    }

    /**
     * Get products.
     *
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * Get invalid SKUs.
     *
     * @return array
     */
    public function getInvalidSkus(): array
    {
        return $this->invalidSkus;
    }
}
