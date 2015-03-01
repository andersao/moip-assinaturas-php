<?php namespace Prettus\Moip\Subscription;

use Prettus\Moip\Subscription\Contracts\MoipHttpClient;
use Prettus\Moip\Subscription\Resources\Customers;
use Prettus\Moip\Subscription\Resources\Invoices;
use Prettus\Moip\Subscription\Resources\Payments;
use Prettus\Moip\Subscription\Resources\Plans;
use Prettus\Moip\Subscription\Resources\Preferences;
use Prettus\Moip\Subscription\Resources\Subscriptions;

/**
 * Class Api
 * @package Prettus\Moip\Subscription
 */
class Api {

    /**
     * @var MoipHttpClient
     */
    protected $client;

    /**
     * @var Customers
     */
    protected $customers;

    /**
     * @var Invoices
     */
    protected $invoices;

    /**
     * @var Payments
     */
    protected $payments;

    /**
     * @var Plans
     */
    protected $plans;

    /**
     * @var Preferences
     */
    protected $preferences;

    /**
     * @var Subscriptions
     */
    protected $subscriptions;

    /**
     * @param MoipHttpClient $client
     */
    public function __construct(MoipHttpClient $client){
        $this->client           = $client;
        $this->customers        = new Customers($this->client);
        $this->invoices         = new Invoices($this->client);
        $this->payments         = new Payments($this->client);
        $this->plans            = new Plans($this->client);
        $this->preferences      = new Preferences($this->client);
        $this->subscriptions    = new Subscriptions($this->client);
    }

    /**
     * @return Customers
     */
    public function customers(){
        return $this->customers;
    }

    /**
     * @return Invoices
     */
    public function invoices(){
        return $this->invoices;
    }

    /**
     * @return Payments
     */
    public function payments(){
        return $this->payments;
    }

    /**
     * @return Plans
     */
    public function plans(){
        return $this->plans;
    }

    /**
     * @return Preferences
     */
    public function preferences(){
        return $this->preferences;
    }

    /**
     * @return Subscriptions
     */
    public function subscriptions(){
        return $this->subscriptions;
    }
}