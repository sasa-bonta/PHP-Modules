<?php


namespace Module\ProductModule;


use ArrayObject;

class ProductCollection extends ArrayObject
{
    private array $productsToDisplay = [];

    /**
     * ProductCollection constructor.
     * @param Product ...$products
     */
    public function __construct(Product ...$products)
    {
        parent::__construct($products);
        $this->productsToDisplay = $products;
    }

    /**
     * @return array
     */
    public function getProductsToDisplay(): array
    {
        return $this->productsToDisplay;
    }

    /**
     * @param array $productsToDisplay
     */
    public function setProductsToDisplay(array $productsToDisplay): void
    {
        $this->productsToDisplay = $productsToDisplay;
    }
}