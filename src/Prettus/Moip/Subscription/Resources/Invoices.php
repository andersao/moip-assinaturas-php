<?php namespace Prettus\Moip\Subscription\Resources;

use GuzzleHttp\Exception\ClientException;
use Prettus\Moip\Subscription\Contracts\MoipHttpClient;
use Prettus\Moip\Subscription\ResourceUtils;

/**
 * Class Invoices
 * @package Prettus\Moip\Subscription\Resources
 */
class Invoices {

    use ResourceUtils;

    const BASE_PATH = "assinaturas/{version}/{resource}";
    const RESOURCE  = "invoices";

    /**
     * @var MoipHttpClient
     */
    protected $client;

    public function __construct(MoipHttpClient $client){
        $this->client = $client;
    }

    /**
     * Consultar detalhes de uma fatura
     *
     * @param $code
     * @param array $options
     * @throws ClientException
     * @return mixed
     */
    public function find($code, array $options = []){

        $url = $this->interpolate( self::BASE_PATH."/{code}", [
            'version'   => $this->client->getApiVersion(),
            'resource'  => self::RESOURCE,
            'code'      => $code
        ]);

        return $this->client->get($url, $options);
    }

    /**
     * Listar todos os pagamentos de uma fatura
     *
     * @param $code
     * @param array $options
     * @throws ClientException
     * @return mixed
     */
    public function payments($code, array $options = []){

        $url = $this->interpolate( self::BASE_PATH."/{code}/payments", [
            'version'   => $this->client->getApiVersion(),
            'resource'  => self::RESOURCE,
            'code'      => $code
        ]);

        return $this->client->get($url, $options);
    }

    /**
     * Retentar um pagamento
     *
     * @param $code
     * @param array $options
     * @throws ClientException
     * @return mixed
     */
    public function retryPayment($code, array $options = []){

        $url = $this->interpolate( self::BASE_PATH."/{code}/payments", [
            'version'   => $this->client->getApiVersion(),
            'resource'  => self::RESOURCE,
            'code'      => $code
        ]);

        return $this->client->get($url, $options);
    }
}