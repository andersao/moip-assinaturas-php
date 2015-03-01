<?php namespace Prettus\Moip\Subscription;

/**
 * Class ResourceUtils
 * @package Prettus\Moip\Subscription
 */
trait ResourceUtils {

    /**
     * @param $url
     * @param array $data
     * @return mixed
     */
    protected function urlInterpolate($url, array $data = []){

        foreach($data as $key=>$value){
            $url = str_replace('{'.$key.'}', $value, $url);
        }

        return $url;
    }
}