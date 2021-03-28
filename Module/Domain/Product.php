<?php

namespace Module\ProductModule\Domain;

use JsonSerializable;

class Product implements JsonSerializable {
    private string $name;
    private string $code;
    private float $price;
    private string $category;

    /**
     * Product constructor.
     * @param string $name
     * @param string $code
     * @param float $price
     * @param string $category
     */
    public function __construct(string $name, string $code, float $price, string $category)
    {
        $this->name = $name;
        $this->code = $code;
        $this->price = $price;
        $this->category = $category;
    }


    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'code' => $this->code,
            'price' => $this->price,
            'category' => $this->category
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code)
    {
        $this->code = $code;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    public function fromArray(array $prod): Product
    {
        return new Product((string)$prod['name'], (string)$prod['code'], (float)$prod['price'], (string)$prod['category']);
    }
}