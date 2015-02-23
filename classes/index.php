<?php
include("/functions/functions.php");
include("/classes/good_quotes.php");
if (isset($_REQUEST["author"])) {
			//echo "<h1>AUTHOR SET</h1>" . "--->" . $_REQUEST["author"];
			$author = $_REQUEST["author"];
			echo "<div class='author'><h1>" . $author . "</h1></div>";
		}else{
			$author = "";
			//echo "<script>alert('Please Enter an Author last name');";
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

<!doctype html>
<head>
<title>GoodReads Quote Scraper</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<html>
	<body>
		<div class="siteContainer">
			<div class="ribbon">
				<h1>QuoteBot 2.0</h1>
			</div>

			<div class='loading' ><img src='../images/robot.gif'></div>

			<div class="formWrapper">
				<form method="post" id="authorField">
					<input type="text" name="author" placeholder="Author or Subject">
					<select name="pages">
			<?php

				for ($i=1; $i < 16 ; $i++) { 
					echo "<option value=".$i.">".$i."</option>\r\n";
				}

			?>
							
					</select>
					
					<input class="button" type="submit" value="Submit" style="">
				</form>
			</div>		
					<div class="wrapper">

						<div id="box" class="output"></div>
						
						<div id="box" class="quotes"></div>

					</div>
				</form>
			</div>
		<?php
		
		if (isset($_REQUEST["pages"])) {
			//echo "<h1>Pages SET</h1>" . "--->" . $_REQUEST["pages"];
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

		}

		?>
		</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="../js/jquery.zclip.min.js"></script>
<script src="../js/main.js"></script>
</html>