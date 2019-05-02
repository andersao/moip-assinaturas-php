<?php

namespace Prettus\Moip\Subscription\Webservice;

use Prettus\Moip\Subscription\Contracts\Renderable;

/**
 * Class Webservice
 * @package Prettus\Moip\Subscription\Webservice
 */
class Webservice implements Renderable
{
    /** @var */
    protected $data;

    /**
     * Webservice constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Collection to be formatted
     *
     * @return mixed
     */
    public function format()
    {
        return $this->data;
    }
}