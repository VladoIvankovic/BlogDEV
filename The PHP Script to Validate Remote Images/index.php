<?php

function isValidImage($url)
{
    // Initialize cURL to fetch image data
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0");
    $imageData = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200 || !$imageData) {
        return false; // Image doesn't exist or request failed
    }

    // Try to create an image from the binary data
    $image = @imagecreatefromstring($imageData);
    return $image !== false;
}

// Test URL
$url =
    "https://blog.vladoivankovic.com/img/upload/1733921884_67598c5c41695_VladoIvankovic-Cover.jpg";
if (isValidImage($url)) {
    echo "✅ The image is valid!";
} else {
    echo "❌ Invalid image.";
}
