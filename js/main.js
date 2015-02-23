
/*if (typeof quotes == 'undefined') {
   if(post){
   	$('.formWrapper').append("<img class='loading' src='../images/walk.gif'>");
   	}
}*/


function loop(){
	//$('.output, .quotes').append("<div class='dot'></div>");
	$('.quotes h2').append('<span id="add_here">.</span>');
	$('.loading').addClass("flip").animate({'right': '500'}, {
        easing:'linear',
        duration: 1500, 
        complete: function() {
            //$('.output, .quotes').append("<div class='dot'></div>");
            $('.quotes h2').append('<span id="add_here">.</span>');
            $('.loading').removeClass('flip').animate({right: 50}, {
                easing:'linear',
                duration: 1500, 
                complete: loop});
        }});
	console.log("looped");
    
    

}

$('.button').click(function(){
	$('.output h1, pre, h2, p').remove();
	$('.quotes').append("<h2>processing</h2>");
	$('.loading').show();
	//$('.output, .quotes').append("<h2>Processing</h2>");
	loop();
	
});


$(document).ready(function(){
	if(quotes !== undefined ){
		
		var prettyJSON = JSON.stringify(quotes, null, 4);
		$('.output').append("<pre>" + prettyJSON + "</pre>");

		for(var x in quotes){
			$('.quotes').append("<p>" + quotes[x] + "</p>");
		}
		//console.log($('.output').html());
		
		$('.author').animate({'marginTop': '100px'}, {
	        easing:'swing',
	        duration: 500});

		//$('.loading').remove();

		var data = "text/json;charset=utf-8," + encodeURIComponent(prettyJSON);

		$('.output').prepend('<div class="download"><a href="data:' + data + '" download="data.json">Download JSON</a></div>');
	}else if(post){
		$('.output').append("<h2>Sorry...No Results</h2>");
	}
});

