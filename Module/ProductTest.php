<?php

use Module\ProductModule\Product;
use Module\ProductModule\ProductRepositoryFS;
use Module\ProductModule\SearchCriteria;

require_once '../vendor/autoload.php';

$pr = new ProductRepositoryFS();
$p1 = new Product("test14", "136", 85.14, "book");
$sc = new SearchCriteria();

# Search Product ~ OK should add collection
$sc->setName('');
$sc->setCategory('');
$sc->setPage(2);
$searchProd = $pr->searchProduct($sc);
print_r($searchProd->getProductsToDisplay());


# Create Product OK
//$ptest = $pr->createProduct($p1);
//if (!$ptest) echo "False\n";
//else echo "True\n";


# Get Product by code OK
//$p1 = $pr->getProductByCode($p1->getCode());
//print_r($p1);


# Delete Product OK
//$ptest = $pr->deleteProductByCode($p1->getCode());
//if (!$ptest) echo "False\n";
//else echo "True\n";


# Update Product OK
//$ptest = $pr->updateProduct($p1);
//if (!$ptest) echo "False\n";
//else echo "True\n";


# ============================================== #
# Test Getters OK
//echo $p1->getName() ."\n";
//echo $p1->getCode() ."\n";
//echo $p1->getPrice() ."\n";
//echo $p1->getCategory() ."\n";

# Test implemented methods OK
//$pr->getProductByCode($p1->getCode());
//$pr->searchProduct($sc);
//$pr->createProduct($p1);
//$pr->updateProduct($p1);
//$pr->deleteProductByCode($p1->getCode());