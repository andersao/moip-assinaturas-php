<?php namespace Prettus\Moip\Subscription\Resources;

use Prettus\Moip\Subscription\Contracts\MoipHttpClient;
use Prettus\Moip\Subscription\ResourceUtils;

/**
 * Class Plans
 * @package Prettus\Moip\Subscription\Resources
 */
class Plans {

    use ResourceUtils;

    const BASE_PATH = "assinaturas/{version}/{resource}";
    const RESOURCE  = "plans";

    /**
     * @var MoipHttpClient
     */
    protected $client;

    public function __construct(MoipHttpClient $client){
        $this->client = $client;
    }

    /**
     * Criar um plano
     *
     * @param array $data
     * @param array $options
     * @return \GuzzleHttp\Message\ResponseInterface
     */
    public function create(array $data, array $options = []){

        $url = $this->urlInterpolate( self::BASE_PATH, [
            'version'   => $this->client->getApiVersion(),
            'resource'  => self::RESOURCE
        ]);

        $options = array_merge($options,['body'=>json_encode($data)]);

        return $this->client->post($url, $options);
    }

    /**
     * Listar todos os planos
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
     * Consultar detalhes de um plano
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
     * Alterar um plano
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
     * Ativar um plano
     *
     * @param $code
     * @param array $options
     * @return \GuzzleHttp\Message\ResponseInterface
     */
    public function active($code, array $options = []){
        return $this->toogleActive($code, "activate", $options);
    }

    /**
     * Desativar um plano
     *
     * @param $code
     * @param array $options
     * @return \GuzzleHttp\Message\ResponseInterface
     */
    public function deactivate($code, array $options = []){
        return $this->toogleActive($code, "inactivate", $options);
    }

    /**
     * Ativar ou desativar um plano
     *
     * @param $code
     * @param $status [activate, inactivate]
     * @param array $options
     * @return \GuzzleHttp\Message\ResponseInterface
     */
    protected function toogleActive($code, $status, array $options = []){

        $url = $this->urlInterpolate( self::BASE_PATH."/{code}/{status}", [
            'version'   => $this->client->getApiVersion(),
            'resource'  => self::RESOURCE,
            'code'      => $code,
            'status'    => $status
        ]);

        return $this->client->put($url, $options);
    }
}