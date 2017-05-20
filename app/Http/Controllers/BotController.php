<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades\Bot\Webhook;
use Bot\Message\Text as MessageText;
use Bot\CallSendAPI as FBAPI;

class BotController extends Controller
{
    
	public function subscribe( Request $Request ){

		$hub_challenge = Webhook::check( config('botfb.validation_token'));

		if( ! $hub_challenge ){
			abort( 403, "Você não pode fazer isso!");
		}

		return $hub_challenge;
	}

	public function receiveMessage( Request $Request ){

		$event = file_get_contents("php://input");
		$event = json_decode($event, true, 512, JSON_BIGINT_AS_STRING);
		
		$event = $event['entry'][0]['messaging'][0];
		$sender_id = $event['sender']['id'];
		$message   = $event['message']['text'];
		//$postback  = $event['postback'];

		$mt   = new MessageText($sender_id);
		$text = $mt->message('Você digitou: ' . $message);

		$fbapi = new FBAPI( config('botfb.page_access_token'));
		return $fbapi->make($text);
	}
}
