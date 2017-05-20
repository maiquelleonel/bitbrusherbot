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
		
		$mt   = new MessageText($sender_id);
		$fbapi = new FBAPI( config('botfb.page_access_token'));
		//$message   = $event['message']['text'];
		$postback  = $event['postback'];

		$bot_messages = [
			'Olá humano!',
			'Eu sou o Bit Brusher, um bot bem nerd criado para interagir contigo!',
			'Sei que tu também és nerd, então: chega mais vivente! Te aprochega! :)'
		];
		switch($postback['payload']){
			case 'inicio':
				foreach($bot_messages as $bot_message){
					$text = $mt->message($bot_message);
					$fbapi->make($text);
					sleep(2);
				}
		}

		return response()->json(['status' => 'success']);
	}
}
