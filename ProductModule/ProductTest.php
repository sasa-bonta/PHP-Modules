<?php

require_once('Product.php');
require_once('ProductRepositoryFS.php');
require_once('SearchCriteria.php');

$pr = new ProductRepositoryFS();
$sc = new SearchCriteria();
$p1 = new Product("test12", "134", 45.85, "tool");

# Search Product ~ OK should add collection
//$sc->setName('test1');
//$sc->setCategory('toy');
//$searchProd = $pr->searchProduct($sc);
//print_r($searchProd);


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