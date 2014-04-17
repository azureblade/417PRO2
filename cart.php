<?php
require_once "include/Session.php";
$session = new Session();
require_once "include/DB.php";
DB::init();

$params = (object) $_REQUEST;

if(isset($params->clear)){
  unset($session->cart);
}

elseif(isset($params->remove)){
  unset($session->cart[$params->'data-id']);
}

elseif(isset($session->cart)) {
  $cart = $session->cart;
}
else{
  $i=1;
}
$error = false;
$message = "There was an error: </li>"
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
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
  </tr>
</thead>
  <tbody>
    <?php if(isset($cart)): ?>
    <?php foreach ($cart as $id => $quantity):  ?>
    <?php $item = R::load('item', $id); ?>
      <tr>
        <td><?php echo htmlspecialchars($item->name) ?></td>
        <td>$<?php echo number_format($item->price,2) ?></td>
        <td><?php echo $quantity ?></td> {center-aligned}
        <td><input data-id="<?php echo $id ?>" type="submit" name="remove" value="Remove" /></td>
      </tr>
      <?php $i++ ?>
    <?php endforeach ?>
  <?php endif ?>
  </tbody>
</table>
<div>
<input type="submit" id="clear" name="clear" value="Clear Cart" />
<br>
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
