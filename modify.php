<?php
require_once "include/Session.php";
$session = new Session();
//if (!isset($session->valid)) {
//  header("location: login.php");
//  exit();
//}
 
require_once "include/db.php";
 
$params = (object) $_REQUEST;
//print_r($params);
 
$selected = R::load("recipes",$params->id);
 
if (isset($params->update)) {
  try {
    $title = trim($params->title);
    $description = $params->description;
    if (strlen($title) < 3) {
      throw new Exception("name must be of length at least 3");
    }
    $selected->title = $title;
    $selected->description = $description;
    $id = R::store($selected);
    header("location: index.php?id=$id&show=1"); exit();
  }
  catch(RedBean_Exception_SQL $ex) {
    $response = "duplicate title";
  } 
  catch(Exception $ex) {
    $response = $ex->getMessage();
  }
}
elseif (isset($params->remove)) {
  R::trash($selected);
  header("location: index.php"); exit();
}
else {
  $response = "";
  $params->title= $selected->title;
  $params->description = $selected->description;
}
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<title>Modify Recipe</title>
 
<link rel="stylesheet" type="text/css" href="css/layout.css" />
<link rel="stylesheet" type="text/css" href="css/superfish.css" />
<style type="text/css">
textarea {
  width: 95%;
  height: 220px;
}
input[type='text'] {
  width: 95%;
}
.sep { margin: 7px 0; }
</style>
 
</head>
 
<body>
<div class="container">
<div class="header"><?php require_once "include/header.php" ?></div>
<div class="navigation"><?php require_once "include/navigation.php" ?></div>
<div class="content"><!-- content -->
 
<h2>Modfiy Recipe</h2>
 
<form id="update" action="modify.php" method="post">
<div class='sep'>
<b>id</b>: <?php echo $selected->id ?>
</div>
<div class='sep'>
<b>name:</b>
<br />
<input type="text" name="title" 
      value="<?php echo htmlspecialchars($params->title)?>" />
</div>
<div class='sep'>
<b>content</b>:
<br />
<textarea rows="0" cols="0" name="description" spellcheck="false"
  ><?php echo htmlspecialchars($params->description)?></textarea>
<br />
<br />
<input type="hidden" name="id" value="<?php echo $selected->id?>" />
<input type="submit" name="update" value="Modify" />
<input type="submit" name="remove" value="Remove" />
</div>
</form>
 
<h3 id="resp"><?php echo $response ?></h3>
 
</div><!-- content -->
</div><!-- container -->
 
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/superfish.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#update input[name='remove']").click(function () { 
     return confirm("Are you sure"); 
  }); 
});
</script>
 
</body>
</html>