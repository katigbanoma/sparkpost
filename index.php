<?php
require 'vendor/autoload.php';

use SparkPost\SparkPost;
use GuzzleHttp\Client;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;

$httpClient = new GuzzleAdapter(new Client());
$sparky = new SparkPost($httpClient, ['key'=>'657ffdeee1e817ebf89f39d0ac4b756a3b44666a']);

$promise = $sparky->transmissions->post([
    'content' => [
        'from' => [
            'name' => 'Tm30 Team',
            'email' => 'tofunmi@mail.atp-sevas.com',
        ],
        'subject' => 'First Mailing From PHP',
        'html' => '<html><body><h1>Congratulations, {{name}}!</h1><p>You just sent your very first mailing!</p></body></html>',
        'text' => 'Congratulations, {{name}}! You just sent your very first mailing!',
    ],

    'substitution_data' => ['name' => 'Tm30.net'],
    'recipients' => [
        [
            'address' => [
                'name' => 'Abidemi',
                'email' => 'bidemi64@gmail.com',
            ],
        ],
    ],

    'cc' => [
        [
            'address' => [
                'name' => 'Adeleke',
                'email' => 'tofunmi@tm30.net',
            ],
        ],
    ],

    'bcc' => [
        [
            'address' => [
                'name' => 'Taofik',
                'email' => 'imetot@yahoo.com',
            ],
        ],
    ],
]);

try {
    $response = $promise->wait();
    $response->getStatusCode()."\n";
    print_r($response->getBody())."\n";
} catch (\Exception $e) {
    echo $e->getCode()."\n";
    echo $e->getMessage()."\n";
}
?>
