<?php declare(strict_types=1);

namespace BySudo\EasyCat\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Catalog\Model\Product\Visibility;
use Magento\Catalog\Model\Product;

/**
 * Block class for displaying a list of products.
 */
class ProductList extends Template
{
    /**
     * ProductList constructor with property promotion.
     *
     * @param Context $context
     * @param CollectionFactory $productCollectionFactory
     * @param Visibility $visibility
     * @param array $data
     */
    public function __construct(
        Context $context,
        private CollectionFactory $productCollectionFactory,
        private Visibility $visibility,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Get a collection of visible and enabled products.
     *
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    public function getProductCollection(): object
    {
        $collection = $this->productCollectionFactory->create();
        $collection->addAttributeToSelect('*')
            ->addAttributeToFilter('visibility', ['in' => $this->visibility->getVisibleInSiteIds()])
            ->addAttributeToFilter('status', 1)
            ->setPageSize(20);

        return $collection;
    }

    /**
     * Get the rendered price HTML for a product.
     *
     * @param Product $product
     * @return string
     */
    public function getProductPrice(Product $product): string
    {
        return $this->getLayout()
            ->createBlock(\Magento\Framework\Pricing\Render::class)
            ->render('final_price', $product, []);
    }
}
