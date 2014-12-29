<?php

//this may be specialized
include_once("inc/php_serial.class.php");

class Connection {

	private $con;
	private $dataConnection;
	private static $instance;

	
	private function __clone(){}
    private function __wakeup(){}
    private function __construct(){
		$this->con = new phpSerial();
		$this->con->dataConnection = "/dev/ttyACM0";
		$this->con->deviceSet("/dev/ttyACM0");
		$this->con->confBaudRate(9600);
		$this->con->deviceOpen();
		sleep(2);
    }

	public static function getInstance(){
		if (  !self::$instance instanceof self)
		{
			self::$instance = new self;
			echo "Instancia no existente";
		}
		return self::$instance;
	}

	public function getDataConnection(){
		return $this->dataConnection;
	}

	public function getData(){
		$str = "";
		$char = $this->con->readChar();
		while($char != ">"){
			$str = $str.$char;
			$char = $this->con->readChar();	
    		usleep(1000);
		}
		$str = $str.$char;
		return $str;
		//return $this->con->readChar();
	}

	public function sendMessage($data){
		echo "SendMessage:".$data;
		$this->con->sendMessage($data,0); 
		echo "DATOSENVIADOS";
	}

	public function getMessage(){
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
		//while (true) {
			echo "recibiendo socket";
			/* Accept incoming  requests and handle them as child processes */
			$client =  socket_accept($sock);
			// Read the input  from the client – 1024000 bytes
			$input =  socket_read($client, 1024000);
			// Strip all white  spaces from input
			$output =  ereg_replace("[ \t\n\r]","",$input)."\0";
			echo $output."[en conn class]";
			//$message=explode('=',$output);
			//print_r($message);
			//$arduino->sendMessage($message[0]);

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
	//	}
		// Close the master sockets
		socket_close($sock);
		//return $message[0];
		return $output;
	}

}

class Singleton
{
    protected static $instance = null;

    protected function __construct()
    {
        //Thou shalt not construct that which is unconstructable!
    }

    protected function __clone()
    {
        //Me not like clones! Me smash clones!
    }

    public static function getInstance()
    {
        if (!isset(static::$instance)) {
            static::$instance = new static;
        }
        return static::$instance;
    }
}