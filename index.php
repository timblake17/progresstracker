<?php
session_start();
$db = mysqli_connect('localhost', 'root', 'root', 'progresstracker');

$language= $_POST ['language'];

if (isset($_POST['save']) && $language=='Javascript') {
		$name = $_POST['name'];
		mysqli_query( $db, "INSERT INTO javascript (commit,name) VALUES (1,'$name')" );
}   else if (isset($_POST['save']) && $language=='CSS') {
	$name = $_POST['name'];
	mysqli_query( $db, "INSERT INTO css (commit,name) VALUES (1,'$name')" );
} else if (isset($_POST['save']) && $language=='HTML') {
	$name = $_POST['name'];
	mysqli_query( $db, "INSERT INTO HTML (commit,name) VALUES (1,'$name')" );
} else if (isset($_POST['save']) && $language=='PHP') {
	$name = $_POST['name'];
	mysqli_query( $db, "INSERT INTO PHP (commit,name) VALUES (1,'$name')" );
}
?>



<!DOCTYPE html>
<html>
<head>
	<title>Progress Tracker</title>
</head>
<body>
<form method="post" action="index.php" >
	<form action="" method="post">
		<div>
			<input type="radio" name="language" value="Javascript" checked="checked">Javascript<br>
			<input type="radio" name="language" value="CSS">CSS<br>
			<input type="radio" name="language" value="HTML">HTML<br>
			<input type="radio" name="language" value="PHP">PHP<br>
		</div>
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

$css = mysqli_query($db, "SELECT * FROM css");
$cssTable = 1; while ($row = mysqli_fetch_array($css)) { ?>
	<?php $cssTable++; }

$HTML = mysqli_query($db, "SELECT * FROM HTML");
$HTMLTable = 1; while ($row = mysqli_fetch_array($HTML)) { ?>
	<?php $HTMLTable++; }

$PHP = mysqli_query($db, "SELECT * FROM PHP");
$PHPTable = 1; while ($row = mysqli_fetch_array($PHP)) { ?>
	<?php $PHPTable++; }
?>

	<p> <?php echo 'Javascript Commits ' . $js; ?></p>
	<p> <?php echo 'CSS Commits ' . $cssTable; ?></p>
	<p> <?php echo 'HTML Commits ' . $HTMLTable; ?></p>
	<p> <?php echo 'PHP Commits ' . $PHPTable; ?></p>



</body>


<?php

echo 'The language you have committed is ' . $language;

?>



</html>







<script type="text/javascript">

    num = <?php echo $js; ?>;

    document.write(num);




</script>

