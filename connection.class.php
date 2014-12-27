<?php

//this may be specialized
include_once("inc/php_serial.class.php");

class Connection extends Singleton {

	private $con;
	private $dataConnection;

	/*
	private function __clone(){}
    private function __wakeup(){}

	public static function getInstance($dataConnection){
		static $instance;
		if($instance === null){
			echo "hola!";
			$instance = new static($dataConnection);
		}
		return $instance;
	}
*/
	public function initialize($dataConnection){
		$this->con = new phpSerial();
		$this->con->dataConnection = $dataConnection;
		$this->con->deviceSet($dataConnection);
		$this->con->confBaudRate(9600);
		$this->con->deviceOpen();
		sleep(2);
	}

	public function getDataConnection(){
		return $this->dataConnection;
	}
	public function getData(){
		return $this->con->readChar();
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