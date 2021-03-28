<?php

namespace Module\ProductModule\Infrastructure;

use Module\ProductModule\Domain\Exceptions\ProductCodeDuplicateException;
use Module\ProductModule\Domain\Exceptions\ProductNotFoundException;
use Module\ProductModule\Domain\Product;
use Module\ProductModule\Domain\ProductCollection;
use Module\ProductModule\Domain\SearchCriteria;
use function array_splice;

class ProductRepositoryFS implements ProductCatalogRepositoryInterface
{
    private array $contents = [];

    ### Constructor && Destructor
    /**
     * ProductRepositoryFS constructor.     *
     */
    public function __construct()
    {
        $this->load();
    }

    public function __destruct()
    {
        $this->save();
    }

    ### Implemented public functions


    public function getProductByCode(string $productCode): Product
    {
        $contents = $this->contents;
        $i = array_search($productCode, array_column($contents, 'code'));

        if ($i !== FALSE) {
            $prod = $contents[$i];
            return new Product($prod['name'], $prod['code'], $prod['price'], $prod['category']);
        } else throw new ProductNotFoundException("\n---Product Not Found! Repo\n");
    }

    public function searchProduct(SearchCriteria $sc): ProductCollection
    {
        $contents = $this->contents;

        # Search if name is set
        if (!empty($sc->getName())) {
            echo "1\n";
            $contents = array_filter($contents, fn ($product) => $this->searchByColumn($product, 'name', $sc->getName()));
        }

        # Search if category is set
        if (!empty($sc->getCategory())) {
            $contents = array_filter($contents, fn ($product) => $this->searchByColumn($product, 'category', $sc->getCategory()));
        }

        $offset = ($sc->getPage() - 1) * $sc->getLimit();
        $contents = array_slice($contents, $offset, $sc->getLimit());

        $contents = array_map([Product::class, 'fromArray'], $contents);

        return new ProductCollection(...$contents);
    }

    public function createProduct(Product $product) : bool
    {
        if (!($this->isCodePresent($product->getCode()))) {
            $this->addNewProduct($product);
            return TRUE;
        } else throw new ProductCodeDuplicateException("\n---Duplicated code! Repo\n");
    }

    public function updateProduct(Product $product):bool
    {
        if ($this->isCodePresent($product->getCode())) {
            $this->deleteProduct($product->getCode());
            $this->addNewProduct($product);
            return TRUE;
        } else return false;
    }

    public function deleteProductByCode(string $productCode): bool
    {
        if ($this->isCodePresent($productCode)) {
            $this->deleteProduct($productCode);
            return TRUE;
        } else return FALSE;
    }

    ### Class private functions


    private function addNewProduct(Product $product)
    {
        $this->contents[] = $product;
    }

    private function isCodePresent(string $code): bool
    {
        $contents = $this->contents;
        $codes = array_column($contents, 'code');
        if (in_array($code, $codes, FALSE)) return TRUE;
        else return FALSE;
    }

    private function deleteProduct(string $code)
    {
        $i = array_search($code, array_column($this->contents, 'code'));
        array_splice($this->contents, $i);
    }

    private function load()
    {
        $fp = fopen("/home/abonta/PhpstormProjects/PHP-Modules/Module/Infrastructure/productsFS.file", "rb");
        $contents = stream_get_contents($fp);
        fclose($fp);
        $this->contents = json_decode($contents, TRUE);
    }

    private function save()
    {
        $fp = fopen("/home/abonta/PhpstormProjects/PHP-Modules/Module/Infrastructure/productsFS.file", "w");
        fwrite($fp, json_encode($this->contents));
        fclose($fp);
    }

    private function searchByColumn($pr1, string $column, string $name): bool
    {
        if (strpos($pr1[$column], $name) !== FALSE) return TRUE;
        else return FALSE;
    }
}