<?php namespace Prettus\Moip\Subscription\Contracts;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Message\ResponseInterface;

/**
 * Interface MoipHttpClient
 * @package Prettus\Moip\Subscription\Contracts
 */
interface MoipHttpClient {

    /**
     * Retorna a versão da API
     *
     * @return string
     */
    public function getApiVersion();

    /**
     * Retorna uma intância do Client Http
     *
     * @return Client
     */
    public function getClient();

    /**
     * Executa uma requisição do tipo GET
     *
     * @param null $url
     * @param array $options
     * @throws ClientException
     * @return mixed
     */
    public function get($url = null, $options = []);

    /**
     * Executa uma requisição do tipo POST
     *
     * @param null $url
     * @param array $options
     * @throws ClientException
     * @return mixed
     */
    public function post($url = null, $options = []);

    /**
     * Executa uma requisição do tipo PUT
     *
     * @param null $url
     * @param array $options
     * @throws ClientException
     * @return mixed
     */
    public function put($url = null, $options = []);

    /**
     * Executa uma requisição do tipo DELETE
     *
     * @param null $url
     * @param array $options
     * @throws ClientException
     * @return mixed
     */
    public function delete($url = null, $options = []);

}