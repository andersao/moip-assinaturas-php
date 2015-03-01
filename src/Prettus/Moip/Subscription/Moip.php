<?php namespace Prettus\Moip\Subscription;

use GuzzleHttp\Client;
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
     *
     * @var string
     */
    protected $apiToken;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var
     */
    protected $environment = self::SANDBOX;

    /**
     * @var
     */
    protected $apiVersion  = "v1";

    /**
     * @var
     */
    protected $apiUrl   = "https://{environment}.moip.com.br";

    /**
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
     * @param array $credentials
     * @return $this
     */
    public function setCredential($credentials = []){
        $this->apiKey   = $credentials['key'];
        $this->apiToken = $credentials['token'];
        return $this;
    }

    /**
     * @param $environment
     * @return $this
     */
    public function setEnvironment($environment){
        $this->environment = $environment;
        return $this;
    }

    /**
     * @return Client
     */
    public function getClient(){
        return $this->client;
    }

    /**
     * @return string
     */
    public function getApiVersion(){
        return $this->apiVersion;
    }

    /**
     * @param null $url
     * @param array $options
     * @return mixed
     */
    public function get($url = null, $options = [])
    {
        return $this->client->get($url, $options);
    }

    /**
     * @param null $url
     * @param array $options
     * @return mixed
     */
    public function post($url = null, $options = [])
    {
        return $this->client->post($url, $options);
    }

    /**
     * @param null $url
     * @param array $options
     * @return mixed
     */
    public function put($url = null, $options = [])
    {
        return $this->client->put($url, $options);
    }

    /**
     * @param null $url
     * @param array $options
     * @return mixed
     */
    public function delete($url = null, $options = [])
    {
        return $this->client->delete($url, $options);
    }
}