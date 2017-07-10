<?php
//Function to return a HTML table from a SQL query
function return_table($sqlstring, $title='Title', $caption='Caption', $params=array()) {
	$db = parse_ini_file("dbase.ini"); //Store this file away from the webserver path

	$serverName = $db['servername']; //Database Server Name
	$uid = $db['uid']; //Database UserID
	$pwd = $db['pwd']; //Database Users Password
	$dbase = $db['db']; //Database Name
	$SQLServer = $db['SQLServer']; //Specify - SQL Server: set to dblib, MySQL: set to mysql, Postgre: set to pgsql in the ini file,
					// make sure you have the correct PDO libraries installed

	try{
		$dsn = $SQLServer .':host=' . $serverName . ';dbname='.$dbase;
		$conn = new PDO ($dsn, $uid, $pwd);
	} catch (PDOException $e) {
		echo "Failed to get DB handle " . $e->getMessage() . "\n";
		exit;
	}

	echo "<h1>".$title."</h1>".
		"<style type ='text/css'>".
	 	"table { border-collapse:collapse;border:1px solid #3399FF; font:10pt verdana; color:#343434; }".
		"table td, table th, table caption { border:1px solid #3399FF; }".
		"table caption { font-weight:bold; background-color:white }".
		"table th { background-color#3399FF; font-weight:bold; }".
		"</style>".
		"<table class='sortable-theme-bootstrap' data-sortable>".
		"<caption>".$caption."</caption>".
		"<thead><tr>";

	$result=$conn->prepare($sqlstring);
	$result->execute($params);

	for ($x=0;$x <= $result->columnCount() - 1;$x++) {
		echo "<th>".$result->getColumnMeta($x)["name"]."</th>";
	}
	echo "</tr></thead>";

	foreach ($result->fetchAll() as $row) {
		echo "<tr>";
		for ($x=0;$x <= $result->columnCount() -1;$x++) {
			echo "<td>".$row[$x]."</td>";
		}
		echo "</tr>";
	}

	echo "</tbody></table>";
	unset($conn); unset($result);
}

