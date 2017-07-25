<?php

namespace Prettus\Moip\Subscription\Contracts;

/**
 * Interface Renderable
 * @package Prettus\Moip\Subscription\Contracts
 */
interface Renderable
{
    /**
     * Collection to be formatted
     *
     * @return mixed
     */
    public function format();
}