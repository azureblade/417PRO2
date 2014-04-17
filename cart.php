<?php
require_once "include/Session.php";
$session = new Session();
require_once "include/DB.php";
DB::init();

$params = (object) $_REQUEST;

$total = 0;

if(isset($params->clear)){
  unset($session->cart);
}

if(isset($params->remove)){
  unset($session->cart[$params->remID]);
}

if(isset($params->modify)){

}

if(isset($session->cart)) {
  $cart = $session->cart;
}
$error = false;
$message = "There was an error: </li>"
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

<h2>My Cart</h2>
<form>
<table class="sortable">
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
    <?php if(isset($cart)): ?>
    <?php foreach ($cart as $id => $quantity):  ?>
    <?php $item = R::load('item', $id); ?>
      <tr>
        <td><?php echo htmlspecialchars($item->name) ?></td> 
        <td>$<?php echo number_format($item->price,2) ?></td>
        <td style="text-align: center"><?php echo $quantity ?></td> 
        <td><input type="submit" name="remove" value="Remove" />
            <input type="hidden" name="remID" value="<?php echo $id ?>" /></td>
        <td><input type="submit" name="modify" value="Modify" /></td>
        <?php $total += ($item->price * $quantity); ?>
      </tr>
      <?php $i++ ?>
    <?php endforeach ?>
  <?php endif ?>
  </tbody>
  <tfoot>
    <tr><td>TOTAL</td><td>$<?php echo number_format($total,2) ?></td></tr>
  </tfoot>
</table>
<div>
<input type="submit" id="clear" name="clear" value="Clear Cart" />
<br>

<br>
<br>
<input type="submit" id="order" name="order" value="Submit Order">
</form>
</div>
</div><!-- content -->
</div><!-- container -->






<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/superfish.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('#clear').click(function(){
    return confirm("Are you sure?");
  });
});

</script>

</body>
</html>
