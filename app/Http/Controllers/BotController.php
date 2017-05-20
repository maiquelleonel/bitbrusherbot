<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades\Bot\Webhook;

class BotController extends Controller
{
    

	public function subscribe( Request $Request ){

		$hub_challenge = Webhook::check( config('botfb.validation_token'));

		if( ! $hub_challenge ){
			abort( 403, "Você não pode fazer isso!");
		}

		return $hub_challenge;
	}

}
