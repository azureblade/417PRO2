<?php
session_start();
require_once "include/DB.php";
DB::init();
if(empty($_SESSION['cart']))

$params= (object) $_REQUEST;  

if(isset($params->add)){
  header("location: add.php");
}

$items = R::findAll('item',"1 order by name asc");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<script src="js/sorttable.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<title>Home</title>
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

<h2>Store Items</h2>
<div class="scroll">

<table class="sortable">
 <thead>
    <tr>
    <th>name</th>
    <th>category</th>
    <th>price</th>
  </tr>
</thead>
  <tbody>
  <?php foreach ($items as $item): ?>
    <tr>
      <td><a href="showItem.php?item_id=<?php echo $item->id ?>">
        <?php echo htmlspecialchars($item->name) ?></a>
      </td>
      <td><?php echo $item->category ?></td>
      <td>$<?php echo number_format($item->price,2) ?></td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>

</div>

<?php if($session->user->level == 1): ?>
  
<input type="submit" id="add" name="add" value="Add New Item"><a href="add.php">Add New Item</a> </input>
<?php endif ?>

</div><!-- content -->
</div><!-- container -->

<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/superfish.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript">
</script>

</body>
</html>
