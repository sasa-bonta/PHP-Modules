<?php

namespace Module\ProductModule;

interface ProductCatalogServiceInterface {

    # CRUD
    public function getProductByCode(string $productCode): Product;    # @todo ProductNotFoundException
    public function searchProduct(SearchCriteria $sc);		# @todo add search criteria && SearchCriteriaInvalidPageException and  SearchCriteriaInvalidLimitException
    public function createProduct(Product $product): bool;  # @todo ProductCodeDuplicateException
    public function updateProduct(Product $product): bool;
    public function deleteProductByCode(string $productCode): bool;  # @todo SearchCriteriaInvalidPageException and  SearchCriteriaInvalidLimitException

}