<?php namespace Prettus\Moip\Subscription\Resources;

use GuzzleHttp\Exception\ClientException;
use Prettus\Moip\Subscription\Contracts\MoipHttpClient;
use Prettus\Moip\Subscription\ResourceUtils;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Preferences
 * @package Prettus\Moip\Subscription\Resources
 */
class Preferences {

    use ResourceUtils;

    const BASE_PATH = "assinaturas/{version}/{resource}";
    const RESOURCE  = "users/preferences";

    /**
     * @var MoipHttpClient
     */
    protected $client;

    public function __construct(MoipHttpClient $client){
        $this->client = $client;
    }

    /**
     * Configurar preferências de notificação
     *
     * @param array $data
     * @param array $options
     * @throws ClientException
     * @return ResponseInterface
     */
    public function setPreferences(array $data, array $options = []){

        $url = $this->interpolate( self::BASE_PATH, [
            'version'   => $this->client->getApiVersion(),
            'resource'  => self::RESOURCE
        ]);

        $options = array_merge($options,['body'=>json_encode($data)]);

        return $this->client->post($url, $options);
    }


    /**
     * Criar regras de retentativas automáticas
     *
     * @param array $data
     * @param array $options
     * @throws ClientException
     * @return ResponseInterface
     */
    public function setPreferencesRetry(array $data, array $options = []){

        $url = $this->interpolate( self::BASE_PATH, [
            'version'   => $this->client->getApiVersion(),
            'resource'  => self::RESOURCE
        ]);

        $options = array_merge($options,['body'=>json_encode($data)]);

        return $this->client->post($url, $options);
    }
}