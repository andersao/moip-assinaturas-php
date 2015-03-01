<?php namespace Prettus\Moip\Subscription\Contracts;
use GuzzleHttp\Client;
use GuzzleHttp\Message\ResponseInterface;

/**
 * Interface MoipHttpClient
 * @package Prettus\Moip\Subscription\Contracts
 */
interface MoipHttpClient {

    /**
     * @return string
     */
    public function getApiVersion();

    /**
     * @return Client
     */
    public function getClient();

    /**
     * @param null $url
     * @param array $options
     * @return ResponseInterface
     */
    public function get($url = null, $options = []);

    /**
     * @param null $url
     * @param array $options
     * @return ResponseInterface
     */
    public function post($url = null, $options = []);

    /**
     * @param null $url
     * @param array $options
     * @return ResponseInterface
     */
    public function put($url = null, $options = []);

    /**
     * @param null $url
     * @param array $options
     * @return ResponseInterface
     */
    public function delete($url = null, $options = []);

}