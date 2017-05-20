<?php 

namespace Bot\Message;

class Text implements MessageInterface {

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
			 	'text'     => $message_text,
				'metadata' => 'DEVELOPER_DEFINED_METADATA',
			]

		];
	}

}