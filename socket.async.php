<?php 

require_once('connection.class.php');

error_reporting(E_ALL);

class AsyncSocketRecieve extends Thread {
//	public $arduino = Connection::getInstance();
    public $data;

    public function __construct() {
    //    $this->url = $url;
    }

    public function run() {
		set_time_limit (0);
		// Set the ip and port we will listen on
		$address = '127.0.0.1';
		$port = 6789;
		// Create a TCP Stream socket
		$sock = socket_create(AF_INET, SOCK_STREAM, 0); // 0 for  SQL_TCP
		// Bind the socket to an address/port
		socket_bind($sock, 0, $port) or die('Could not bind to address');  //0 for localhost
		// Start listening for connections
		socket_listen($sock);
		//loop and listen
		while (true) {
			echo "recibiendo socket";
			/* Accept incoming  requests and handle them as child processes */
			$client =  socket_accept($sock);
			// Read the input  from the client – 1024000 bytes
			$input =  socket_read($client, 1024000);
			// Strip all white  spaces from input
			$output =  ereg_replace("[ \t\n\r]","",$input)."\0";
			$message=explode('=',$output);
			print_r($message);
			$arduino->sendMessage($message[0]);

			/*
			if(count($message)==2)
			{
				if(get_new_order()) $response='NEW:1';
				else  $response='NEW:0';
			}
			else $response='NEW:0';
			// Display output  back to client
			socket_write($client, $response);
			socket_close($client);
			*/
		}
		// Close the master sockets
		socket_close($sock);
		$data = $message[0];
    }
}
