<?php

namespace Bot;

class Webhook {

	public function check( string $token ){

		$hub_mode = filter_input(INPUT_GET,"hub_mode");
		$hub_verify_token = filter_input(INPUT_GET,"hub_verify_token");

		$ret = false;

		if( $hub_mode === "subscribe" && $hub_verify_token === $token)
			$ret = filter_input(INPUT_GET, 'hub_challenge');

		return $ret;

	}
}