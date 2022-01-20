<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../src/model/DataAccess.php';
include_once '../src/model/GPvisit.php';

if(!isset($getter)) {
    $getter = new DataAccess();
}

$maleLE = $getter->getLE("../data/lifeExpectancyMale.csv");
$femaleLE = $getter->getLE("../data/lifeExpectancyFemale.csv");
$totalLE = array_merge($maleLE,$femaleLE);

if($totalLE)
{
    $code = 200;
    header_remove();
    http_response_code($code);
    header('Content-Type: application/json');
    header('Status: '.$code);

    echo getSemanticMarkup($totalLE);
}
else{

   
    http_response_code(404);

    echo json_encode(
        array("response" => "No data found.")
    );
}

function getSemanticMarkup($data){
    $result = '{ "@context" : { "Place" : "http://schema.org", "LE" : "http://web.socem.plymouth.ac.uk" }, "Place" : [ ';

    foreach($data as $LE)
    {
        $result .= '
        { "@type" : "Place",
                "name" : "'.$LE->getWards().'",
                "identifier" : "'.$LE->getWardCode().'",
                "LE:lifeExpectancy" : "'.$LE->getLE().'"
                },';
    }
    $result = substr($result, 0, -1);
    $result .= ']}';

    return $result;
}

function returnJSON($response, $code)
{
    header_remove();
    http_response_code($code);
    header('Content-Type: application/json');
    header('Status: '.$code);
    return json_encode(array('status' => $code, 'message' => $response));
}
