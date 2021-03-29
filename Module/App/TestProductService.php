<?php
// composer dump-autoload -o

use Module\ProductModule\App\ProductService;
use Module\ProductModule\Domain\Product;
use Module\ProductModule\Domain\SearchCriteria;

require_once '../../vendor/autoload.php';

$ps = new ProductService();
$p1 = new Product("latest test3 updated again 123", "135", 178.25, "staff");
$sc = new SearchCriteria();

# Search Product OK collection => array object ? ~ OK private attributes displayed
//$sc->setName('test1')
//   ->setCategory('')
//   ->setPage()
//    ->setLimit();
//$searchProd = $ps->searchProduct($sc);
//print_r($searchProd->getProductsToDisplay());


# Create Product OK
//$ptest = $ps->createProduct($p1);
//if (!$ptest) echo "False\n";
//else echo "True\n";


# Get Product by code OK
//$p1 = $ps->getProductByCode($p1->getCode());
//print_r($p1);


# Delete Product
//$ptest = $ps->deleteProductByCode($p1->getCode());
//if (!$ptest) echo "False\n";
//else echo "True\n";


# Update Product OK
//$ptest = $ps->updateProduct($p1);
//if (!$ptest) echo "False\n";
//else echo "True\n";


# ============================================== #
# Test Getters OK
//echo $p1->getName() ."\n";
//echo $p1->getCode() ."\n";
//echo $p1->getPrice() ."\n";
//echo $p1->getCategory() ."\n";