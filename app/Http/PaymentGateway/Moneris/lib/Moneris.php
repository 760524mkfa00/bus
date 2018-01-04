<?php

namespace busRegistration\Http\PaymentGateway\Moneris\lib;

use busRegistration\Http\PaymentGateway\Moneris\lib\Moneris\Moneris_Gateway;
use busRegistration\Http\PaymentGateway\Moneris\lib\Moneris\Moneris_Exception;


if (! function_exists('curl_init')) {
    throw new Moneris_Exception('The Moneris API requires the CURL extension.');
}

/**
 * A really simple way to get a Moneris_Gateway object.
 */
class Moneris
{
    // Preserve these constants for those who already use them
    const ENV_LIVE = 'live'; // use the live API server
    const ENV_STAGING = 'staging'; // use the API sandbox
    const ENV_TESTING = 'testing'; // use the mock API
    // Add store - dependent constants for those who use country codes
    const ENV_LIVE_CA = 'live'; // use the live API server
    const ENV_STAGING_CA = 'staging'; // use the API sandbox
    const ENV_TESTING_CA = 'testing'; // use the mock API

    const ENV_LIVE_US = 'live_us'; // use the live API server
    const ENV_STAGING_US = 'staging_us'; // use the API sandbox
    const ENV_TESTING_US = 'testing_us'; // use the mock API
    /**
     * Start using the API, ya dingus!
     *
     * @throws Moneris_Exception if you have a missing extension.
     *
     * @param array $params Associative array
     * 		Required keys:
     * 			- api_key string
     * 			- store_id string
     * 		Optional keys:
     * 			- environment string
     * 			- require_cvd bool
     * 			- require_avs bool
     * 			- avs_codes array
     * @return Moneris_Gateway
     */
    static public function create(array $params)
    {
        if (! isset($params['api_key'])) throw new Moneris_Exception("'api_key' is required.");
        if (! isset($params['store_id'])) throw new Moneris_Exception("'store_id' is required.");
        $params['environment'] = isset($params['environment']) ? $params['environment'] : self::ENV_LIVE;
        $gateway = new Moneris_Gateway($params['api_key'], $params['store_id'], $params['environment']);
        if (isset($params['require_cvd']))
            $gateway->require_cvd((bool) $params['require_cvd']);
        if (isset($params['cvd_codes']))
            $gateway->successful_cvd_codes($params['cvd_codes']);
        if (isset($params['require_avs']))
            $gateway->require_avs((bool) $params['require_avs']);
        if (isset($params['avs_codes']))
            $gateway->successful_avs_codes($params['avs_codes']);
        return $gateway;
    }
    // don't allow instantiation
    protected function __construct(){ }
}
