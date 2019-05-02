<?php

namespace Prettus\Moip\Subscription\Webservice;
use Psr\Http\Message\ResponseInterface;

/**
 * Trait ResourceUtils
 * @package Prettus\Moip\Subscription\Webservice
 */
trait ResourceUtils
{
    /**
     * Convert json to objects.
     *
     * @param ResponseInterface $response
     * @return mixed
     */
    public static function formatInJson(ResponseInterface $response)
    {
       $webservice = new Webservice( $response->getBody()->getContents() );
       $renderTo = new FormatInJson( $webservice );

       return $renderTo->format();
    }
}