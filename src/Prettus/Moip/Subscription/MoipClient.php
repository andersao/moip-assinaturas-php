<?php namespace Prettus\Moip\Subscription;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Message\ResponseInterface;
use Prettus\Moip\Subscription\Contracts\MoipHttpClient;

/**
 * Class MoipClient
 * @package Prettus\Moip\Subscription
 */
class MoipClient implements MoipHttpClient {

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
    protected $environment = MoipHttpClient::SANDBOX;

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
    public function __construct( $apiToken, $apiKey, $environment = MoipHttpClient::PRODUCTION ){

        $this->setCredential(['token'=>$apiToken,'key'=>$apiKey]);
        $this->setEnvironment($environment);
        $base_uri = str_replace('{environment}',$this->environment, $this->apiUrl);
        $this->client       = new Client([
            'base_uri' => $base_uri,
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
        $response = $this->client->get($url, $options);
        return $this->parserResponseToArray($response);
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
        $response = $this->client->post($url, $options);
        return $this->parserResponseToArray($response);
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
        $response = $this->client->put($url, $options);
        return $this->parserResponseToArray($response);
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
        $response = $this->client->delete($url, $options);
        return $this->parserResponseToArray($response);
    }

    /**
     *
     * @param ResponseInterface $response
     * @return array
     */
    protected function parserResponseToArray(ResponseInterface $response){
        return $response->json();
    }
}