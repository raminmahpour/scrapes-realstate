<?php

include('simple_html_dom.php');
include("./lib/class_lib.php");
$hold = array();
$imgsSliceArray = array();

$collection = array();

function IsNullOrEmptyString($str){
    return (!isset($str) || trim($str) === '');
}

$ref_url="http://nordichousing.dk";
$BaseUrl = $ref_url."/lej-en-bolig";
function extractString($str, $start, $end) {
    $str = " " . $str;
    $ini = strpos($str, $start);
    if ($ini == 0)
        return "";
    $ini += strlen($start);
    $len = strpos($str, $end, $ini) - $ini;
    return substr($str, $ini, $len);
}


$html = file_get_contents($BaseUrl);
$re = '/href="([^<]+) id=/m';

$str =$html;
preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);

// Print the entire match result
//var_dump($matches);

// echo sizeof($matches);
// exit();
foreach ($matches as $match) {
//   echo $match[1]." <br/> ";


// $property->Age="12";

  // $property = new property();
// $property->set_href($match[1]);
// $property->set_title($match[1]);
$property = new property($match[1],'a');

$infoLink = str_replace('&quot;"', '', $ref_url.$match[1]);
$siteJadid=$infoLink = str_replace('"', '', $ref_url.$match[1]);
$infoLink = str_replace('/HousingInfo"', '', $ref_url.$match[1]);

if (!preg_match('/\benestaaende\b/',$infoLink)) 
{

    //enestaaende-kunstner

  // continue;
}


//$infoLink = $ref_url.$match[1];
 $html2 = file_get_contents($infoLink);

//$siteJadid
$html3 = file_get_contents($siteJadid);
$re3 = '/<tr>\s+?<td>(.*?)<\/td>\s+?<td>(.*?)<\/td>\s+?<\/tr>/m';
preg_match_all($re3, $html3, $matches5, PREG_SET_ORDER, 0);

 $typeOk=$matches5[0][2];




$re2 = '/<tr>\s+?<td>(.*?)<\/td>\s+?<td>(.*?)<\/td>\s+?<\/tr>/m';
//$str = '';

preg_match_all($re2, $html2, $matches4, PREG_SET_ORDER, 0);

// Print the entire match result
//var_dump($matches4);
$RentProperty=new RentProperty();

// echo htmlentities($html2);

//  exit();

$imgSlices=extractString($html2,'<div class="tab-pane active" id="gallery"','div id="map"');

//echo htmlentities($imgSlices);
$reimg = '/src\s*=\s*"(.+?)"/m';
preg_match_all($reimg, $imgSlices, $matchesImgSlices, PREG_SET_ORDER, 0);

// Print the entire match result

//imageSlices

//$imgsSliceArray

$imgsSliceArray=Array();

foreach ($matchesImgSlices as $matchImgSlices) {
 //  echo $matchImgSlices[1];
   array_push($imgsSliceArray,$ref_url.$matchImgSlices[1]);
}

$RentProperty->imageSlices=$imgsSliceArray;




//https://regex101.com/r/5sklOK/3

//<div class="col-md-12 details">
$topInfoHtml=extractString($html2,'<div class="col-md-12 details">','</table>');
$reTopInfo = '/<(h[126]|p)\b[^>]*>(.*?)<\/\1>/';
preg_match_all($reTopInfo, $topInfoHtml, $matchesTopInfo, PREG_SET_ORDER, 0);
// echo htmlentities($topInfoHtml);
// exit();
// Print the entire match result
//var_dump($matchesTopInfo);


$isnullorempty=IsNullOrEmptyString($topInfoHtml);
if ($isnullorempty) {
    # code...
}
else{

    // echo $dovvomi;
    // exit();
    //echo $matchesTopInfo[2][2];
    $rentPrice= $matchesTopInfo[3][2];
    $RentProperty->RentPrice=$rentPrice;

    
    $titleOfRent= $matchesTopInfo[0][2];


    $RentProperty->Title=$titleOfRent;
    
    $pingCode_city= $matchesTopInfo[1][2];
    $pieces = explode(" ", $pingCode_city);
    
    $avvali=$pieces[1];
    $RentProperty->Code= $avvali;
      try {

           $isTouch = isset($pieces[2]);
        
if ($isTouch) {
    $dovvomi=$pieces[2];
    $RentProperty->City= $dovvomi;
}
       
    }
    catch (Exception $ex) 
    {
    
    
    }
    
     
    
    
    
    
    

    

}




//echo htmlentities($html2);



//exit();
foreach ($matches4 as $res22) {

$borddd=extractString($html2,'<div class="col-md-12 house-description">','</div>');
$re33 = '/<(h[12]|p)>(.*?)<\/\1>/s';
preg_match_all($re33, $borddd, $matches4444, PREG_SET_ORDER, 0);
$descr="";
foreach ($matches4444 as $result) {

//echo $result[0];
    if (strpos($result[0], '<p>') !== false) {
        $descr= $descr.$result[0];
    //    $descr = str_replace('info@nordichousing.dk', '', $descr.$result[0]);

     
    }

}
$descr= str_replace('info@nordichousing.dk', '', $descr);

$RentProperty->Descr=$descr;
$RentProperty->TypeOK=$typeOk;

//var_dump($matches4444);


  //  echo htmlentities($html2);
//exit();


    if ($res22[1]=="Kvm") {
       
       //echo ($res22[2]);
       $RentProperty->Area=$res22[2];
    }

    else if (strpos($res22[1], 'Værelser') !== false) {
        $RentProperty->Bedroom=$res22[2];
    }
    else if ($res22[1]=="værelser") {
        $RentProperty->Bedroom=$res22[2];
    }
    else if ($res22[1]=="Antal værelser") {
        $RentProperty->Bedroom=$res22[2];
    }
    // else if (preg_match('/\bStuer\b/',$res22[1])) {
    //     $RentProperty->Custom1=$res22[2];
    // }
    else if (strpos($res22[1], 'stuer') !== false) {
        $RentProperty->Custom1=$res22[2];
    }

    // else if ($res22[1]=="Stuer") {
    //     $RentProperty->Custom1=$res22[2];
    // }
    else if ($res22[1]=="Antal badeværelser") {
        $RentProperty->Bathroom=$res22[2];
    }//Antal badeværelser
    else if ($res22[1]=="Møbleret") {
        $RentProperty->Custom2=$res22[2];
    }//Have
    else if ($res22[1]=="Have") {
        $RentProperty->Custom3=$res22[2];
    }//Have
    else if ($res22[1]=="Husdyr") {
        $RentProperty->Custom4=$res22[2];
    }//Have
    else if ($res22[1]=="Indflytningsdato") {
        $RentProperty->Custom5=$res22[2];
    }//Ha
    else if ($res22[1]=="Lejeperiode") {
        $RentProperty->Custom6=$res22[2];
    }//Ha
    else if ($res22[1]=="Forbrugstal") {
        $RentProperty->Custom7=$res22[2];
    }
    else if ($res22[1]=="Forbrugstal pr. md.") {
        $RentProperty->Custom7=$res22[2];
    }

   
}

// echo $html2;
// exit();
//var_dump($RentProperty);
 
// {



    
//echo $html2;
//exit();
// }


//echo  $stefan->get_name();


array_push($collection,$RentProperty);

//print_r($collection);





//exit();



}
$myJSON = json_encode($collection);


// foreach ($collection as $dg){
//     echo $dg->Title;
// }


// $okk=$collection[0]->Title;
// {

// }



// foreach ($collection as $key['Title'] => $value) {
//     //print_r( $value);
//    echo (string)$value['Title'];
// }
//print_r($collection); //$myJSON;
echo $myJSON;
//echo htmlentities($html);

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