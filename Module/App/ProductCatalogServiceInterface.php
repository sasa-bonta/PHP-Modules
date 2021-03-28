<?php

namespace Module\ProductModule\App;

use Module\ProductModule\Domain\Product;
use Module\ProductModule\Domain\ProductCollection;
use Module\ProductModule\Domain\SearchCriteria;

interface ProductCatalogServiceInterface {

    # CRUD
    public function getProductByCode(string $productCode): Product;    # @todo ProductNotFoundException
    public function searchProduct(SearchCriteria $sc): ProductCollection; # @todo =: Exceptions in //Search Criteria
    public function createProduct(Product $product): bool;  # @todo ProductCodeDuplicateException
    public function updateProduct(Product $product): bool;   # @todo ProductNotFoundException
    public function deleteProductByCode(string $productCode): bool;
}