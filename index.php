<?php
ini_set('display_errors',1);  error_reporting(E_ALL);

include("functions/functions.php");
include("classes/good_quotes.php");

if (isset($_REQUEST["author"])) {
			$author = $_REQUEST["author"];
			echo "<div class='author'><h1>" . $author . "</h1></div>";
		}else{
			$author = "";
		}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

?>
<script type="text/javascript">var post = true;</script>
<?php

}else{
?>
<script type="text/javascript">var post = false</script>
<?php
}

?>

<!DOCTYPE html>
<head>
<title>GoodReads Quote Scraper</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
<link href='http://fonts.googleapis.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<html>
	<body>
		<div class="siteContainer">
			<div class="ribbon">
				<a href="http://www.goodreads.com">
					<img class="goodRead" src='./images/Goodreads-icon.png'>
				</a>
				<h1>QuoteBot 2.0</h1>
			</div>
		
		<div class="formWrapper">
				<form method="post" id="authorField">
					<input class="authorField" type="text" name="author" placeholder="Last Name of Author or Subject">
					<input type="number" name="pages" min=1 max=20 placeholder="Pages">
					<input class="button" type="submit" value="Submit" style="">
				</form>
			</div>		
					<div class="wrapper">

						<div id="box" class="output"><div class='loading' ><img src='./images/robot.gif'></div></div>
						
						<div id="box" class="quotes"></div>

					</div>
				</form>
			</div>
<?php
		
	if (isset($_REQUEST["pages"])) {
		$pages = intval($_REQUEST["pages"]);
	}else{
		$pages = 1;
	}

	$document = new Goodreads($author, $pages);

	$json = json_encode($document->quotes);
	//var_dump($json);

	//echo prettyJSON($json, '  ');

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

?>
	<script type="text/javascript">
		var quotes =
<?php

		if(!isset($json)){
				$json = "";
		}
	    
	    echo $json;
?>;

	var post = true;


	</script>

<?php

	}else{
?>
			<script> var quotes;</script>
<?php
		}

?>
		</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jquery.zclip.min.js"></script>
<script src="js/main.js"></script>
</html>