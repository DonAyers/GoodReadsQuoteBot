<?php

class Goodreads{
	
	//public $url = "http://www.goodreads.com/author/quotes/5223.Franz_Kafka";
	public $urlHead = "https://www.goodreads.com/search?utf8=%E2%9C%93&q=";
	public $urlTail = "&search_type=quotes";
	//public $url = "https://www.goodreads.com/search?utf8=%E2%9C%93&q=franz+kafka&search_type=quotes";
	//public $url = "https://www.goodreads.com/search?utf8=%E2%9C%93&q=dostoevsky&search_type=quotes&search%5Bfield%5D=on";
	public $JSON; 

	public $quotes = array();

	public function __construct($author, $pages){
		$x = 0;

		$quotes = $this->quotes;

		for ($i=1; $i <=$pages ; $i++) { 
			
			$currentPage = $i;	
			
			$url = $this->urlHead . $author . $this->urlTail;
			//echo "<h2>" . $url . "</h2>" . "<br>" ;

	    	if ($currentPage == 1){
	    		$urlEnd = "";
	    	}else{
	    		$urlEnd = "&page=" . $currentPage;
	    	}

	    	$url = $url . $urlEnd;

	    	$page = file_get_contents($url);
	    	$doc = new DOMDocument;
	    
	    	@$doc->loadHTML($page);
	    	$finder = new DomXPath($doc);
	    	$classname="quoteText";
	    	
	    	foreach ($finder->query("//*[contains(@class, '$classname')]") as $node) {
        
      			$current = $node->nodeValue;
      
	      		if (str_word_count($current)>4){
	        
		            $current = explode('.',$current,2);
		          	$x++;
		          	//echo $quotes[$x];
		          	$current = convert_smart_quotes($current);
		          	$current = str_replace("â", "'", $current);
		          	$current = str_replace("\n", "", $current);
		          	$current = str_replace("  ", "", $current);

		            $quotes[$x] = $current[0];
		            $quotes[$x] .= '."';
		           
	      	} 
	      	
	      	$this->quotes = $quotes;
	    }    
	}
}

?>