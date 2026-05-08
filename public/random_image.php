<?php
// Define the array of image paths
$images = [];
for ($i = 1; $i <= 10; $i++) {
    $images[] = 'assets/img/success/' . $i . '.gif';
}

// Select a random image
$randomImage= $images[array_rand($images)];

// Serve the image
header('Content-Type: image/gif');
// readfile($randomImage);
readfile('assets/img/success/success.png');
exit;
?>
