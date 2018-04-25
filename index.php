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
	<link rel="stylesheet" type="text/css" href="style.css">


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

	<p><?php echo 'The language you have committed is ' . $language;?></p>


	<canvas id="myCanvas"></canvas>




<div class="horizontal-bar-graph" id="my-graph"></div>
<legend for="myCanvas"></legend>



<ul class="lang-list">
	<li>Javascript</li>
	<li>CSS</li>
	<li>HTML</li>
	<li>PHP</li>
</ul>

</body>
</html>







<script type="text/javascript">

    jsnum = <?php echo $js; ?>;
    cssnum = <?php echo $cssTable; ?>;
    htmlnum = <?php echo $HTMLTable; ?>;
    phpnum = <?php echo $PHPTable; ?>;


    var myCanvas = document.getElementById("myCanvas");
    myCanvas.width = 300;
    myCanvas.height = 300;

    var ctx = myCanvas.getContext("2d");

    function drawLine(ctx, startX, startY, endX, endY,color){
        ctx.save();
        ctx.strokeStyle = color;
        ctx.beginPath();
        ctx.moveTo(startX,startY);
        ctx.lineTo(endX,endY);
        ctx.stroke();
        ctx.restore();
    }



    function drawBar(ctx, upperLeftCornerX, upperLeftCornerY, width, height,color){
        ctx.save();
        ctx.fillStyle=color;
        ctx.fillRect(upperLeftCornerX,upperLeftCornerY,width,height);
        ctx.restore();
    }

    var myVinyls = {
        "Classical music": jsnum,
        "Alternative rock": htmlnum,
        "Pop": cssnum,
        "Jazz": phpnum
    };


    var Barchart = function(options){
        this.options = options;
        this.canvas = options.canvas;
        this.ctx = this.canvas.getContext("2d");
        this.colors = options.colors;

        this.draw = function(){
            var maxValue = 0;
            for (var categ in this.options.data){
                maxValue = Math.max(maxValue,this.options.data[categ]);
            }
            var canvasActualHeight = this.canvas.height - this.options.padding * 2;
            var canvasActualWidth = this.canvas.width - this.options.padding * 2;

            //drawing the grid lines
            var gridValue = 0;
            while (gridValue <= maxValue){
                var gridY = canvasActualHeight * (1 - gridValue/maxValue) + this.options.padding;
                drawLine(
                    this.ctx,
                    0,
                    gridY,
                    this.canvas.width,
                    gridY,
                    this.options.gridColor
                );

                //writing grid markers
                this.ctx.save();
                this.ctx.fillStyle = this.options.gridColor;
                this.ctx.font = "bold 10px Arial";
                this.ctx.fillText(gridValue, 10,gridY - 2);
                this.ctx.restore();

                gridValue+=this.options.gridScale;
            }

            //drawing the bars
            var barIndex = 0;
            var numberOfBars = Object.keys(this.options.data).length;
            var barSize = (canvasActualWidth)/numberOfBars;

            for (categ in this.options.data){
                var val = this.options.data[categ];
                var barHeight = Math.round( canvasActualHeight * val/maxValue) ;
                drawBar(
                    this.ctx,
                    this.options.padding + barIndex * barSize,
                    this.canvas.height - barHeight - this.options.padding,
                    barSize,
                    barHeight,
                    this.colors[barIndex%this.colors.length]
                );

                barIndex++;
            }

        }
    }

    var myBarchart = new Barchart(
        {
            canvas:myCanvas,
            padding:10,
            gridScale:5,
            gridColor:"#eeeeee",
            data:myVinyls,
            colors:["#a55ca5","#67b6c7", "#bccd7a","#eb9743"]
        }
    );
    myBarchart.draw();

   /// document.write(num);




</script>

