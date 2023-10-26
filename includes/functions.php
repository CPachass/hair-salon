<?php 
// Debug an object and stops execution
function debug(String $object) : void
{
    echo "<pre>";
    var_dump($object);
    echo "</pre>";
    exit;
}

// Sanitize input from HTML
function sanitizeHTML($html) : string
{
    $htmlSanitized = htmlspecialchars($html);
    return $htmlSanitized;
}
?>