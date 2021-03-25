<?php


require_once('Product.php');
require_once('ProductCatalogServiceInterface.php');

class ProductRepositoryFS implements ProductCatalogServiceInterface {

    ### Implemented functions

    public function getProductByCode(string $productCode) {  # Add ProductNotFoundException
        $fp = fopen("productsFS.file", "rb");
        $contents = stream_get_contents($fp);
        fclose($fp);
        $contents = json_decode($contents);

        $i = array_search($productCode, array_column($contents, 'code'));

        if ($i !== FALSE) {
            return $contents[$i];
        } else {
            return NULL;	### Add exception
        }
    }
    public function searchProduct() {		# Add SearchCriteriaInvalidPageException and  SearchCriteriaInvalidLimitException
        echo "+ search Product \n";
    }

    public function createProduct(Product $product) { # Add ProductCodeDuplicateException

        if (!($this->isCodePresent($product->getCode()))) {
            $this->addNewProduct($product);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function updateProduct(Product $product) {
        echo "+ update Product \n";
        print_r($product);
        echo "\n";
    }

    public function deleteProductByCode(string $productCode) {
        if ($this->isCodePresent($productCode)) {
            $this->deleteProduct($productCode);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    ### Class functions

    public function addNewProduct(Product $product) {
        $product = json_encode($product);
        $fp = fopen('productsFS.file', 'a+');
        $stat = fstat($fp);
        ftruncate($fp, $stat['size']-1);
        fwrite($fp, ",");
        fwrite($fp, $product ."]");
        fclose($fp);
        #echo "+ new Product : " .$product ."\n";
    }

    public function isCodePresent(string $code) {
        $fp = fopen("productsFS.file", "rb");
        $contents = stream_get_contents($fp);
        fclose($fp);
        $contents = json_decode($contents);
        $contents = array_column($contents, 'code');
        if (in_array($code, $contents, FALSE)) {
            #echo "not added \n";
            return TRUE;		### Add exception
        } else {
            #echo "added \n";
            return FALSE;
        }
    }

    public function deleteProduct(string $code) {
        $fp = fopen("productsFS.file", "rb");
        $contents = stream_get_contents($fp);
        fclose($fp);
        $contents = json_decode($contents);

        $i = array_search($code, array_column($contents, 'code'));
        unset($contents[$i]);
        $contents = json_encode($contents);
        $fp = fopen("productsFS.file", "w");
        fwrite($fp, $contents);
		fclose($fp);
	 }
}