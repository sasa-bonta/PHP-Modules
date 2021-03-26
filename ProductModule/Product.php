<?php


class Product implements JsonSerializable{
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
    public function __construct($name, $code, $price, $category)
    {
        $this->name = $name;
        $this->code = $code;
        $this->price = $price;
        $this->category = $category;
    }


    public function jsonSerialize() {
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

}