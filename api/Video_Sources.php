<?php

/*
Example Usage

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
*/

require_once "constants.php"; // Assuming DETAILS_BASE is defined in this file
require_once "Curl.php"; // Get Data With Curl

/**
 * Fetch video sources based on video_id.
 *
 * @param string $video_id The video ID from ePorner.
 * @return array|null The video sources or null in case of an error.
 */
function getVideoSources($video_id) {
    try {
        // Construct the URL to fetch video details
        $url = DETAILS_BASE . $video_id;

        // Fetch video details
        $response = get_data($url); // Get Data With Curl
		// $response = file_get_contents($url);
        if ($response === false) {
            throw new Exception("Failed to Get Data From URL: $url");
        }
        $data = json_decode($response, true);
        if ($data === null) {
            throw new Exception("Failed to Decode JSON Data From URL: $url");
        }

        // Fetch embed page HTML
        $embedResponse = get_data($data["embed"]); // Get Data With Curl
		//$embedResponse = file_get_contents($data['embed']);
        if ($embedResponse === false) {
            throw new Exception("Failed to Fetch Embed Page From URL: {$data['embed']}");
        }

        // Match the pattern in the HTML
        $pattern = "/vid\s*=\s*'([^']+)';\s*[\w*\.]+hash\s*=\s*['\"]([\da-f]{32})/";
        if (preg_match($pattern, $embedResponse, $matches) && count($matches) === 3) {
            $video_id = $matches[1];
            $hash = $matches[2];

            // Generate hash code
            $hash_code = '';
            for ($i = 0; $i < 4; $i++) {
                $part = substr($hash, $i * 8, 8);
                $hash_code .= base_convert($part, 16, 36);
            }

            // Construct the load URL
            $load_url = "https://www.eporner.com/xhr/video/{$video_id}?hash={$hash_code}&device=generic&domain=www.eporner.com&fallback=false&embed=false&supportedFormats=mp4";

            // Fetch the video sources
            //$sourcesResponse = file_get_contents($load_url);
			$sourcesResponse = get_data($load_url); // Get Data With Curl
            if ($sourcesResponse === false) {
                throw new Exception("Failed to Get Data From URL: $load_url");
            }
            $sourcesData = json_decode($sourcesResponse, true);
            if ($sourcesData === null) {
                throw new Exception("Failed to Decode JSON Data From URL: $load_url");
            }

            // Extract sources
            $sources = $sourcesData["sources"] ?? null;

            // Wrap the sources in a JSON-like structure
            return [
                "sources" => $sources
            ];
        } else {
            error_log("Pattern not found in HTML");
            return null;
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        return null;
    }
}
?>