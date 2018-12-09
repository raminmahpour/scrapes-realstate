<?php

include('simple_html_dom.php');
$hold = array();

$BaseUrl = "https://www.findbolig.nu";
function extractString($str, $start, $end) {
    $str = " " . $str;
    $ini = strpos($str, $start);
    if ($ini == 0)
        return "";
    $ini += strlen($start);
    $len = strpos($str, $end, $ini) - $ini;
    return substr($str, $ini, $len);
}


$html = file_get_contents('https://www.taurus.dk/til-leje/ledige-lejemal/ledige_lejemaal/43');

echo htmlentities($html);

exit();
$pokemon_doc = new DOMDocument();
libxml_use_internal_errors(TRUE); //disable libxml errors
$pokemon_doc->loadHTML($html);

$pokemon_xpath = new DOMXPath($pokemon_doc);
$pokemon_row = $pokemon_xpath->query('/html/body/div[3]/div/div[3]/div/div[3]/div/div/div/div/div/div/div/div/div[1]/div/div[2]/div[1]/h1');
{
    if($pokemon_row->length > 0)
    {
		
	}

}





// $value=extractString($html,'<div class="description-box">','</h1>');
// $value=extractString($html,'<h1>','</h1>');

// for ($i=0; $i < 3; $i++) { 
//     array_push($hold,$i);
// }
// //print_r($hold);

// foreach ($hold as $rslt) {
//    echo $rslt ;
// }

// //echo($hold[0]);

// exit();



//echo htmlentities($value);
{

    
}

?>