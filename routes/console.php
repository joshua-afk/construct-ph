<?php

use Illuminate\Foundation\Inspiring;
use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('response:get {uri} ', function ($uri) {
	$client   = new Client(['base_uri' => "http://construct-ph.me/"]);
	$response = $client->request('GET', $uri);
	dd($response);
});

Artisan::command('response:post {uri} ', function ($uri) {
	$client   = new Client(['base_uri' => "http://construct-ph.me/"]);
	$response = $client->request('POST', $uri);
	dd($response);
});