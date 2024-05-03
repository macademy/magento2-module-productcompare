<?php

declare(strict_types=1);

namespace Macademy\ProductCompare\ViewModel;

use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
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
     * @param FilterBuilder $filterBuilder
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        private readonly RequestInterface $request,
        private readonly ProductRepository $productRepository,
        private readonly FilterBuilder $filterBuilder,
        private readonly SearchCriteriaBuilder $searchCriteriaBuilder,
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
        $skuFilter = $this->filterBuilder
            ->setField('sku')
            ->setValue($skus)
            ->setConditionType('in')
            ->create();
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilters([$skuFilter])
            ->create();
        $this->products = $this->productRepository->getList($searchCriteria)->getItems();
    }
}
