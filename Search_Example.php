<?php
/*
Parameters:

$query: The search query string
$per_page: Number of results per page
$page: The page number
$thumbsize: The thumbnail size (small, medium, or big)
$order: Sorting order (e.g., latest, popular)
$gay: Include gay content (1 for yes, 0 for no)
$lq: Include low-quality videos (1 for yes, 0 for no)
*/

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