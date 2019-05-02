<?php namespace Prettus\Moip\Subscription;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Prettus\Moip\Subscription\Webservice\RenderToJson;
use Prettus\Moip\Subscription\Webservice\ResourceUtils as Utils;
use Prettus\Moip\Subscription\Webservice\Webservice;
use Prettus\Moip\Subscription\Contracts\MoipHttpClient;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class MoipClient
 * @package Prettus\Moip\Subscription
 */
class MoipClient implements MoipHttpClient {

    use Utils;

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
     * @var array
     */
    protected $requestOptions = [];

    /**
     * Moip
     *
     * @param $apiToken
     * @param $apiKey
     * @param string $environment
     */
    public function __construct($apiToken, $apiKey, $environment = MoipHttpClient::PRODUCTION){

        $this->setCredential(['token'=>$apiToken,'key'=>$apiKey]);
        $this->setEnvironment($environment);

        $base_uri = str_replace('{environment}',$this->environment, $this->apiUrl);
        $this->client  = new Client(['base_uri' => $base_uri]);

        $this->requestOptions = [
            'headers' => [
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
                'Authorization' => 'Basic '.base64_encode("{$this->apiToken}:{$this->apiKey}")
            ]
        ];
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
     *
     * @throws ClientException
     * @return array
     */
    public function get($url = null, $options = [])
    {
        try {
            $response = $this->client->get($url, $this->getOptions($options));

            return Utils::formatInJson( $response );
        } catch(RequestException $e) {
            if ($e->hasResponse()) {
                return $this->composeError($e->getResponse());
            }

            throw $e;
        }
    }

    /**
     * Executa uma requisição do tipo POST
     *
     * @param null $url
     * @param array $options
     *
     * @throws ClientException
     * @return string|array
     */
    public function post($url = null, $options = [])
    {
        try {
            $response = $this->client->post($url, $this->getOptions($options));

            return $response->getBody()->getContents();
        } catch(RequestException $e) {
            if ($e->hasResponse()) {
                return $this->composeError($e->getResponse());
            }

            throw $e;
        }
    }

    /**
     * Executa uma requisição do tipo PUT
     *
     * @param null $url
     * @param array $options
     *
     * @throws ClientException
     * @return string|array
     */
    public function put($url = null, $options = [])
    {
        try {
            $response = $this->client->put($url, $this->getOptions($options) );

            return $response->getBody()->getContents();
        } catch(RequestException $e) {
            if ($e->hasResponse()) {
                return $this->composeError($e->getResponse());
            }

            throw $e;
        }
    }

    /**
     * Executa uma requisição do tipo DELETE
     *
     * @param null $url
     * @param array $options
     *
     * @throws ClientException
     * @return string|array
     */
    public function delete($url = null, $options = [])
    {
        try {
            $response = $this->client->delete($url, $this->getOptions($options));

            return $response->getBody()->getContents();
        } catch(RequestException $e) {
            if ($e->hasResponse()) {
                return $this->composeError($e->getResponse());
            }

            throw $e;
        }
    }

    /**
     * @param array $options
     * @return array
     */
    public function getOptions($options = []){
        return array_merge($this->requestOptions, $options);
    }

    /**
     * Monta um array contendo os erros da requisição
     *
     * @param ResponseInterface $response
     *
     * @return array
     */
    private function composeError(ResponseInterface $response)
    {
        $error = array(
            'error' => true,
            'http_code' => $response->getStatusCode(),
            'http_reason' => $response->getReasonPhrase()
        );

        $message = Utils::formatInJson($response);

        if ($message) {
            $error = $error + $message;
        }

        return $error;
    }
}