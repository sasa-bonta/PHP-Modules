<?php
require_once('Product.php');

interface ProductCatalogServiceInterface {

    # CRUD
    public function getProductByCode(string $productCode): Product $product;
    public function searchProduct(SearchCriteria $sc);		# add search criteria
    public function createProduct(Product $product);
    public function updateProduct(Product $product);
    public function deleteProductByCode(string $productCode);

}