<?php

declare(strict_types=1);

namespace Macademy\ProductCompare\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class Product implements ArgumentInterface
{
    /** @var array */
    private array $products = [];

    /** @var array */
    private array $invalidSkus = [];

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
