<?php

namespace Bot;

use GuzzleHttp\Client as GuzzleClient;

class CallSendAPI {

	const URL = 'https://graph.facebook.com/v2.6/me/messages';

	private $page_access_token;


	public function __construct( string $page_access_token){

		$this->page_access_token = $page_access_token;
	}

	public function make(array $message) :string {

		$cli = new GuzzleClient;

		$res = $cli->request('POST', CallSendAPI::URL,[
			'json'  => $message,
			'query' => ['access_token' => $this->page_access_token],
		]);
		
		return (string) $res->getBody();
	}
}