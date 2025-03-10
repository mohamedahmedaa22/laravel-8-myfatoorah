<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class FatoorahServices
{

    private $base_url;
    private $headers;
    private $request_client;

    public function __construct (Client $request_client)
    {
        $this->request_client = $request_client;
        $this->base_url = env('fatoora_base_url ');
        $this->headers = [
            'Content-Type' => 'application/json',
            'authorization' => 'Bearer' . env('fatoorah_token')


        ];


    }

    public function buildRequest( $url , $method , $data = [])
    {
        $request = new Request($method , $this->base_url.$url , $this->headers);
        // if(!$body)
        // return false;
        $request = $this->request_client->send($request , [
            'json' -> $data
        ]);

        if($response->getStatusCode() != 200)
        {
            return false;
        }
        $response = json_encode($response->getBody() , true);

        return $response;
    }

    public function sendPayment($data)
    {
        // dd($data);
        $response = $this->buildRequest('v2/SendPayment' , 'Get' , $data);
    }
}
