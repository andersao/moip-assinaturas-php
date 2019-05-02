<?php

namespace Prettus\Moip\Subscription\Webservice;

use Prettus\Moip\Subscription\Contracts\Renderable;

/**
 * Class Formatter
 * @package Prettus\Moip\Subscription\Webservice
 */
abstract class Formatter implements Renderable
{
    /** @var  Renderable */
    protected $renderer;

    /**
     * ToRender constructor.
     * @param Renderable $renderer
     */
    public function __construct(Renderable $renderer)
    {
        $this->renderer = $renderer;
    }
}