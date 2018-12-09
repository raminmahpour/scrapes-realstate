<?php

include 'simple_html_dom.php';
include "./lib/class_lib.php";
$hold = array();
$imgsSliceArray = array();

$collection = array();

function IsNullOrEmptyString($str)
{
    return (!isset($str) || trim($str) === '');
}

$ref_url = "https://www.balder.dk";

function extractString($str, $start, $end)
{
    $str = " " . $str;
    $ini = strpos($str, $start);
    if ($ini == 0) {
        return "";
    }

    $ini += strlen($start);
    $len = strpos($str, $end, $ini) - $ini;
    return substr($str, $ini, $len);
}

//https://regex101.com/r/rFSPOl/2

$BaseUrl = $ref_url . "/api/objects/apartment?page=2";

$html = file_get_contents($BaseUrl);

// echo $html;

// exit();
$decoded = json_decode($html, true);

//$ok= $decoded[0]['map_markers'];
// echo $decoded['map_markers'];

//echo($decoded['map_markers'][0]["infoWindow"]);

foreach ($decoded['map_markers'] as $res) {

    $RentProperty6th = new RentProperty6th();

    $str = $res["infoWindow"];
    $re = '/href=\\\\"([^<]+)" /m';
    $descr = "";
    $title = "";
    $bedrooms = "";
    $area = "";
    $custom = "";
    $custom2 = "";
    $custom3 = "";
    $pricepermonth = "";
    $imgsSliceArray = array();
    $customExtraItem = array();

    //echo htmlentities($str);

    $sttt = extractString($str, '<a href="', '" ');

    //echo htmlentities($sttt);

    $html2 = file_get_contents($sttt);
    $moreInfo = extractString($html2, 'object-facts__column', 'object__similar-objects');
    $reMoreInfo = '/<p>([^<]+)<\/p>/m';
    preg_match_all($reMoreInfo, $moreInfo, $matchesreInfo, PREG_SET_ORDER, 0);

    // Print the entire match result
    //var_dump($matchesreInfo);
    foreach ($matchesreInfo as $matchreInfo) {

        array_push($customExtraItem, $matchreInfo[1]);
    }

    $RentProperty6th->CustomExtraItem = $customExtraItem;

    $gallery = extractString($html2, 'object-slides', 'view view-hero-video');

    $regallery = '/data-href="([^<]+)" style="/m';
//echo htmlentities($gallery);
    preg_match_all($regallery, $gallery, $matchesImgSlices, PREG_SET_ORDER, 0);
//var_dump($matchesImgSlices);

    foreach ($matchesImgSlices as $matchImgSlices) {

        array_push($imgsSliceArray, $ref_url . $matchImgSlices[1]);
    }
    $RentProperty6th->imageSlices = $imgsSliceArray;

    $extracted3 = (extractString($html2, '<div class="view-content">', 'more-info-link'));
    $custom3 = extractString($extracted3, '<span class="date-display-single">', '</span>');
//echo $custom3;
    $re33 = '/<span>([^<]*).+?<div class="field-item even">([^<]*)/s';

    preg_match_all($re33, $extracted3, $matches44, PREG_SET_ORDER, 0);

    foreach ($matches44 as $resultmatch4) {

        $ok = $resultmatch4[1];

        switch ($resultmatch4[1]) {
            case 'Lejlighedsnummer':
                $custom = $resultmatch4[2];
                $RentProperty6th->Custom = $custom;

                break;
            case 'Værelser':
                $bedrooms = $resultmatch4[2];
                $RentProperty6th->Bedrooms = $bedrooms;
                break;
            case 'Boligareal':
                $area = $resultmatch4[2];
                $RentProperty6th->Area = $area;

                break;
            case 'Leje/mnd.':
                $pricepermonth = $resultmatch4[2];
                $RentProperty6th->Pricepermonth = $pricepermonth;

                break;
            case 'Etage':
                $custom2 = $resultmatch4[2];
                $RentProperty6th->Custom2 = $custom2;

                break;

            default:
                # code...

        }
    }
    //var_dump($matches44);
    //echo htmlentities($extracted);
    //exit;
    $re3 = '/<(h[126]|p)\b[^>]*>(.*?)<\/\1>/m';
    preg_match_all($re3, $extracted3, $matches, PREG_SET_ORDER, 0);

    foreach ($matches as $match) {
        $resulttt = $match[1];

        if ($resulttt === "h1") {
            $title = $match[2];
            $RentProperty6th->Title = $title;

        } else {
            $descr = $descr . $match[2];
            $RentProperty6th->Descr = $descr;
        }
    }
    // Print the entire match result
    //var_dump($matches);
    //   echo "</br>";echo "</br>"[];
    //   echo $title;
    //   echo "</br>";  echo "</br>";  echo "</br>";  echo "</br>";
    //   echo $descr;

    array_push($collection, $RentProperty6th);
//https://regex101.com/r/VJZ3sQ/2
    //https://regex101.com/r/paZ9V2/1
    
}

var_dump($collection);
// $myJSON = json_encode($collection);
// echo $myJSON;
