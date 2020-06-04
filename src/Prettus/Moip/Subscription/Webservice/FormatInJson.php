<?php

namespace Prettus\Moip\Subscription\Webservice;

/**
 * Class FormatInJson
 * @package Prettus\Moip\Subscription\Webservice
 */
class FormatInJson extends Formatter
{
    /**
     * Format json and return collection of data.
     *
     * @return mixed
     */
    public function format()
    {
        return json_decode($this->renderer->format(), false, JSON_FORCE_OBJECT);
    }
}