<!DOCTYPE html>
<html>
<head>
<script src="sortable.min.js"></script>
<link rel="stylesheet" href="sortable-theme-bootstrap.css" />
</head>
<body>
<?php
include 'createtable.php';

$sql = "SELECT * FROM employee";
/*
Parameters are passed to the return_table function as an array

example:
$name = $_GET['name'];
$params = array(':name' => "%".$name."%");
$sql = "SELECT * FROM employee where fname like :name"
return_table($sql, "Employees called ".$name, "Employee Details", $params);
*/

return_table($sql, "Employee Details", "Employee Details");
?>

</body>
</html>
