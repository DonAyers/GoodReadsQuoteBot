<?PHP

ini_set('display_errors',1);  error_reporting(E_ALL);

include("functions/functions.php");
include("classes/random_quote.php");


$author = $_REQUEST["author"];
	
//$pages = intval($_REQUEST["pages"]);

$document = new RandomQuote($author);

$json = json_encode($document->quotes);
		//var_dump($json);

//$data = /** whatever you're serializing **/;

header('Content-Type: application/json');
//echo json_encode($data);
echo($json);
?>


