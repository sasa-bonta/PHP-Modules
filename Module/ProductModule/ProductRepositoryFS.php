<?php

namespace Module\ProductModule;

class ProductRepositoryFS implements ProductCatalogServiceInterface
{

    ### Implemented functions

    public function getProductByCode(string $productCode)
    {  # Add ProductNotFoundException
        $contents = $this->readProductsArray();
        $i = array_search($productCode, array_column($contents, 'code'));

        if ($i !== FALSE) {
            return $contents[$i];
        } else {
            return NULL;    ### Add exception
        }
    }

    # What the Product Collection ???
    public function searchProduct(SearchCriteria $sc)  // Here would be a good idea to use Decorator Pattern
    {        # Add SearchCriteriaInvalidPageException and  SearchCriteriaInvalidLimitException
        $contents = $this->readProductsArray();
        $arrContain = [];

        # Return all if none is set
        if (empty($sc->getName()) && empty($sc->getCategory())) {
            $arrContain = $contents;
        }

        # Search if only name is set
        if (!empty($sc->getName()) && empty($sc->getCategory())) {
            foreach ($contents as $pr1) {
                if ($this->searchByColumn($pr1, 'name', $sc->getName())) {
                    array_push($arrContain, $pr1);
                }
            }
        }

        # Search if only category is set
        if (empty($sc->getName()) && !empty($sc->getCategory())) {
            foreach ($contents as $pr1) {
                if ($this->searchByColumn($pr1, 'category', $sc->getCategory())) {
                    array_push($arrContain, $pr1);
                }
            }
        }

        # Search if both name and category are set
        if (!empty($sc->getName()) && !empty($sc->getCategory())) {
            foreach ($contents as $pr1) {
                if ($this->searchNameCategory($pr1, 'name', $sc->getName(), 'category', $sc->getCategory())) {
                    array_push($arrContain, $pr1);
                }
            }
        }

        return $arrContain;
    }

    public function createProduct(Product $product)
    { # Add ProductCodeDuplicateException

        if (!($this->isCodePresent($product->getCode()))) {
            $this->addNewProduct($product);
            return TRUE;
        } else {
            return FALSE;  ### Add exception
        }
    }

    public function updateProduct(Product $product)
    {
        echo "+ update Product \n";
        print_r($product);
        echo "\n";
    }

    public function deleteProductByCode(string $productCode)
    {
        if ($this->isCodePresent($productCode)) {
            $this->deleteProduct($productCode);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    ### Class functions

    public function addNewProduct(Product $product)
    {
        $product = json_encode($product);
        $fp = fopen('productsFS.file', 'a+');
        $stat = fstat($fp);
        ftruncate($fp, $stat['size'] - 1);
        fwrite($fp, ",");
        fwrite($fp, $product . "]");
        fclose($fp);
        #echo "+ new Product : " .$product ."\n";
    }

    public function isCodePresent(string $code)
    {
        $contents = $this->readProductsArray();
        $contents = array_column($contents, 'code');
        if (in_array($code, $contents, FALSE)) {
            #echo "not added \n";
            return TRUE;        ### Add exception
        } else {
            #echo "added \n";
            return FALSE;
        }
    }

    public function deleteProduct(string $code)
    {
        $contents = $this->readProductsArray();
        $i = array_search($code, array_column($contents, 'code'));
        unset($contents[$i]);
        $contents = json_encode($contents);
        $fp = fopen("productsFS.file", "w");
        fwrite($fp, $contents);
        fclose($fp);
    }

    public function readProductsArray()
    {
        $fp = fopen("productsFS.file", "rb");
        $contents = stream_get_contents($fp);
        fclose($fp);
        return json_decode($contents, TRUE);
    }

    public function searchByColumn($pr1, string $column, string $name)
    {
        if (strpos($pr1[$column], $name) !== FALSE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function searchNameCategory($pr1, string $col1,  string $name, string $col2, string $category)
    {
        if ($this->searchByColumn($pr1, $col1,  $name) && $this->searchByColumn($pr1, $col2,  $category)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
