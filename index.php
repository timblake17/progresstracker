<?php
session_start();
$db = mysqli_connect('localhost', 'root', 'root', 'progresstracker');

if (isset($_POST['save'])) {


	$name= $_POST['name'];

	mysqli_query( $db, "INSERT INTO javascript (commit,name) VALUES (1,'$name')" );

}


?>




<!DOCTYPE html>
<html>
<head>
	<title>Progress Tracker</title>
</head>
<body>
<form method="post" action="index.php" >

	<input type="radio" name="Language" name="check-1" value="JS" />
	<label for="check-1">Javascript</label>
	<input type="radio" name="Language" name="check-2" value="HTML"  />
	<label for="check-2">HTML</label>
	<input type="radio" name="Language" name="check-3" value="CSS"  />
	<label for="check-3">CSS</label>
	<input type="radio" name="Language" name="check-4" value="PHP"  />
	<label for="check-4">PHP</label>
	<div class="input-group">
		<label>Commit</label>
		<input type="text" name="name" value="">
	</div>
	<div class="input-group">
		<button class="btn" type="submit" name="save" >Save</button>


	</div>
</form>

<?php


$javascript = mysqli_query($db, "SELECT * FROM javascript");
$js = 1; while ($row = mysqli_fetch_array($javascript)) { ?>
<?php $js++; }



?>








<p> <?php echo $js; ?> </p>

</body>
</html>