<?php
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'user';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array('db' => 'id', 'dt' => 'id'),
    array('db' => 'name', 'dt' => 'name'),
    array('db' => 'mail', 'dt' => 'mail'),
    array('db' => 'contact', 'dt' => 'contact'),
    array('db' => 'technology', 'dt' => 'technology'),
    array('db' => 'experience', 'dt' => 'experience'),
    array('db' => 'status', 'dt' => 'status'),
  

);

// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db' => 'user_details',
    'host' => 'localhost',
);

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require 'ssp.class.php';

// $_REQUEST["myKey"]
$whareStatus = "";
if($_REQUEST["myKey"] != "all") {
    $whareStatus = 'status = '.$_REQUEST["myKey"];
}

echo json_encode(
    SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, null ,$whareStatus)
);
