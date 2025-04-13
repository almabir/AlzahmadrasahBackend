<?php

namespace App\Services;

use GuzzleHttp\Client;

class SSLCommerzService
{
    protected $storeId;
    protected $storePassword;
    protected $isSandbox;

    public function __construct()
    {
        $this->storeId = env('SSLCOMMERZ_STORE_ID');
        $this->storePassword = env('SSLCOMMERZ_STORE_PASSWORD');
        $this->isSandbox = env('SSLCOMMERZ_IS_SANDBOX', true);
    }

    public function initializePayment($post_data)
    {
        $url = $this->isSandbox
            ? 'https://sandbox.sslcommerz.com/gwprocess/v4/api.php'
            : 'https://securepay.sslcommerz.com/gwprocess/v4/api.php';

        $client = new Client();
        $response = $client->post($url, [
            'form_params' => $post_data,
        ]);

        return json_decode($response->getBody(), true);
    }

    // ... other methods for verifying payments, etc.
}