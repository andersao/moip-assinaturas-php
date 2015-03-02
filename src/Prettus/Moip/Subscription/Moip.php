<?php namespace Prettus\Moip\Subscription;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Prettus\Moip\Subscription\Contracts\MoipHttpClient;

/**
 * Class Moip
 * @package Prettus\Moip\Subscription
 */
class Moip implements MoipHttpClient {

    const PRODUCTION = "api";
    const SANDBOX    = "sandbox";

    /**
     * @var Client
     */
    protected $client;

    /**
     * Api Token
     *
     * @var string
     */
    protected $apiToken;

    /**
     * Api Key
     * @var string
     */
    protected $apiKey;

    /**
     * Ambiente da API
     *
     * @var string
     */
    protected $environment = self::SANDBOX;

    /**
     * Versão da API
     *
     * @var string
     */
    protected $apiVersion  = "v1";

    /**
     * Url da API
     * @var string
     */
    protected $apiUrl   = "https://{environment}.moip.com.br";

    /**
     * Moip
     *
     * @param $apiToken
     * @param $apiKey
     * @param string $environment
     */
    public function __construct( $apiToken, $apiKey, $environment = self::SANDBOX ){

        $this->setCredential(['token'=>$apiToken,'key'=>$apiKey]);
        $this->setEnvironment($environment);

        $this->client       = new Client([
            'base_url' => [$this->apiUrl, ['environment' => $this->environment]],
            'defaults' => [
                'headers' => [
                    'Accept'        => 'application/json',
                    'Content-Type'  => 'application/json',
                    'Authorization' => 'Basic '.base64_encode("{$this->apiToken}:{$this->apiKey}")
                ]
            ]
        ]);
    }

    /**
     * Define as credenciais de acesso a API
     *
     * @param array $credentials
     * @return $this
     */
    public function setCredential($credentials = []){
        $this->apiKey   = $credentials['key'];
        $this->apiToken = $credentials['token'];
        return $this;
    }

    /**
     * Define o ambiente a ser utilizado
     *
     * @param $environment
     * @return $this
     */
    public function setEnvironment($environment){
        $this->environment = $environment;
        return $this;
    }

    /**
     * Retorna uma intância do Client Http
     *
     * @return Client
     */
    public function getClient(){
        return $this->client;
    }

    /**
     * Retorna a versão da API
     *
     * @return string
     */
    public function getApiVersion(){
        return $this->apiVersion;
    }

    /**
     * Executa uma requisição do tipo GET
     *
     * @param null $url
     * @param array $options
     * @throws ClientException
     * @return mixed
     */
    public function get($url = null, $options = [])
    {
        return $this->client->get($url, $options);
    }

    /**
     * Executa uma requisição do tipo POST
     *
     * @param null $url
     * @param array $options
     * @throws ClientException
     * @return mixed
     */
    public function post($url = null, $options = [])
    {
        return $this->client->post($url, $options);
    }

    /**
     * Executa uma requisição do tipo PUT
     *
     * @param null $url
     * @param array $options
     * @throws ClientException
     * @return mixed
     */
    public function put($url = null, $options = [])
    {
        return $this->client->put($url, $options);
    }

    /**
     * Executa uma requisição do tipo DELETE
     *
     * @param null $url
     * @param array $options
     * @throws ClientException
     * @return mixed
     */
    public function delete($url = null, $options = [])
    {
        return $this->client->delete($url, $options);
    }
}