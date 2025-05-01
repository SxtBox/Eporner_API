<?php

/*
Explanation:

CATEGORIES is imported from the constants.php file, similar to the JavaScript categories.
Return Format:

Returns an associative array with the key categories wrapping the CATEGORIES constant.
Error Handling:

Wraps the logic in a try-catch block to handle unexpected errors. Logs errors using error_log.
Example Usage:

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
*/

require_once "constants.php"; // Assuming CATEGORIES is defined in this file

/**
 * Get the list of categories.
 *
 * @return array|null The list of categories or null in case of an error.
 */
function getCategories() {
    try {
        // Wrap the categories in the desired JSON-like structure
        return [
            "categories" => CATEGORIES
        ];
    } catch (Exception $e) {
        error_log($e->getMessage());
        return null;
    }
}
?>