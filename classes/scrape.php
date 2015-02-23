<?php
include("../functions/functions.php");

class Goodreads{
	
	public $url = "http://www.goodreads.com/author/quotes/5223.Franz_Kafka";

	public $quotes = array();

	public function __construct($pages){
		$x = 0;

		$quotes = $this->quotes;

		for ($i=1; $i <=$pages ; $i++) { 
			
			$currentPage = $i;	
			$url = $this->url;
			echo "<h2>" . $url . "</h2>" . "<br>" ;

	    	if ($currentPage == 1){
	    		$urlEnd = "";
	    	}else{
	    		$urlEnd = "?page=" . $currentPage;
	    	}

	    	$url = $url . $urlEnd;

	    	$page = file_get_contents($url);
	    	$doc = new DOMDocument;
	    //$page = strstr($page, "quoteDetails");
	    //$page = strstr($page, "text-align", true);
	   	//	echo ($page);
	    	$doc->loadHTML($page);
	    	$finder = new DomXPath($doc);
	    	$classname="quoteText";

	    	echo "<h2>" . $url . "</h2>" . "<br>"; 
	    	
	    	foreach ($finder->query("//*[contains(@class, '$classname')]") as $node) {
        
      			$current = $node->nodeValue;
      
	      		if (str_word_count($current)>4){
	        
		            $current = explode('.',$current,2);
		          	$x++;
		          	//echo $quotes[$x];
		          	$current = convert_smart_quotes($current);
		          	$current = str_replace("â", "'", $current);
		          //echo $current[0] . '."' . "<br>";

		          //if(strpos($current,'Ã©ternitÃ©') == false){ 
		            $quotes[$x] = $current[0];
		            $quotes[$x] .= '."';
		            echo $quotes[$x] . "<br>";
	          	}
	      	} 
	      
	    }    

	}


}

$quotes = new Goodreads(5);




?>