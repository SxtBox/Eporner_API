<?php
//MediaDetails.php
require_once "constants.php"; // Assuming DETAILS_BASE is defined in this file
require_once "Curl.php"; // Get Data With Curl

/**
 * Fetch video details based on ID and optional thumbnail size.
 *
 * @param string $video_id The video ID.
 * @param string|null $thumbsize Optional thumbnail size ('small', 'medium', 'big').
 * @return array|null The video details or null in case of an error.
 */
function getVideoDetails($video_id, $thumbsize = null) {
    try {
        // Construct the URL with optional thumbnail size
        if (in_array($thumbsize, ["small", "medium", "big"])) {
            $url = DETAILS_BASE . $video_id . "&thumbsize=" . $thumbsize;
        } else {
            $url = DETAILS_BASE . $video_id;
        }

        // Fetch the response
        //$response = file_get_contents($url);
		$response = get_data($url); // Get Data With Curl
        if ($response === false) {
            throw new Exception("Failed to Get Data From URL: $url");
        }

        // Parse the JSON response
        $data = json_decode($response, true);
        if ($data === null) {
            throw new Exception("Failed to Decode JSON Data From URL: $url");
        }

        // Remove unwanted fields
        unset($data["url"], $data["embed"]);

        // Wrap the details in the desired format
        $json = [
            "details" => $data
        ];

        return $json;
    } catch (Exception $e) {
        error_log($e->getMessage());
        return null;
    }
}
?>