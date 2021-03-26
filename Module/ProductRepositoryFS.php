<?php

namespace Module\ProductModule;

class ProductRepositoryFS implements ProductCatalogServiceInterface
{
    private array $contents = [];

    /**
     * ProductRepositoryFS constructor.     *
     */
    public function __construct()
    {
        $this->contents = $this->updateProductsArray();
    }


    ### Implemented public functions


    public function getProductByCode(string $productCode): Product
    {  # Add ProductNotFoundException
        $contents = $this->contents;
        $i = array_search($productCode, array_column($contents, 'code'));

        if ($i !== FALSE) {
            $prod = $contents[$i];
            return new Product($prod['name'], $prod['code'], $prod['price'], $prod['category']);
        } else {
            return NULL;    # @todo exception
        }
    }

    # What the Product Collection ???
    public function searchProduct(SearchCriteria $sc): ProductCollection  // Here would be a good idea to use Decorator Pattern
    {        # Add SearchCriteriaInvalidPageException and  SearchCriteriaInvalidLimitException
        $contents = $this->contents;
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

        $start = ($sc->getPage() - 1) * $sc->getLimit();
        $arrContain = array_slice($arrContain, $start, $sc->getLimit());

        return new ProductCollection($arrContain);
    }

    public function createProduct(Product $product) : bool
    { # Add ProductCodeDuplicateException

        if (!($this->isCodePresent($product->getCode()))) {
            $this->addNewProduct($product);
            return TRUE;
        } else {
            return FALSE;  # @todo exception
        }
    }

    public function updateProduct(Product $product):bool
    {
        # @todo implementation
        if ($this->isCodePresent($product->getCode())) {
            $this->deleteProduct($product->getCode());
            $this->addNewProduct($product);
            $this->contents = $this->updateProductsArray();
            return TRUE;
        } else {
            return false; # @todo exception
        }
    }

    public function deleteProductByCode(string $productCode): bool
    {
        if ($this->isCodePresent($productCode)) {
            $this->deleteProduct($productCode);
            return TRUE;
        } else {
            return FALSE;
        }
    }


    ### Class private functions


    private function addNewProduct(Product $product)
    {
        $product = json_encode($product);
        $fp = fopen('productsFS.file', 'a+');
        $stat = fstat($fp);
        ftruncate($fp, $stat['size'] - 1);
        fwrite($fp, ",");
        fwrite($fp, $product . "]");
        fclose($fp);
        $this->contents = $this->updateProductsArray();
        #echo "+ new Product : " .$product ."\n";
    }

    private function isCodePresent(string $code): bool
    {
        $contents = $this->contents;
        $contents = array_column($contents, 'code');
        if (in_array($code, $contents, FALSE)) {
            #echo "not added \n";
            return TRUE;        ### Add exception
        } else {
            #echo "added \n";
            return FALSE;
        }
    }

    private function deleteProduct(string $code)
    {
        $contents = $this->contents;
        $i = array_search($code, array_column($contents, 'code'));
        unset($contents[$i]);
        $contents = json_encode($contents);
        $fp = fopen("productsFS.file", "w");
        fwrite($fp, $contents);
        fclose($fp);
        $this->contents = $this->updateProductsArray();
    }

    private function updateProductsArray()
    {
        $fp = fopen("productsFS.file", "rb");
        $contents = stream_get_contents($fp);
        fclose($fp);
        return json_decode($contents, TRUE);
    }

    private function searchByColumn($pr1, string $column, string $name): bool
    {
        if (strpos($pr1[$column], $name) !== FALSE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function searchNameCategory($pr1, string $col1,  string $name, string $col2, string $category): bool
    {
        if ($this->searchByColumn($pr1, $col1,  $name) && $this->searchByColumn($pr1, $col2,  $category)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
