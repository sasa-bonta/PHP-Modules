<?php

use Module\ProductModule\Domain\Product;
use Module\ProductModule\Domain\SearchCriteria;
use Module\ProductModule\Infrastructure\ProductRepositoryFS;

require_once '../../vendor/autoload.php';

$pr = new ProductRepositoryFS();
$p1 = new Product("latest test3 updated 123", "135", 178.25, "staff");
$sc = new SearchCriteria();

# Search Product OK collection => array object ? ~ OK private attributes displayed
//$sc->setName('UPDATED');
//$sc->setCategory('');
//$sc->setPage();
//$sc->setLimit();
//$searchProd = $pr->searchProduct($sc);
//print_r($searchProd->getProductsToDisplay());


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