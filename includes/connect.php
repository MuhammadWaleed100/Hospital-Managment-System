<?php

 $serverName = "DESKTOP-M3PPSA2\WALEED";
 $databaseName = "hospital1";

 $connectionInfo = array("Database"=>$databaseName);

 /* Connect using SQL Server Authentication. */
 $conn = sqlsrv_connect( $serverName, $connectionInfo);
 $params = array();
 $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );

 if ( $conn )
 {
    //  echo "Connection established.<br>\n";
 }

 else
 {
      echo "Error in establishing connection.\n";
      die( print_r( sqlsrv_errors(), true));
 }


?>
