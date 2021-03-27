<?php


namespace Module\ProductModule;


interface ProductCatalogRepositoryInterface
{
    # CRUD
    public function getProductByCode(string $productCode): Product;
    public function searchProduct(SearchCriteria $sc): ProductCollection;
    public function createProduct(Product $product): bool;
    public function updateProduct(Product $product): bool;
    public function deleteProductByCode(string $productCode):bool;
}