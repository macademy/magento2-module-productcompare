<?php

declare(strict_types=1);

namespace Macademy\ProductCompare\ViewModel;

use Magento\Framework\Pricing\Helper\Data as PricingHelper;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Pricing implements ArgumentInterface
{
    /**
     * Constructor.
     *
     * @param PricingHelper $pricingHelper
     */
    public function __construct(
        private readonly PricingHelper $pricingHelper,
    ) {
    }

    /**
     * Format a price as a currency.
     *
     * @param float $price
     * @return string
     */
    public function formatCurrency(
        float $price,
    ): string {
        return $this->pricingHelper->currency($price);
    }
}
