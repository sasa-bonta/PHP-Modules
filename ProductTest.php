<?php

require_once('Product.php');
require_once('ProductRepositoryFS.php');
$pr = new ProductRepositoryFS();


$p1 = new Product("test11", "133", 45.85, "tool");

# Create product OK
//$ptest = $pr->createProduct($p1);
//if (!$ptest) echo "False\n";
//else echo "True\n";

# Get Product by id OK
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
//$pr = new ProductRepositoryFS();
//$pr->getProductByCode($p1->getCode());
//$pr->searchProduct();
//$pr->createProduct($p1);
//$pr->updateProduct($p1);
//$pr->deleteProductByCode($p1->getCode());