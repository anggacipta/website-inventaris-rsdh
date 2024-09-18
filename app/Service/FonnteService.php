<?php

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class FonnteService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('FONNTE_API_KEY');
    }

    public function sendMessage($to, $message)
    {
        $headers = [
            'Authorization' => $this->apiKey
        ];
        $options = [
            'multipart' => [
                [
                    'name' => 'target',
                    'contents' => $to
                ],
                [
                    'name' => 'message',
                    'contents' => $message
                ]
            ]
        ];
        $request = new Request('POST', 'https://api.fonnte.com/send', $headers);
        $response = $this->client->sendAsync($request, $options)->wait();

        return json_decode($response->getBody(), true);
    }
}
