<?php 

namespace Bot\Message;

interface MessageInterface {


	public function __construct( string $recipient_id);

	public function message( string $message_text ) :array ;

}