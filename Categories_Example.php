<?php
require_once "api/Categories.php";
$categories = getCategories();

if ($categories !== null) {
//print_r($categories);
$json_data = str_replace('\\/', '/', json_encode($categories,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
echo $json_data;

} else {
    echo "Failed to Fetch Categories" . PHP_EOL;
}
?>