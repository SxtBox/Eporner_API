<?php

require_once "api/Video_Sources.php";

$video_id = isset($_GET["id"]) && !empty($_GET["id"]) ? $_GET["id"] : "nLpU37AZKBa";
// $video_id = "nLpU37AZKBa";
$videoSources = getVideoSources($video_id);

if ($videoSources !== null) {
//print_r($videoSources);

$json_data = str_replace('\\/', '/', json_encode($videoSources,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
echo $json_data;

} else {
    echo "Failed to Fetch video sources" . PHP_EOL;
}
?>