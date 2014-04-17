<?php
require_once "include/Session.php";
require_once "include/DB.php";
DB::init();
$session = new Session();

$orders = R::findall('order', "1 order by created_at asc")

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<title>View Orders</title>
<link rel="stylesheet" type="text/css" href="css/superfish.css" />
<link rel="stylesheet" type="text/css" href="css/layout.css" />
<link rel="stylesheet" type="text/css" href="css/table-display.css" />
<style type="text/css">
  .block {
    display: inline-block;
    vertical-align: top;
  }
  .item-descrip {
    max-width: 375px;
    margin: 2px 5px;
  }
  .item-descrip {
    margin: 2px 5px;
  }
  .item-descrip header {
    font-weight: bold;
    margin: 2px 0 5px 0;
 }
  .item-image img {
    max-width: 300px;
    margin-top: 5px;
  }
  .item-features {
    margin-right: 40px;
    max-width: 400px;
  }
  .item-cart {
    margin: 5px;
    padding: 5px 10px;
    border: solid 2px  red;
    border-radius: 4px;
  }
</style>
</head>

<body>
<div class="container">
<div class="header"><?php require_once "include/header.php" ?></div>
<div class="navigation"><?php require_once "include/navigation.php" ?></div>
<div class="content"><!-- content -->

<h2>Orders</h2>

<table class="sortable">
	<thead>
		<tr>
			<td>Order</td>
			<td>Name</td>
			<td>Email</td>
			<td>Time</td>
		</tr>
	</thead>
<tbody>
	<?php foreach ($orders as $order): ?>
<tr>

<td><a href="showOrder.php?order_id=<?php echo $order->id ?>">
<?php echo htmlspecialchars($order->user_id) ?></a>
</td>

<td><?php 
$user_id   = $session->order->user_id;
$user = R::findOne('user', 'id=?', array($order->user_id));
echo $user->name;
 ?>
</td>

<td>
<?php $email = R::findOne('user', 'id=?', array($order->user_id));
echo $email->email;
 ?>
</td>

<td>
<?php $date = new DateTime();
$date->setTimestamp($order->created_at);
echo $date->format('Y-m-d H:i:s');
 ?>
</td>

</tr>
<?php endforeach ?>
</tbody>
</table>


</div><!-- content -->
</div><!-- container -->

<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/superfish.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript"></script>

</body>
</html>


