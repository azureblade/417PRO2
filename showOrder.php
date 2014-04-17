<?php
session_start();
require_once "include/DB.php";
DB::init();
require_once "include/Session.php";

if(!isset($session->item_order)){
	$session->item_order = array();
}

?>

<html>
<head>
<script src="js/sorttable.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<title>Order</title>
<link rel="stylesheet" type="text/css" href="css/superfish.css" />
<link rel="stylesheet" type="text/css" href="css/layout.css" />
<link rel="stylesheet" type="text/css" href="css/table-display.css" />
<style type="text/css">   
</style>
</head>

<body>
<div class="container">
<div class="header"><?php require_once "include/header.php" ?></div>
<div class="navigation"><?php require_once "include/navigation.php" ?></div>
<div class="content"><!-- content -->

<table>
<thead>
<tr>
<th>name</th>
    <th>price</th>
    <th>quantity</th>
    <th></th>
    <th></th>
</tr>
</thead>
<tbody>

<tr>
<td>

</td>
</tr>
</tbody>
</table>

</div>
</div><!-- content -->
</div><!-- container -->

<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/superfish.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript">
</script>

</body>
</html>