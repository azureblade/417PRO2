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
 
if (isset($params->add)) {
  try {
    $title = trim($params->title);
    $description = $params->description;
    if (strlen($title) < 3) {
      throw new Exception("name must be of length at least 3");
    }
    $recipe = R::dispense("recipes");
    $recipe->title = $title;
    $recipe->description = $description;
    $id = R::store($recipe);
    header("location: index.php?id=$id&show=1");
    exit();
  }
  catch(RedBean_Exception_SQL $ex) {
    $response = "duplicate title";
  } 
  catch(Exception $ex) {
    $response = $ex->getMessage();
  }
}
else {
  $params->title = "";
  $params->description = "";
  $response = "";
}
 
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<title>Add Recipe</title>
 
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
 
<h2>Add Recipe</h2>
 
<form id="add" action="" method="post">
 
<b>name:</b>
<br />
<input type="text" name="title" 
       value="<?php echo htmlspecialchars($params->title)?>" />
<br />
<br />
<b>content</b>:
<br />
<textarea name="description" spellcheck="false"
  ><?php echo htmlspecialchars($params->description)?></textarea>
<br />
<br />
<input type="submit" name="add" value="Add" />
</form>
 
<h3 id="resp"><?php echo $response ?></h3>
 
</div><!-- content -->
</div><!-- container -->
 
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/superfish.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript">
/* local JavaScript */
</script>
 
</body>
</html>