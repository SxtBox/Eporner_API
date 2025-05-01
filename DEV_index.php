<?php

require_once "api/Video_Details.php";
require_once "api/constants.php";
require_once "api/Categories.php";
require_once "api/Video_Sources.php";
require_once "api/Search.php";

header("Content-Type: application/json");

// Routing logic
$requestUri = explode("?", $_SERVER["REQUEST_URI"]) [0];
// $requestUri = explode("?", $_SERVER["REQUEST_URI"], 2)[0];
$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod === "GET" && $requestUri === "/") {
    echo json_encode([
        "intro" => "Eporner API: check the provider website @ https://www.eporner.com/",
        "routes" => [
            "category_list" => "/api/cats",
            "video_details_and_sources" => "/api/full/?id=:video_id",
            "search" => "/search/:query"
        ],
        "author" => "https://github.com/SxtBox"
    ]);
    exit;
}

if ($requestMethod === "GET" && preg_match("#^/details/([^/]+)$#", $requestUri, $matches)) {
    $id = $matches[1] ?? null;
    $thumbsize = "medium";

    $getDetails = getVideoDetails($id, $thumbsize);
    $getSources = getVideoSources($id);

    if ($getDetails === null || $getSources === null) {
        http_response_code(404);
        echo json_encode([
            "status" => 404,
            "return" => "Reached rate limit of this API"
        ]);
    } else {
        $getDetails["details"]["sources"] = $getSources["sources"] ?? [];
        http_response_code(200);
        echo json_encode($getDetails);
    }
    exit;
}

if ($requestMethod === "GET" && preg_match("#^/search/([^/]+)$#", $requestUri, $matches)) {
    $query = $matches[1];
    $getResults = getSearchResults($query, 30, 1, "medium", "latest", 0, 1);

    if ($getResults === null) {
        http_response_code(404);
        echo json_encode(
		[
            "status" => 404,
            "return" => "Reached rate limit of this API"
        ]);
    } else {
        http_response_code(200);
        echo json_encode([$getResults]);
    }
    exit;
}

if ($requestMethod === "GET" && $requestUri === "/cats/") {
    $getCats = getCategories();

    if ($getCats === null) {
        http_response_code(404);
        echo json_encode(
		[
            "status" => 404,
            "return" => "Reached rate limit of this API"
        ]);
    } else {
        http_response_code(200);
        echo json_encode($getCats);
    }
    exit;
}

// Default response for undefined routes
http_response_code(404);
echo json_encode(
[
    "status" => 404,
    "message" => "Route Not Found"
]);