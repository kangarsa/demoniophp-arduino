<?php

include('connection.class.php');

	$con = Connection::getInstance();
	echo Connection::getInstance() == Connection::getInstance();
	$con->initialize("/dev/ttyACM0");
	
while (true) {
	//echo $con->getDataConnection();
	echo $con->getData();
}

?>