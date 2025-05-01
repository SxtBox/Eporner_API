<?php
// Search.js
/*

URL Construction:

The URL is constructed using sprintf and urlencode to ensure proper formatting of the query parameters.
Fetching Data:

Uses file_get_contents to fetch data from the API.
JSON Decoding:

Decodes the JSON response using json_decode.
Field Removal:

Removes the url and embed fields from the response array using unset.
Return Format:

Returns the processed results wrapped in an associative array with the key details.
Error Handling:

Wraps the logic in a try-catch block to handle exceptions.
Logs any errors using error_log.

Example Usage

<?php
// Search_Example.php?q=sex
require_once "api/Search.php";

$query = isset($_GET["q"]) && !empty($_GET["q"]) ? $_GET["q"] : "sex";
//$query = "sex";
$per_page = 10;
$page = 1;
$thumbsize = "small";
$order = "latest";
$gay = 0;
$lq = 0;

$searchResults = getSearchResults($query, $per_page, $page, $thumbsize, $order, $gay, $lq);

if ($searchResults !== null) {
//print_r($searchResults);

$json_data = str_replace('\\/', '/', json_encode($searchResults,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
echo $json_data;

} else {
    echo "Failed to Fetch Search Results" . PHP_EOL;
}
?>
*/

/**
 * Fetch search results from the ePorner API.
 *
 * @param string $query The search query.
 * @param int $per_page Number of results per page.
 * @param int $page The page number.
 * @param string $thumbsize Thumbnail size ('small', 'medium', 'big').
 * @param string $order Sorting order (e.g., 'latest', 'popular').
 * @param int $gay Whether to include gay content (1 for yes, 0 for no).
 * @param int $lq Whether to include low-quality videos (1 for yes, 0 for no).
 * @return array|null The search results or null in case of an error.
 */

require_once "Curl.php"; // Get Data With Curl
function getSearchResults($query, $per_page, $page, $thumbsize, $order, $gay, $lq) {
    try {
        // Construct the API URL
        $url = sprintf(
            "https://www.eporner.com/api/v2/video/search/?query=%s&per_page=%d&page=%d&thumbsize=%s&order=%s&gay=%d&lq=%d&format=json",
            urlencode($query),
            $per_page,
            $page,
            $thumbsize,
            $order,
            $gay,
            $lq
        );

        // Fetch the data from the API
        //$response = file_get_contents($url);
		$response = get_data($url); // Get Data With Curl
        if ($response === false) {
            throw new Exception("Failed to Get Data From URL: $url");
        }

        // Decode the JSON response
        $data = json_decode($response, true);
        if ($data === null) {
            throw new Exception("Failed to Decode JSON Data From URL: $url");
        }

        // Remove unwanted fields
        unset($data["url"], $data["embed"]);

        // Wrap the results in the desired format
        return [
            "details" => $data
        ];
    } catch (Exception $e) {
        error_log($e->getMessage());
        return null;
    }
}
?>