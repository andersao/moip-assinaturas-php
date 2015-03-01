<?php namespace Prettus\Moip\Subscription\Resources;

use Prettus\Moip\Subscription\Contracts\MoipHttpClient;
use Prettus\Moip\Subscription\ResourceUtils;

/**
 * Class Customers
 * @package Prettus\Moip\Subscription\Resources
 */
class Customers {

    use ResourceUtils;

    const BASE_PATH = "assinaturas/{version}/{resource}";
    const RESOURCE  = "customers";

    /**
     * @var MoipHttpClient
     */
    protected $client;

    /**
     * @param MoipHttpClient $client
     */
    public function __construct(MoipHttpClient $client){
        $this->client = $client;
    }

    /**
     * Criar um cliente
     *
     * @param array $data
     * @param bool $new_vault
     * @param array $options
     * @return \GuzzleHttp\Message\ResponseInterface
     */
    public function create(array $data, $new_vault = false, array $options = []){

        $url = $this->urlInterpolate( self::BASE_PATH."?new_vault={new_vault}", [
            'version'   => $this->client->getApiVersion(),
            'resource'  => self::RESOURCE,
            'new_vault' => $new_vault === true ? 'true' : 'false'
        ]);

        $options = array_merge($options,['body'=>json_encode($data)]);

        return $this->client->post($url, $options);
    }

    /**
     * Listar todos os clientes
     *
     * @param array $options
     * @return \GuzzleHttp\Message\ResponseInterface
     */
    public function all(array $options = []){

        $url = $this->urlInterpolate( self::BASE_PATH, [
            'version'   => $this->client->getApiVersion(),
            'resource'  => self::RESOURCE,
        ]);

        return $this->client->get($url, $options);
    }

    /**
     * Consultar detalhes de um cliente
     *
     * @param $code
     * @param array $options
     * @return \GuzzleHttp\Message\ResponseInterface
     */
    public function find($code, array $options = []){

        $url = $this->urlInterpolate( self::BASE_PATH."/{code}", [
            'version'   => $this->client->getApiVersion(),
            'resource'  => self::RESOURCE,
            'code'      => $code
        ]);

        return $this->client->get($url, $options);
    }

    /**
     * Alterar um cliente
     *
     * @param $code
     * @param array $data
     * @param array $options
     * @return \GuzzleHttp\Message\ResponseInterface
     */
    public function update($code, array $data, array $options = []){

        $url = $this->urlInterpolate( self::BASE_PATH."/{code}", [
            'version'   => $this->client->getApiVersion(),
            'resource'  => self::RESOURCE,
            'code'      => $code
        ]);

        $options = array_merge($options,['body'=>json_encode($data)]);

        return $this->client->put($url, $options);

    }

    /**
     * @param $code
     * @param array $data
     * @param array $options
     * @return \GuzzleHttp\Message\ResponseInterface
     */
    public function updateBillingInfo($code, array $data, array $options = []){

        $url = $this->urlInterpolate( self::BASE_PATH."/{code}/billing_infos", [
            'version'   => $this->client->getApiVersion(),
            'resource'  => self::RESOURCE,
            'code'      => $code
        ]);

        $options = array_merge($options,['body'=>json_encode($data)]);

        return $this->client->put($url, $options);
    }
}