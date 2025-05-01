<?php

require_once "api/Video_Details.php";

$video_id = isset($_GET["id"]) && !empty($_GET["id"]) ? $_GET["id"] : "nLpU37AZKBa";
// $video_id = "nLpU37AZKBa";
$thumbsize = "small";
$videoDetails = getVideoDetails($video_id, $thumbsize);

if ($videoDetails !== null) {
//print_r($videoDetails);

$json_data = str_replace('\\/', '/', json_encode($videoDetails,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
echo $json_data;

} else {
    echo "Failed to Fetch video details" . PHP_EOL;
}
?>