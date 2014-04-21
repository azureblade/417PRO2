<?php
require_once "include/Session.php";
require_once "include/DB.php";
$session = new Session();    
$params = (object) $_REQUEST;
DB::init();
    if ($session->user == null) {
        die("prohibited");
    }

    $orders = R::findAll("order", "user_id=? order by created_at DESC", array($session->user->id));

if (isset($params->delete)) {
	$item = isset($params->id);
	if (isset($item)) {
	$order= R::load('order', $item);
	$orders= R::findAll("item_order", "order_id=?", array($order->id));
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<script src="js/sorttable.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<title>My Cart</title>

<link rel="stylesheet" type="text/css" href="css/superfish.css" />
<link rel="stylesheet" type="text/css" href="css/layout.css" />
<style type="text/css">
/* local style rules */
</style>

</head>

<body>
<div class="container">
<div class="header"><?php require_once "include/header.php" ?></div>
<div class="navigation"><?php require_once "include/navigation.php" ?></div>
<div class="content"><!-- content -->

<h2>My Orders</h2>
<div>
  <?php    foreach ($orders as $order) { 
        $total = 0;
       $id = $order->id;
       $created_at= $order->created_at;
       $items = $order->sharedItem;   

       ?>
<div >
<hgroup > 

<h3><?= date('F d, Y @ g:i A',$created_at) ?></h3>
</hgroup>
<div >
	<dl>
		<dt>Order #<?=$id?></dt>
	</dl>
</div>
<table class="sortable">
	<thead>
		<tr>
			<th>name</th>
    		<th>price</th>
		</tr>
	</thead>
	<tbody>
     <?php 
         foreach ($items as $item) { 
             $total += $item->price;
     ?>
     <tr>
     	<td><?= $item->name ?></td>
     	<td>$<?= $item->price ?></td>
    <?php } ?>
</tbody>
        </table>
        <div>
            Total: $<?=$total?>
        </div>
    </div>
    <?php }  ?>
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