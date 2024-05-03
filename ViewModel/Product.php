<?php

declare(strict_types=1);

namespace Macademy\ProductCompare\ViewModel;

use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Product implements ArgumentInterface
{
    /** @var array */
    private array $products = [];

    /** @var array */
    private array $invalidSkus = [];

    /**
     * @param RequestInterface $request
     * @param ProductRepository $productRepository
     */
    public function __construct(
        private readonly RequestInterface $request,
        private readonly ProductRepository $productRepository,
    ) {
        $skus = (array)$this->request->getParam('skus');

        $this->setProductsFromSkus($skus);
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

    /**
     * Set products from SKUs.
     *
     * @param array $skus
     * @return void
     */
    private function setProductsFromSkus(
        array $skus,
    ): void {
        foreach ($skus as $sku) {
            try {
                $this->products[] = $this->productRepository->get($sku);
            } catch (NoSuchEntityException) {
                $this->invalidSkus[] = $sku;
            }
        }
    }
}
