<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title></title>
</head>

<body>
    <a href="create.php">Add New Product</a>
    <hr>

    <?php
    $fp = fopen('path.txt', 'r');
    $path = fgets($fp, 999);
    fclose($fp);
    $ch = curl_init($path);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Store the data:
    $json = curl_exec($ch);
    curl_close($ch);

    // Decode JSON response:
    // Access the exchange rate values. For example $exchangeRates[rates][PLN]:
    $products = json_decode($json, true);

    foreach ($products as $product) {
        echo "<a href='update.php?code=".$product['productCode']."'>".$product['productCode']."</a>";
        echo "<ol>";
        foreach ($product as $key => $value) {
            echo "<li>$key : $value</li>";
        }
        echo "<a href='delete.php?code=".$product['productCode']."'>DELETE</a><br>";
        echo "</ol>";
        echo "<hr>";
    }
     ?>

</body>

</html>