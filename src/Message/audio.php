<?php 

namespace Bot\Message;

class Audio implements MessageInterface {

	private $recipient_id;


	public function __construct( string $recipient_id){
		$this->recipient_id = $recipient_id;
	}

	public function message( string $message_text ) :array {

		return [
			'recipient' => [
				'id' => $this->recipient_id
			],
			'message'   => [
				'attachment' => [
					'type' => 'audio' ,
					'payload' => [
						'url' => $message_text ,
					]
				]
			],
		];
	}


}