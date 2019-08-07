<?php
$fp = fopen('path.txt', 'r');
$path = fgets($fp, 999);
fclose($fp);
// create a new cURL resource
$ch = curl_init();

// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, $path.'/'.$_GET['code']);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, ['_method' => 'DELETE']);

// grab URL and pass it to the browser
curl_exec($ch);

// close cURL resource, and free up system resources
curl_close($ch);
?>

<p><a href="read.php">Products</a></p>