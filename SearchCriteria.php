<?php


class SearchCriteria
{
    private int $page;
    private int $limit;
    private string $name;
    private string $category;

    /**
     * SearchCriteria constructor.
     * @param int $page
     * @param int $limit
     * @param string $name
     * @param string $category
     */
    public function __construct($page, $limit, $name, $category)
    {
        $this->page = $page;
        $this->limit = $limit;
        $this->name = $name;
        $this->category = $category;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
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