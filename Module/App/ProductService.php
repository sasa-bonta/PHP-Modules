<?php


namespace Module\ProductModule\App;


use Module\ProductModule\Domain\Exceptions\ProductCodeDuplicateException;
use Module\ProductModule\Domain\Exceptions\ProductNotFoundException;
use Module\ProductModule\Domain\Product;
use Module\ProductModule\Domain\ProductCollection;
use Module\ProductModule\Domain\SearchCriteria;
use Module\ProductModule\Infrastructure\ProductRepositoryFS;

class ProductService implements ProductCatalogServiceInterface
{
    /**
     * @var ProductRepositoryFS
     */
    private ProductRepositoryFS $pr;

    /**
     * ProductService constructor.
     */
    public function __construct()
    {
        $this->pr = new ProductRepositoryFS();
    }


    public function getProductByCode(string $productCode): Product
    {
        try {
            return $this->pr->getProductByCode($productCode);
        } catch (ProductNotFoundException $e) {
            throw new ProductNotFoundException("\n---Duplicated code! Service\n");
        }
    }

    public function searchProduct(SearchCriteria $sc): ProductCollection
    {
        return $this->pr->searchProduct($sc);
    }

    public function createProduct(Product $product): bool
    {
        try {
            return $this->pr->createProduct($product);
        } catch (ProductCodeDuplicateException $e) {
            throw new ProductCodeDuplicateException("\n---Duplicated code! Service\n");
        }

    }

    public function updateProduct(Product $product): bool
    {
        return $this->pr->updateProduct($product);
    }

    public function deleteProductByCode(string $productCode): bool
    {
        return $this->pr->deleteProductByCode($productCode);
    }
}