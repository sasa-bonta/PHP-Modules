<?php

namespace Module\ProductModule\Domain;

use Module\ProductModule\Domain\Exceptions\SearchCriteriaInvalidLimitException;
use Module\ProductModule\Domain\Exceptions\SearchCriteriaInvalidPageException;

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
    public function __construct($page = 1, $limit = 10, $name = '', $category = '')
    {
        $this->setPage($page);
        $this->setLimit($limit);
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
    public function setPage($page = 1)
    {
        if (is_int($page) && $page > 0) $this->page = $page;
        else throw new SearchCriteriaInvalidPageException("\n---Page must be positive int\n");
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
    public function setLimit($limit = 10)
    {
        if (is_int($limit) && $limit > 0) $this->limit = $limit;
        else throw new SearchCriteriaInvalidLimitException("\n---Limit must be positive int\n");
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