<?php


namespace Module\ProductModule;


class ProductCollection extends \ArrayObject
{
    private array $productsToDisplay = [];

    /**
     * ProductCollection constructor.
     * @param array $products
     */
    public function __construct(array $products)
    {
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