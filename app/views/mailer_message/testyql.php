<?
	$query = "select * from yahoo.finance.stocks where symbol=”aapl”";

	$url = "http://query.yahooapis.com/v1/public/yql?q=".$query; 

	$html = file_get_html($url);
	print_r($html);
	foreach($html->find('#section_left_3rd td',  null) as $e){
		array_push($ar, $e->innertext);
	}
?>