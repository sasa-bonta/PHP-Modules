<?php


namespace Module\ProductModule;


use Exception;
use Throwable;

class SearchCriteriaInvalidPageException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}