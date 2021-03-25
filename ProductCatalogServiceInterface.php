<?php


interface ProductCatalogServiceInterface {

    # CRUD
    public function getProductByCode(string $productCode);
    public function searchProduct(SearchCriteria $sc);		# add search criteria
    public function createProduct(Product $product);
    public function updateProduct(Product $product);
    public function deleteProductByCode(string $productCode);

}