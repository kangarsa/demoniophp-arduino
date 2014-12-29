<?php

require_once('connection.class.php');
//include('socket.async.php');

$con = Connection::getInstance();
//echo Connection::getInstance() == Connection::getInstance();
//$con->initialize("/dev/ttyACM0");
	
//$g = new AsyncSocketRecieve();

while (true) {
	//echo $con->getDataConnection();
	//echo $string;
	echo $con->getData();
    usleep(100000);
	//sleep(1);

}


//$t = microtime(true);
//$g = new AsyncWebRequest(sprintf("http://www.google.com/?q=%s", rand() * 10));
/* starting synchronized */
/*
if ($g->start()) {
    printf("Request took %f seconds to start ", microtime(true) - $t);
    while ( $g->isRunning() ) {
        echo ".";
        usleep(100);
    }
    if ($g->join()) {
        printf(" and %f seconds to finish receiving %d bytes\n", microtime(true) - $t, strlen($g->data));
    } else
        printf(" and %f seconds to finish, request failed\n", microtime(true) - $t);
}
*/
?>